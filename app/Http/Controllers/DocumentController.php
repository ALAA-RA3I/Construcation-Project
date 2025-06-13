<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Web3\Web3;
use Web3\Contract;

class DocumentController extends Controller
{
    protected $web3;
    protected $contract;

    public function __construct()
    {
        $provider = env('WEB3_PROVIDER');
        $this->web3 = new Web3($provider);

        $abi = json_decode(Storage::get('abi/contract_abi.json'), true);
        $this->contract = new Contract($provider, $abi);
        $this->contract->at(env('CONTRACT_ADDRESS'));
    }

    public function notarize(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf|max:5120',
        ]);

        // 🧾 1. احفظ الملف مؤقتاً
        $file = $request->file('document');
        $path = $file->store('contracts');

        // 🔐 2. احسب الـ Hash
        $hash = hash_file('sha256', storage_path('app/' . $path));

        // 📤 3. أرسل الـ Hash إلى البلوكتشين
        $from = env('WALLET_ADDRESS'); // محفظتك اللي فيها Sepolia ETH

        $this->contract->send('storeDocumentHash', $hash, [
            'from' => $from,
            'gas' => '0x76c0',          // 30400
            'gasPrice' => '0x9184e72a000' // 10000000000000
        ], function ($err, $tx) use (&$response) {
            if ($err !== null) {
                $response = response()->json(['error' => $err->getMessage()], 500);
                return;
            }
            $response = response()->json([
                'message' => 'Document hash stored on blockchain',
                'tx' => $tx
            ]);
        });

        return $response;
    }

    public function verify(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf|max:5120',
        ]);

        // 🧾 1. احفظ الملف مؤقتاً
        $file = $request->file('document');
        $path = $file->store('temp');

        // 🔐 2. احسب الـ Hash
        $hash = hash_file('sha256', storage_path('app/' . $path));

        // 🔍 3. تحقق من وجود الـ Hash في العقد
        $exists = null;

        $this->contract->call('isDocumentHashStored', $hash, function ($err, $res) use (&$exists) {
            if ($err !== null) {
                $exists = response()->json(['error' => $err->getMessage()], 500);
                return;
            }
            $exists = response()->json([
                'exists' => $res[0],
                'hash' => $res[0] ? '✅ hash found on blockchain' : '❌ hash not found',
            ]);
        });

        return $exists;
    }
}
