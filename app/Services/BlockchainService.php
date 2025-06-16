<?php

namespace App\Services;

use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use GuzzleHttp\Client;

class BlockchainService
{
    protected $web3;
    protected $eth;
    protected $contract;
    protected $contractAddress;
    protected $contractABI;
    
    public function __construct()
    {
        // Use Infura's free Sepolia testnet endpoint
        $this->web3 = new Web3(new HttpProvider(new HttpRequestManager(
            env('ETHEREUM_NODE_URL', 'https://sepolia.infura.io/v3/YOUR_INFURA_PROJECT_ID')
        )));
        
        $this->eth = $this->web3->eth;
        
        // Your deployed smart contract address and ABI
        $this->contractAddress = env('CONTRACT_ADDRESS');
        $this->contractABI = json_decode(file_get_contents(storage_path('app/contract_abi.json')), true);
    }
    
    public function uploadToIPFS($filePath)
    {
        // Using web3.storage API (free tier)
        $client = new Client();
        
        $response = $client->request('POST', 'https://api.web3.storage/upload', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('WEB3_STORAGE_API_KEY'),
                'Accept' => 'application/json',
            ],
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => fopen($filePath, 'r'),
                ],
            ],
        ]);
        
        $result = json_decode($response->getBody()->getContents(), true);
        return $result['cid']; // This is the IPFS hash (CID)
    }
    
    public function storeDocumentHash($documentHash)
    {
        // This would interact with your smart contract to store the hash
        // For simplicity, we'll just return a mock transaction hash
        // In a real implementation, you would use web3.php to send a transaction
        
        // Mock implementation
        return '0x' . bin2hex(random_bytes(32));
    }
    
    public function verifyDocument($ipfsHash, $blockchainHash)
    {
        // In a real implementation, you would verify the document hash on the blockchain
        // For simplicity, we'll just return true
        return true;
    }
}