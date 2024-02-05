const { ethers } = require("ethers")

const main = async (name) => {
    const transactionsFactory = await hre.ethers.getContractFactory(name);
    const transactionsContract = await transactionsFactory.deploy();
    await transactionsContract.deployed();
    saveFrontendFiles(transactionsContract , name);
    console.log("Transactions address: ", transactionsContract.address);
};


function saveFrontendFiles(contract, name) {
    const fs = require("fs");
    const contractsDir = __dirname + "/../contractsData";

    if (!fs.existsSync(contractsDir)) {
        fs.mkdirSync(contractsDir);
    }

    fs.writeFileSync(
        contractsDir + `/${name}-address.json`,
        JSON.stringify({ address: contract.address }, undefined, 2)
    );

    const contractArtifact = artifacts.readArtifactSync(name);

    fs.writeFileSync(
        contractsDir + `/${name}.json`,
        JSON.stringify(contractArtifact, null, 2)
    );
}
const runMain = async () => {

        const contracts=['Transactions','VerifyProduct']
         contracts.map( async(name)=>{
             try {
             await main(name);
             process.exit(0);
         } catch (error) {
            console.error(error);
            process.exit(1);
        }
        })
};

runMain();
