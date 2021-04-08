<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User, App\Models\Timezone, App\Models\UserEmpProfile, 
App\Models\JobContract, App\Models\JobContractEarnings, App\Models\JobContractTimesheet, 
App\Models\JobContractMilestones, App\Models\Transactions;
use DB;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\PaymentIntent;
   
class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */ 
    public function __construct()
    {
        $this->middleware('auth');
        // get global settings
        $this->middleware(function ($request, $next) {
            $this->settings = $request->get('settings');
            return $next($request);
       });
    }

    // stripe connect
    function stripe_connect(Request $request){
        //dd($request->all());
        try {
          	if(!empty($this->settings->stripe_mode) &&
            	 (!empty($this->settings->stripe_test_secret_key) || !empty($this->settings->stripe_live_secret_key)) ){

            		$key = ($this->settings->stripe_mode == 'SANDBOX') 
                           ? $this->settings->stripe_test_secret_key 
                           : $this->settings->stripe_live_secret_key;
            	}else{

                 $key = ( env('stripe_mode') == 'SANDBOX') 
                          ? env('STRIPE_TEST_SECRET_KEY') 
                          : env('STRIPE_LIVE_SECRET_KEY');
            	}

  		    Stripe::setApiKey($key);

          // create customer
          if(!empty($request->stripeToken) && empty($request->customerId)){
      		    $customer = Customer::create(array(
      		        'email' => $request->stripeEmail,
      		        'source' => $request->stripeToken,
                  'name' => Auth::user()->name,
                  'address' => [
                      'line1' => '510 Townsend St',
                      'postal_code' => '98140',
                      'city' => (Auth::user()->user_type == 1) ? Auth::user()->userProfile->city : Auth::user()->userEmpProfile->city,
                      'state' => 'CA',
                      'country' => !empty(Auth::user()->countryName['country_name'] ) ? Auth::user()->countryName['country_name']  : '',
                  ],
      		    ));
      		    //dd($customer);

      		    $user = User::findOrFail(Auth::user()->id);
      	      $user->stripe_customer_id = $customer->id; 
      	      $user->update();
          }


        // need to pay amount now
        if(!empty($request->amount_to_pay)){
            $amout_charge = $request->amount_to_pay * 100;
            $contract = JobContract::findOrFail($request->contract_id);
              $charge = Charge::create(array(
                 'customer' => !empty($request->customerId) ? $request->customerId : $customer->id,
                 'amount' => $amout_charge,
                // 'application_fee_amount' => !empty($this->settings->service_fee) ? round(($amout_charge * $this->settings->service_fee)/100) : 0,
                 'currency' => (!empty($this->settings->currency_code)  ? $this->settings->currency_code  : 'USD'),
                 'description' => !empty($contract) ? $contract->job_title.'- payment' :  ' payment',
             ));

     // Create a PaymentIntent:
// $paymentIntent = \Stripe\PaymentIntent::create([
//   'amount' => 1000,
//   'currency' => 'USD',
//   'payment_method_types' => ['card'],
//   'transfer_group' => '{ORDER10}',
// ]);



// Create a Transfer to a connected account (later):
// $transfer = \Stripe\Transfer::create([
//   'amount' => 100,
//   'currency' => 'USD',
//   'destination' => 'acct_1IVE9wQxqUSY0yj7',
//   'transfer_group' => '{ORDER10}',
// ]);
           
// echo "<pre>";
// print_r($transfer);die;
            //dd($paymentIntent);
            if($charge->status == 'succeeded'){
              $charge_id = $charge->id;
              $match = array(
                'contract_id' => !empty($contract) ? $contract->id : 0,
                'charge_id'  => $charge_id
              );
              $saveData = array(
                'contract_id' => !empty($contract) ? $contract->id : 0,
                'contract_type' => !empty($contract) ? $contract->contract_type : 0,
                'job_id'      => !empty($contract) ? $contract->job_id : 0,
                'charge_id'   => $charge_id,
                'earning_for' => $request->pay_ids,
                'amount'      => $request->amount_to_pay,
                'status'      => 2
              );
              JobContractEarnings::updateOrCreate($match,$saveData);  

              if($contract->contract_type == 2){
                // update milestone status to completed on payment
                $saveData = array('status' => 2);
                JobContractMilestones::whereIn('id',explode(',',$request->pay_ids))->update($saveData);
              }else{
                // update milestone status to completed on payment
                $saveData = array('status' => 2);
                JobContractTimesheet::whereIn('id',explode(',',$request->pay_ids))->update($saveData);
              } 
            } 
            $match = array(
              'user_id'     => Auth::user()->id,
              'contract_id' => !empty($contract) ? $contract->id : 0,
              'charge_id'  => $charge_id
            );
            $saveData = array(
              'user_id'     => Auth::user()->id,
              'contract_id' => !empty($contract) ? $contract->id : 0,
              'contract_type' => !empty($contract) ? $contract->contract_type : 0,
              'job_id'      => !empty($contract) ? $contract->job_id : 0,
              'charge_id'   => $charge_id,
              'charge'      => $charge,
              'amount'      => $request->amount_to_pay,
              'status'      => $charge->status
            );
            Transactions::updateOrCreate($match,$saveData);
            Session::flash('message', 'Payment has been completed successfully!!');
          return redirect()->back();  
        }else{
  	       Session::flash('message', 'Your stripe has been connected successfully!!');
  	       return redirect(route('user.pay_settings'));  
        }
  		} catch (\Exception $ex) {

  		    return $ex->getMessage();

  		}

  }


}

