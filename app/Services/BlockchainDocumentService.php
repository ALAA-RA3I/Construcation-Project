<?php

namespace App\Services;

use Web3\Web3;
use Web3\Contract;
use Illuminate\Support\Facades\Storage;

class BlockchainDocumentService
{
    protected $web3;
    protected $contract;
    protected $account;

    public function __construct()
    {
        $this->web3 = new Web3(config('app.web3_provider'));

        $abi = json_decode(Storage::get('abi/contract_abi.json'), true);
        $this->contract = new Contract(config('app.web3_provider'), $abi);
        $this->contract->at(env('CONTRACT_ADDRESS'));
    }

    public function storeDocumentHash(string $hash): bool
    {
        $from = env('WALLET_ADDRESS'); // ضع عنوان محفظتك التي فيها Sepolia ETH

        $this->contract->send('storeDocumentHash', $hash, [
            'from' => $from,
            'gas' => '0x76c0',
            'gasPrice' => '0x9184e72a000'
        ], function ($err, $tx) {
            if ($err !== null) {
                throw new \Exception("Blockchain error: " . $err->getMessage());
            }
        });

        return true;
    }

 public function verifyHash(string $hash)
{
    $result = null;
    $this->contract->call('isDocumentHashStored', $hash, function ($err, $res) use (&$result) {
        if ($err !== null) {
            throw new \Exception("Blockchain error: " . $err->getMessage());
        }
        if ($res !== null && is_array($res)) {
            $result = $res[0];
        }
    });

    return $result;
}
}
