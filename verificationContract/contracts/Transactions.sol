// SPDX-License-Identifier: UNLICENSED

pragma solidity ^0.8.0;

import "hardhat/console.sol";

contract Transactions {
    uint256 transactionCount=1;

    event Transfer(address from, address receiver, uint amount, string message, uint256 timestamp, string keyword, bytes32 transactionHash);

    struct TransferStruct {
        address sender;
        address receiver;
        uint amount;
        string message;
        uint256 timestamp;
        string keyword;
        bytes32 transactionHash;
    }

    TransferStruct[] transactions;

    function addToBlockchain(address payable receiver, uint amount, string memory message, string memory keyword) public returns(bool) {
        transactionCount += 1;
        bytes32 transactionHash = keccak256(abi.encodePacked(msg.sender, receiver, amount, message, block.timestamp, keyword));
        transactions.push(TransferStruct(msg.sender, receiver, amount, message, block.timestamp, keyword, transactionHash));
        emit Transfer(msg.sender, receiver, amount, message, block.timestamp, keyword, transactionHash);
//        (bool success, ) = receiver.call{value: amount, gas: 25000}("");
//        require(success, "Failed to send Ether");

        return true;
    }

    function getAllTransactions() public view returns (TransferStruct[] memory) {
        return transactions;
    }

    function getTransactionCount() public view returns (uint256) {
        return transactionCount;
    }
}
