<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Traits\HasFileHandler;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class VerifyDocumentController extends Controller
{
    use HasFileHandler;

 
 
public function upload(Request $request)
{
    $request->validate([
        'contract' => 'required|file|mimes:pdf',
    ]);

    $file = $request->file('contract');
    $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

    $path = $file->storeAs('uploads', $filename, 'public');
    $fullPath = storage_path('app/public/' . $path);

    if (!file_exists($fullPath)) {
        return response()->json([
            'status' => false,
            'message' => 'الملف غير موجود بعد التخزين.',
        ]);
    }

    $hash = hash_file('sha256', $fullPath);

    $client = new Client();
    $response = $client->post('https://api.nft.storage/upload', [
        'headers' => [
            'Authorization' => 'Bearer ' . env('NFT_STORAGE_TOKEN'),
            'Accept' => 'application/json',
        ],
        'body' => fopen($fullPath, 'r'),
    ]);

    $data = json_decode($response->getBody(), true);

    if (!isset($data['ok']) || !$data['ok']) {
        return response()->json([
            'status' => false,
            'message' => 'فشل رفع الملف إلى IPFS',
            'ipfs_response' => $data,
        ]);
    }

    $cid = $data['value']['cid'];

    return response()->json([
        'status' => true,
        'message' => 'تم رفع وتوثيق الملف بنجاح.',
        'data' => [
            'cid' => $cid,
            'ipfs_url' => "https://{$cid}.ipfs.dweb.link",
            'hash' => $hash,
        ],
    ]);
}




    public function verify(Request $request, $id)
    {
        $request->validate(['contract' => 'required|file|mimes:pdf']);

        $document = Document::findOrFail($id);
        $uploadedHash = hash_file('sha256', $request->file('contract')->getRealPath());

        if ($uploadedHash === $document->hash) {
            return response()->json(['status' => 'valid', 'message' => 'العقد لم يتم تعديله.']);
        } else {
            return response()->json(['status' => 'invalid', 'message' => 'العقد تم تعديله أو مختلف.']);
        }
    }

    public function show($id)
    {
        $document = Document::findOrFail($id);
        return response()->json([
            'id' => $document->id,
            'filename' => $document->filename,
            'ipfs_link' => "https://{$document->ipfs_cid}.ipfs.dweb.link",
            'hash' => $document->hash,
            'created_at' => $document->created_at,
        ]);
    }
}
//18442230.c4c4bb8e4e23454b864b6f1fa4ba2bf9