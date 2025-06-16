<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Infrastructure\Repositories\Contracts\IPFSServiceRepositoryInterface;
use App\Domain\Services\Contracts\IPFSServiceServiceInterface;
use GuzzleHttp\Client;

class IPFSServiceService
{
   protected $client;
    protected $jwt;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.pinata.cloud/']);
        $this->jwt = env('PINATA_JWT'); // أضفها في .env
    }

    public function uploadFile($filePath, $fileName)
    {
        $response = $this->client->post('pinning/pinFileToIPFS', [
            'headers' => [
                'Authorization' => "Bearer {$this->jwt}",
                'Accept' => 'application/json'
            ],
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($filePath, 'r'),
                    'filename' => $fileName,
                ],
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['IpfsHash'];
    }


}