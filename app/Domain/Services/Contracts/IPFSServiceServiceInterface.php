<?php

namespace App\Domain\Services\Contracts;

interface IPFSServiceServiceInterface
{
    /**
     * Upload a file to IPFS via Pinata
     * @param string $filePath
     * @param string $fileName
     * @return string|null The IPFS hash (CID) or null on failure
     */
    public function uploadFile($filePath, $fileName);
}
