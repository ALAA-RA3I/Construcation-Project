<?php

namespace App\Http\Controllers\Clients;

use App\Application\DTO\StripeDTO\StripeDTO;
use App\Domain\Services\Contracts\StripeServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stripe\StripeFormRequest;
use Illuminate\Http\Request;

class stripeController extends Controller
{
    protected $stripeService;

    public function __construct(StripeServiceInterface $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function doPayment (StripeFormRequest $data, $id) {
        $validatedData = StripeDTO::doPaymentRequest($data->validated());
        $response = $this->stripeService->doPayment($validatedData,$id);
        // dd($response);

        if (!$response['success']) {
        return ApiResponse::error($response['message']);
        }

        return ApiResponse::success($response['message'], [
            'charge_id' => $response['charge']->id ?? null
        ]);
    }

    public function doFirstPayment($id) {
        return $this->stripeService->doFirstPayment($id);
    }
}
