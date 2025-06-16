<?php
namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\BlockchainService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    protected $blockchainService;
    
    public function __construct(BlockchainService $blockchainService)
    {
        $this->blockchainService = $blockchainService;
    }
    
    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }
    
    public function create()
    {
        return view('documents.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'document' => 'required|file|mimes:pdf,doc,docx,txt|max:10240',
        ]);
        
        // Store the file locally
        $file = $request->file('document');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents', $fileName, 'public');
        
        // Upload to IPFS
        $fullPath = Storage::disk('public')->path($filePath);
        $ipfsHash = $this->blockchainService->uploadToIPFS($fullPath);
        
        // Store hash on blockchain
        $txHash = $this->blockchainService->storeDocumentHash($ipfsHash);
        
        // Create document record
        Document::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_name' => $fileName,
            'file_path' => $filePath,
            'ipfs_hash' => $ipfsHash,
            'blockchain_tx_hash' => $txHash,
            'is_verified' => true,
        ]);
        
        return redirect()->route('documents.index')
            ->with('success', 'Document uploaded and verified successfully!');
    }
    
    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }
    
    public function verify(Document $document)
    {
        $isVerified = $this->blockchainService->verifyDocument(
            $document->ipfs_hash,
            $document->blockchain_tx_hash
        );
        
        $document->update(['is_verified' => $isVerified]);
        
        return redirect()->route('documents.show', $document)
            ->with('success', $isVerified ? 'Document verified successfully!' : 'Document verification failed!');
    }
}
