    // SPDX-License-Identifier: MIT
    pragma solidity ^0.8.0;

    import "@openzeppelin/contracts/token/ERC721/ERC721.sol";
    import "@openzeppelin/contracts/access/Ownable.sol";
    import "@openzeppelin/contracts/utils/Counters.sol"; 
    import "@openzeppelin/contracts/utils/Strings.sol";

    interface ICtfnAdmin {
        function migrateFrom() external view returns(address);
        function migrateTo() external view returns(address);
        function safeMintPrice() external view returns(uint256);
        function setSchoolList(SchoolToken[] memory _schoolList) external;
    }

    contract SchoolToken is ERC721, Ownable {
        using Counters for Counters.Counter;
        using Strings for uint256;
        
        string public version = "1.0.0";

        Counters.Counter public Counter;

        uint256 public schoolId;
        uint256 public totalSupply = 0;
        address public createdByContract; 
        address public createdByUser;

        address payable public ctfnAdminContract;

        mapping(uint256 => string) internal tokenURIList;

        constructor(
            string memory _schoolName,
            string memory _schoolAbbr,
            uint256 _schoolId,
            address payable _createdByContract,
            address _createdByUser
        ) ERC721(_schoolName, _schoolAbbr) {
            createdByUser = _createdByUser;
            createdByContract = address(_createdByContract);
            ctfnAdminContract = _createdByContract;
            schoolId = _schoolId;
        }

        function _beforeTokenTransfer(address from, address to, uint256 tokenId, uint256 batchSize) internal onlyOwner override(ERC721)
        {
            if ((from != address(0)) && (to != address(0))) {
                revert(string(abi.encodePacked("Error. Certificate can only be transfered by contract owner - ", name())));
            }
            super._beforeTokenTransfer(from, to, tokenId, batchSize);
        }
    
        function safeMint(address to, string memory newTokenURI) external payable onlyOwner {
            
            ICtfnAdmin admin = ICtfnAdmin(ctfnAdminContract);
            uint256 safeMintPrice = admin.safeMintPrice();

            require(msg.value == safeMintPrice, "Error. Wrong safe mint value");
            
            (bool success, ) = ctfnAdminContract.call{
                value: msg.value
            }("");

            require(success, "Error. Mint transfer failed");

            uint256 tokenId = Counter.current();
            Counter.increment();
            _safeMint(to, tokenId);

            tokenURIList[tokenId] = newTokenURI;
            totalSupply++;
        }
    
        function burn(uint256 tokenId) external onlyOwner {
            _requireMinted(tokenId);
            _burn(tokenId);
        }

        function getSafeMintPrice() external view returns(uint)  {
            ICtfnAdmin admin = ICtfnAdmin(ctfnAdminContract);
            return admin.safeMintPrice();
        }
        
        function _burn(uint256 tokenId) internal onlyOwner override(ERC721) {
            super._burn(tokenId);
            tokenURIList[tokenId] = '';
        }
    
        function tokenURI(uint256 tokenId)
            public
            view
            override(ERC721)
            returns (string memory)
        {   
            _requireMinted(tokenId);
            return tokenURIList[tokenId]; // string(abi.encodePacked(tokenURIList[tokenId]))
        }

        function setTokenURI(uint256 tokenId, string memory newTokenURI) external onlyOwner {
            _requireMinted(tokenId);
            tokenURIList[tokenId] = newTokenURI;
        }

        function setCtfnAdminContract(address payable newAddress) external onlyPlatform {
            ctfnAdminContract = newAddress;
        }

        modifier onlyPlatform {
            require(msg.sender == address(ctfnAdminContract), "Only by platform - CTFN");
            _;
        }
    }
