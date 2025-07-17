<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Infrastructure\Repositories\Contracts\StripeRepositoryInterface;
use App\Domain\Services\Contracts\StripeServiceInterface;
use App\Helpers\ApiResponse;
use App\Infrastructure\Repositories\Contracts\UserPropertyUnitInstallmentsRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Stripe;

class StripeService implements StripeServiceInterface
{
    protected $installmentsRepo;

    public function __construct(UserPropertyUnitInstallmentsRepositoryInterface $installmentsRepo)
    {
        $this->installmentsRepo = $installmentsRepo;
    }

    public function doPayment(array $data,$billId)
    {
        $client = Auth::guard('api-client')->user()->id;
        Stripe::setApiKey(config('stripe.stripe-secret'));
        $bill = $this->installmentsRepo->findOrFail($billId);
        try{
            Charge::create([
                'amount' => $bill->amount *100,
                'currency' => 'usd',
                'source' => $data['stripe_token'],
                // 'source'=>'tok_visa',
                'description' => 'bill payement successfully done :)',
                    'metadata' => [
                        'user_id' => $client,
                        'bill_id' => $billId,
                    ]
            ]);
        $updatedData = [
            'is_paid' => true,
        ];

        $this->installmentsRepo->update($updatedData,$billId);

        }catch(Exception $e){
            return ApiResponse::error('Somethin went wrong :(', $e->getMessage());
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