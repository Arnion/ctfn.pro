    // SPDX-License-Identifier: MIT
    pragma solidity ^0.8.0;

    import "./SchoolToken.sol";

    contract CtfnAdmin {

        SchoolToken[] public schoolList;

        uint256 public schoolPrice;
        address payable public owner;

        bool public contractState;

        address public migrateFrom;
        address public migrateTo;

        uint256 public safeMintPrice = 300000000000000 wei; // 0.0003 $


        constructor () {
            contractState = true;
            owner = payable(msg.sender);
            schoolPrice = 10000000000000000 wei; // 0.01 BNB ~ 3$
        }

        event SchoolCreated(address indexed schoolAddress, address indexed createdBy);

        function createSchool(string memory _schoolName, string memory _schoolAbbr) payable public returns(address) {
            require(contractState, "Contract is disabled");
            require(msg.value == schoolPrice, "Wrong pay value");
            
            SchoolToken School = new SchoolToken(_schoolName, _schoolAbbr, schoolList.length, payable(address(this)), msg.sender);
            schoolList.push(School);
            School.transferOwnership(msg.sender);
            
            address schoolAddres = address(School);

            emit SchoolCreated(schoolAddres, msg.sender);
            return schoolAddres;
        }

        function schoolListLength() view public returns(uint) {
            return schoolList.length;
        }

        function withdraw() onlyOwner external {
            owner.transfer(address(this).balance);
        }

        function setOwner(address payable newOwner) onlyOwner external {
            owner = newOwner;
        }

        function setSchoolPrice(uint256 newPrice) onlyOwner external {
            schoolPrice = newPrice;
        }

        function setSafeMintPrice(uint256 newPrice) onlyOwner external {
            safeMintPrice = newPrice;
        }

        function setContractState(bool state) onlyOwner external {
            contractState = state;
        }

        function setSchoolList(SchoolToken[] memory _schoolList) external  {
            require(msg.sender == address(migrateFrom), "Wrong migrate from address"); 
            schoolList = _schoolList; //onlyowner
            migrateFrom = address(0);
        }

        function setMigrateFrom(address _migrateFrom) onlyOwner external {
            migrateFrom = _migrateFrom;
        }

        function setMigrateTo(address _migrateTo) onlyOwner external {
            migrateTo = _migrateTo;
        }
        
        // onlyowner
        function migrateSchoolsToNewCtfnAdmin() onlyOwner external  {
            if (migrateTo == address(0)) {
                revert("Migrate address is 0");
            }
            contractState = false;
            ICtfnAdmin newCtfn = ICtfnAdmin(migrateTo);
            newCtfn.setSchoolList(schoolList);
            for (uint i = 0; i < schoolList.length; i++) {
                schoolList[i].setCtfnAdminContract(payable(migrateTo));
            }
            migrateTo = address(0);
            delete schoolList;
        }
        
        modifier onlyOwner() {
            require(msg.sender == address(owner), "Only owner can execute this function");
            _;
        }

        receive() external payable {}
    }
