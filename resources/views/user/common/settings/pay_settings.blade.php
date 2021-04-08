
@extends('user.layouts.main')

@section('content')
     
<div class="container">

        <div class="row mt-50">

                 @include('user.common.settings.sidebar')
                 
			<div class="col-lg-9 col-md-8 col-sm-8 set">
				<div class="head">
					<p class="setting">Settings<span class="slash">/</span>
						<span class="general">Payment method</span>
					</p>
				</div>
				
					<div class="form spt">
						<div class="form-group pd-30"> 
							<div class="row">
								<div class="col-xl-3">
									<label for="name" class="label1">Add Connection</label>
								</div>
								<div class="col-xl-9">
									
								</div>
							</div>
						</div>
						<div class="form-group pd-30">
							<div class="row">
								<div class="col-xl-3 col-sm-4 col-4">
									<label for="exampleInputEmail1">Stripe</label>
								</div> 
								@if(Auth::user()->stripe_customer_id != null && Auth::user()->stripe_customer_id != '')
								 <div class="col-xl-6 col-sm-8 col-8 text-center"> 
								 	<button class="connect">Connected</button>
								 </div>
								@else
								<div class="col-xl-6 col-sm-8 col-8 text-center">

									 <form method="POST" action="{{ route('user.stripe_connect') }}">
                                        {{ csrf_field() }}
							          	<?php  
							          	if(!empty($settings->stripe_mode) &&
							          	 (!empty($settings->stripe_test_pub_key) || !empty($settings->stripe_live_pub_key)) ){
							          		$key = ($settings->stripe_mode == 'SANDBOX') ? $settings->stripe_test_pub_key : $settings->stripe_live_pub_key;
							          	}else{
							               $key = ( env('stripe_mode') == 'SANDBOX') ? env('STRIPE_TEST_PUB_KEY') : env('STRIPE_LIVE_PUB_KEY');
							          	}
							          	?>
								            <script
								                    src="https://checkout.stripe.com/checkout.js" 
								                    class="stripe-button connect"
								                    data-key="{{ $key }}"
								                    data-amount="0"
								                    data-name="Connect to Stripe"
								                    data-description="TheRisr Stripe account connect"
								                    data-image="{{ asset('assets/img/logo.png')}}"
								                    data-locale="auto"
								                    data-label="Connect"
								                    data-currency="{{ (!empty($settings->currency)  ? $settings->currency  : 'USD') }}">
								            </script> 
								            <script>
										        // Hide default stripe button, be careful there if you
										        // have more than 1 button of that class
										        document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';
										    </script>
										    <button class="connect" type="submit">Connect</button>
							           </form>
								</div>
								@endif
							</div>
						</div>
						<!-- paypal hide as discussed with Kunal Sir -->
						<!-- <div class="form-group mt-5">
							<div class="row">
								<div class="col-xl-3 col-sm-4 col-4">
									<label for="exampleInputEmail1">Paypal</label>
								</div>
								<div class="col-xl-6 col-sm-8 col-8 text-center">
									<button class="connect">Connect</button>

								</div>
							</div>
						</div> -->
						<div class="form-group">
							<div class="row">
								<div class="col-xl-2">
									<label for="exampleInputEmail1"></label>
								</div>
								<div class="col-xl-10">
									<p class="note">Still have questions about the payment method? <a href="javascript:void(0)">Contact us</a></p>
								</div>
							</div>
						</div>
						
					</div>
			</div>
		</div>
	</div>  
	  


@endsection
@section('footer') 

@endsection