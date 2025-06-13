<?php

namespace App\Application\DTO\BackupfileDTO;

use Illuminate\Http\UploadedFile;

class BackupfileDTO
{
    public UploadedFile $file;
    public string $version;

    private function __construct(UploadedFile $file, string $version)
    {
        $this->file = $file;
        $this->version = $version;
    }

    public static function fromCreateRequest(array $data): self
    {
        return new self(
            $data['file'],
            $data['version']
        );
    }
}
