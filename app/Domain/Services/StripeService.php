<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Infrastructure\Repositories\Contracts\StripeRepositoryInterface;
use App\Domain\Services\Contracts\StripeServiceInterface;
use App\Helpers\ApiResponse;
use App\Infrastructure\Repositories\Contracts\PropertyBookRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\PropertyUnitOrderRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\UserPropertyUnitInstallmentsRepositoryInterface;
use App\Models\PropertyUnitOrder;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Charge;
use Stripe\Stripe;

class StripeService implements StripeServiceInterface
{
    protected $installmentsRepo;
    protected $propertyBookRepo;
    protected $propertyUnitOrder;

    public function __construct(UserPropertyUnitInstallmentsRepositoryInterface $installmentsRepo,
                                PropertyBookRepositoryInterface $propertyBookRepo,
                                PropertyUnitOrderRepositoryInterface $propertyUnitOrder)
    {
        $this->installmentsRepo = $installmentsRepo;
        $this->propertyBookRepo = $propertyBookRepo;
        $this->propertyUnitOrder = $propertyUnitOrder;
    }

    public function doPayment(array $data,$billId)
    {
        $client = Auth::guard('api-client')->user()->id;
        Stripe::setApiKey(config('stripe.stripe-secret'));
        $bill = $this->installmentsRepo->findOrFail($billId);
        $billStatus = $bill->is_paid;
        $billDetail = $bill->propertyBookBill;
        $billAmount = $billDetail->amount;
        // dump($billAmount);

        if ($billStatus) {
            return [
                'success' => false,
                'message' => 'Payment failed, The bill already paid',
            ];
        }
        try{
            $charge = Charge::create([
                'amount' => $billAmount *100,
                'currency' => 'usd',
                'source' => $data['stripe_token'],
                // 'source'=>'tok_visa',
                'description' => 'bill payement successfully done :)',
                    'metadata' => [
                        'user_id' => $client,
                        'bill_id' => $billDetail->id,
                    ]
            ]);

        if ($charge->status !== 'succeeded') {
            return [
                'success' => false,
                'message' => 'Payment failed',
                'charge' => $charge
            ];
        }
        $updatedData = [
            'is_paid' => true,
        ];

        $this->installmentsRepo->update($updatedData,$billId);

        return [
            'success' => true,
            'message' => 'Payment done successfully',
            'charge' => $charge
        ];

        }catch(Exception $e){
            return [
            'success' => false,
            'message' => $e->getMessage()
            ];        
        }
    }

    public function doFirstPayment($bookId) {
        $stripeSecretKey = config('stripe.stripe-secret');
        $stripe = new \Stripe\StripeClient($stripeSecretKey);
        $firstPayment = $this->propertyBookRepo->findOrFail($bookId);
        $amount = $firstPayment->first_payment_amount;
        // $client = Auth::guard('api-client')->user()->id;

        try{
            $checkout_session = $stripe->checkout->sessions->create([
                'ui_mode' => 'embedded',
                'line_items' => [[
                    # Provide the exact Price ID (e.g. price_1234) of the product you want to sell
                    'price_data' => [
                        'unit_amount' => $amount * 100,
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'First Payment',
                            'description' => 'first payment of the contract successfully done :)',
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'return_url' => route('myOrders'),
                'metadata' => [
                    'property_book_id' => $bookId, 
                ], 
            ]);

            $updatedData = [
                'payment_amount' => $amount,
                'payment_completed_at' => now(),
            ];
            Log::info($bookId);
            $unitId = $this->propertyUnitOrder->findWhere([
                'property_book_id' => $bookId,
                'client_id' => 1
            ])->first();
            Log::info($unitId);
            $this->propertyUnitOrder->update($updatedData,$unitId->id);
        return ['clientSecret' => $checkout_session->client_secret];
        }catch(Exception $e) {
            Log::info($e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    public function getAll()
    {
        //return $this->stripeRepo->all();
    }

    public function paginate()
    {
        // return $this->stripeRepo->paginate();
    }

    public function create(array $data)
    {
        // return $this->stripeRepo->create($data);
    }

    public function show($id)
    {
        // return $this->stripeRepo->find($id);
    }

    public function update($id, array $data)
    {
        // return $this->stripeRepo->update($data, $id);
    }

    public function delete($id)
    {
        // return $this->stripeRepo->delete($id);
    }
}