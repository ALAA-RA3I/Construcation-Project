<?php


namespace App\Application\DTO\ProjectFilesDTO;

class projectFileDTO{
    public static function fromCreateRequest(array $data) {
        return [
          'file' => $data['file'],
          'description' => $data['description']
        ];
    }
}
