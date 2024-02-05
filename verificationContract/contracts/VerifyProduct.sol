// SPDX-License-Identifier: UNLICENSED

pragma solidity ^0.8.0;

import "hardhat/console.sol";

contract VerifyProduct {
    uint256 VerificationCount = 0;

    event Verify(uint productId, string pharmacy, string serial, uint256 timestamp);

    struct VerifyStruct {
        uint productId;
        string pharmacy;
        string serial;
        uint256 timestamp;
    }

    VerifyStruct[] Verifications;

    function addVerification(uint productId, string memory pharmacy, string memory serial) public returns (bool) {
        VerificationCount += 1;
//        bytes32 VerificationHash = keccak256(abi.encodePacked(msg.sender, receiver, amount, message, block.timestamp, keyword));
        Verifications.push(VerifyStruct(productId, pharmacy, serial, block.timestamp));
        emit Verify(productId, pharmacy, serial, block.timestamp);
        return true;
    }

    function getAllVerifications() public view returns (VerifyStruct[] memory) {
        return Verifications;
    }

    function getVerificationCount() public view returns (uint256) {
        return VerificationCount;
    }
}
