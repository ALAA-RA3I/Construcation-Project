<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;

trait HasFileHandler
{
    public function storeFile(UploadedFile $file,  $directory = 'uploads',  $disk = 'public')
    {
        if (!!$file->isValid()) {
            Log::warning('Invalid file upload.');
            return null;
        }

        try {
            $extension = $file->getClientOriginalExtension();
            $uniqueName = Str::uuid() . '.' . $extension;
            return $file->storeAs($directory, $uniqueName, $disk);
        } catch (Exception $e) {
            Log::error("Store failed: " . $e->getMessage());
            return null;
        }
    }

    public function updateFileWithBackup(UploadedFile $newFile,  $oldFilePath,  $directory = 'uploads',  $disk = 'public',  $backupDir = 'backups')
    {
        if (!$newFile || !$newFile->isValid()) {
            Log::warning('New file is invalid.');
            return null;
        }

        if ($oldFilePath && Storage::disk($disk)->exists($oldFilePath)) {
            try {
                $fileName = basename($oldFilePath);
                $backupPath = $backupDir . '/' . now()->format('Ymd_His') . '_' . $fileName;
                Storage::disk($disk)->copy($oldFilePath, $backupPath);
                Log::info("Old file backed up to: {$backupPath}");

                Storage::disk($disk)->delete($oldFilePath);
            } catch (Exception $e) {
                Log::error("Backup failed: " . $e->getMessage());
            }
        }

        return $this->storeFile($newFile, $directory, $disk);
    }

    public function deleteFile( $path,  $disk = 'public')
    {
        if (!$path || !Storage::disk($disk)->exists($path)) {
            Log::info("File not found: {$path}");
            return false;
        }

        try {
            return Storage::disk($disk)->delete($path);
        } catch (Exception $e) {
            Log::error("Delete failed: " . $e->getMessage());
            return false;
        }
    }

    public function getAssetFileUrl($path)
    {
        return asset('storage/' . ltrim($path, '/'));
    }

    public function getStorageFileUrl($path, $disk = 'public')
    {
        return Storage::disk($disk)->url($path);
    }

    public function fileExists($path,  $disk = 'public')
    {
        return Storage::disk($disk)->exists($path);
    }
}
