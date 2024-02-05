require("@nomiclabs/hardhat-waffle")
module.exports = {
    solidity: "0.8.0",
    networks: {
        hardhat: {
            chainId: 5777,
        },
        ganache: {

            url: "http://127.0.0.1:7545",
            accounts: [
                // `0x09a872bca114fc76df3e0ec153ef466ea4ce38ecf287a63e1c76573a96968b18`,
                // '0xacfd70d9728c89da68e526ca96f676d3b1ad27eef8e67d6300711575c84d67ce',
                '0x6bb478ee8125fb1f3aa140740fd5170187574c091beb22ab5635a12ffcebf725',
            ],
        }

    },
    paths: {
        artifacts: "./src/artifacts",
    }
};











// // require("@nomicfoundation/hardhat-toolbox");
//
//
//
// // // require('@nomiclabs/hardhat-ethers')
// require('@nomiclabs/hardhat-waffle');
// module.exports={
//     solidity:'0.8.0',
//     networks: {
//             ganache: {
//                 url: 'http://127.0.0.1:7545',
//                 network_id: 5777, // Match any network ID
//
//         },
//     },
// }
