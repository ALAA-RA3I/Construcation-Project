<?php

namespace App\Http\Controllers\View;

use App\Application\DTO\PropertyUnitOrderDTO\PropertyUnitOrderDTO;
use App\Domain\Services\Contracts\PropertyUnitOrderServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyUnitOrder\CreatePropertyUnitOrderRequest;
use App\Infrastructure\Repositories\Contracts\PropertyUnitOrderRepositoryInterface;
use App\Models\PropertyUnitOrder;
use App\Traits\HasFileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ClientOrderController extends Controller
{
    use HasFileHandler;
    private $propertyUnitOrderService;
    protected $client;
    protected $jwt;

    public function __construct(PropertyUnitOrderServiceInterface $propertyUnitOrderService)
    {
        $this->propertyUnitOrderService = $propertyUnitOrderService;
        $this->client = new Client(['base_uri' => 'https://api.pinata.cloud/']);
        $this->jwt = env('PINATA_JWT'); // أضفها في .env

    }
    public function create(CreatePropertyUnitOrderRequest $request)
    {
        $data = PropertyUnitOrderDTO::fromCreateRequest($request->validated());
        $order = $this->propertyUnitOrderService->create($data);

        if (!$order) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
        return redirect()->back()->with('success', 'Order Registered successfully.');
    }
    public function cancel($id)
    {

        $result = $this->propertyUnitOrderService->cancelOrderFromClient($id);

        if (!$result) {
            return redirect()->back()->with('error', 'Failed to cancel order or order was already cancelled');
        }

        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }
    public function myOrders()
    {
        // Assuming logged-in client is authenticated via `auth('client')`
        $clientId = auth('client')->id();

        $orders = $this->propertyUnitOrderService->getClientOrders($clientId);
        $orders->getCollection()->transform(function ($item) {
            $item->contract_file = $item->contract_file ? $this->getAssetFileUrl($item->contract_file) : null;
            return $item;
        });

        // return $orders;
        return view('pages.clientOrders.my-orders', compact('orders'));
    }
    public function verifyMyContract(Request $request, $id)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf|max:5120',
        ]);

        $order = PropertyUnitOrder::findOrFail($id);

        $file = $request->file('document');
        $fileName = time() . '_' . $file->getClientOriginalName();

        // تأكد من وجود مجلد temp
        Storage::disk('local')->makeDirectory('temp');

        // خزّن الملف مؤقتًا
        $filePath = $file->storeAs('temp', $fileName, 'local');
        $fullPath = Storage::disk('local')->path($filePath);

        // حساب CID
        $computedCID = $this->getFileCID($fullPath, $fileName);

        // حذف الملف بعد الاستخدام
        unlink($fullPath);

        $isValid = ($computedCID === $order->contract_hash);

        // رجع Redirect مع رسالة 
        Log::info('Verification Result', [
            'order_id'    => $id,
            'stored_cid'  => $order->contract_hash,
            'computed_cid' => $computedCID,
            'is_valid'    => $isValid,
            'message'     => $isValid
                ? ' العقد سليم ولم يتم تغييره.'
                : ' العقد تم تغييره أو غير مطابق.',
        ]);
        return redirect()->back()->with([
            'verify_result' => [
                'order_id'    => $id,
                'stored_cid'  => $order->contract_hash,
                'computed_cid' => $computedCID,
                'is_valid'    => $isValid,
                'message'     => $isValid
                    ? ' العقد سليم ولم يتم تغييره.'
                    : ' العقد تم تغييره أو غير مطابق.',
            ]
        ]);
    }

    public function getFileCID($filePath, $fileName)
    {
        if (!file_exists($filePath)) {
            throw new \Exception("File does not exist: " . $filePath);
        }

        $response = $this->client->post('pinning/pinFileToIPFS', [
            'headers'   => [
                'Authorization' => 'Bearer ' . $this->jwt,
                'Accept'        => 'application/json',
            ],
            'multipart' => [[
                'name'     => 'file',
                'contents' => fopen($filePath, 'r'),
                'filename' => $fileName,
            ]],
        ]);
        $data = json_decode($response->getBody(), true);
        return $data['IpfsHash'];
    }
    public function show(propertyUnitOrder $order)
    {
         return view('pages.clientOrders.verify', compact('order'));
    }
}
