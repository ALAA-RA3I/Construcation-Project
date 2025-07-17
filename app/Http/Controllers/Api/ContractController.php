<?php

namespace App\Http\Controllers\Api;

use App\Domain\Services\IPFSServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ContractController extends Controller
{
    protected $ipfsService;

    public function __construct(IPFSServiceService $ipfsService)
    {
        $this->ipfsService = $ipfsService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'document' => 'required|file|mimes:pdf|max:5120',
        ]);

        $file = $request->file('document');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('contracts', $fileName, 'public');
        $fullPath = Storage::disk('public')->path($filePath);

        $cid = $this->ipfsService->uploadFile($fullPath, $fileName);

        // Example: Save to DB if you have a Contract model
        // $contract = Contract::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'file_name' => $fileName,
        //     'ipfs_cid' => $cid,
        // ]);

        return response()->json([
            'message' => 'تم رفع العقد بنجاح',
            // 'contract' => $contract,
            'ipfs_url' => "https://gateway.pinata.cloud/ipfs/$cid"
        ], 201);
    }

    public function show($cid)
    {
        // Example: Fetch from DB if you have a Contract model
        // $contract = Contract::findOrFail($id);
        // $cid = $contract->ipfs_cid;
        return response()->json([
            // 'contract' => $contract,
            'ipfs_url' => "https://gateway.pinata.cloud/ipfs/{$cid}"
        ]);
    }
}
