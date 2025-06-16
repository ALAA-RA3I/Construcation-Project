<?php

namespace App\Http\Controllers;

use App\Domain\Services\IPFSServiceService;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $contract = Contract::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_name' => 'test',
            'ipfs_cid' => $cid,
        ]);

        return response()->json([
            'message' => 'تم رفع العقد بنجاح',
            'contract' => $contract,
            'ipfs_url' => "https://gateway.pinata.cloud/ipfs/$cid"
        ], 201);
    }

    public function show($id)
    {
        $contract = Contract::findOrFail($id);

        return response()->json([
            'contract' => $contract,
            'ipfs_url' => "https://gateway.pinata.cloud/ipfs/{$contract->ipfs_cid}"
        ]);
    }
  public function verifyContract(Request $request, $id)
{
    $request->validate([
        'document' => 'required|file|mimes:pdf|max:5120',
    ]);

    $contract = Contract::findOrFail($id);

    $file = $request->file('document');
    $fileName = time() . '_' . $file->getClientOriginalName();

    // تأكد من وجود مجلد temp
    Storage::disk('local')->makeDirectory('temp');

    // خزّن الملف مؤقتًا
    $filePath = $file->storeAs('temp', $fileName, 'local');
    $fullPath = Storage::disk('local')->path($filePath);

    // حساب CID
    $computedCID = $this->ipfsService->getFileCID($fullPath, $fileName);

    // حذف الملف بعد الاستخدام
    unlink($fullPath);

    $isValid = ($computedCID === $contract->ipfs_cid);

    return response()->json([
        'contract_id' => $id,
        'stored_cid' => $contract->ipfs_cid,
        'computed_cid' => $computedCID,
        'is_valid' => $isValid,
        'message' => $isValid ? 'العقد سليم ولم يتم تغييره.' : 'العقد تم تغييره أو غير مطابق.',
    ]);
}

}
