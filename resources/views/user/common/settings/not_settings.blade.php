
@extends('user.layouts.main')

@section('content')
     
<div class="container">

        <div class="row mt-50">

                 @include('user.common.settings.sidebar')

                 <div class="col-lg-9 col-md-8 col-sm-8 set">
				<div class="head">
					<p class="setting">Settings<span class="slash">/</span>
						<span class="general">Notifications</span>
					</p>
				</div>
				<?php $notifications = json_decode(Auth::user()->notifications,true);
				 ?>
				<form class="editForm"  method="POST" 
				    action="{{ route('user.not_update', ['id' => Auth::user()->id])}}" >
				    	@csrf
					<div class="form spt">
						<div class="form-group pd-30">
							<div class="row">
								<div class="col-xl-3">
									<label for="name" class="label1">Newsletters</label>
								</div>
								<div class="col-xl-6">
									<ul class="checkall new-place">
										<li>
											<div class="main-tab">
												<span>
													<label class="cont">
														<input type="checkbox" name="newsletter" 
														 {{ !empty($notifications['newsletter']) ? 'checked="checked"' : '' }}>
														<span class="checkmark"></span>
													</label>	
												</span>
												<p> TheRisr updates, events, news </p>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-xl-3">
									<label for="exampleInputEmail1">Jobs</label>
								</div>
								<div class="col-xl-6">
									<ul class="checkall new-place">
										<li>
											<div class="main-tab">
												<span>
													<label class="cont">
														<input type="checkbox"  name="jobs"
														 {{ !empty($notifications['jobs']) ? 'checked="checked"' : '' }}>
														<span class="checkmark"></span>
													</label>	
												</span>
												<p> New job alerts </p>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="form-group mt-4 " style="">
							<div class="row">
								<div class="col-xl-3">
								</div>
								<div class="col-xl-6 col-lg-10">
									<div class="savewidth">
										<button type="submit" class="btn rectangle pull-left">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>  
	  

@endsection
@section('footer') 


@endsection