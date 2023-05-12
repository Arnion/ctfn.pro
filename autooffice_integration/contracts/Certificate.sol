// SPDX-License-Identifier: MIT
pragma solidity ^0.8.4;
 
import "@openzeppelin/contracts/token/ERC721/ERC721.sol";
import "@openzeppelin/contracts/token/ERC721/extensions/ERC721URIStorage.sol";
import "@openzeppelin/contracts/access/Ownable.sol";
import "@openzeppelin/contracts/utils/Counters.sol"; 
import "@openzeppelin/contracts/utils/Strings.sol";
 
contract ArnionCertificate is ERC721, ERC721URIStorage, Ownable {
    using Counters for Counters.Counter;
    using Strings for uint256;
 
    Counters.Counter private _tokenIdCounter;

    string internal baseURI = "ipfs://Qmc6WxxeMkYcAkBhxsW2jL3cFjiSmd7SEXcmJdEqVLjCpQ/certificate.json"; 

    constructor() ERC721("Arnion", "ARN") {}

    function _beforeTokenTransfer(address from, address to, uint256 tokenId, uint256 batchSize) internal onlyOwner override(ERC721)
    {
        // for _burn()
        if ((from != address(0)) && (to != address(0))) {
            revert("Error. Certificate can only be transfered by contract owner - Arnion");
        }
        
        super._beforeTokenTransfer(from, to, tokenId, batchSize);
    }
 
    function safeMint(address to) public onlyOwner {
        uint256 tokenId = _tokenIdCounter.current();
        _tokenIdCounter.increment();
        _safeMint(to, tokenId);
    }
 
    // The following functions are overrides required by Solidity.
 
    function _burn(uint256 tokenId) internal onlyOwner override(ERC721, ERC721URIStorage) {
        super._burn(tokenId);
    }
 
    function tokenURI(uint256 tokenId)
        public
        view
        override(ERC721, ERC721URIStorage)
        returns (string memory)
    {   
        _requireMinted(tokenId);
        return baseURI;
    }

    function burn(uint256 tokenId) external onlyOwner {
        _requireMinted(tokenId);
        _burn(tokenId);
    }

    function changeBaseURI(string memory _baseURI) external onlyOwner {
        baseURI = _baseURI;
    }
}
