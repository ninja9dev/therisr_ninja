
@extends('user.layouts.main')

@section('content')
     
<div class="container">
        <div class="row mt-50">



                 @include('user.common.settings.sidebar')

            <div class="col-lg-9 col-md-8 col-sm-8 set">
				<div class="head">
					<p class="setting">Settings<span class="slash">/</span>
						<span class="general">General</span>
						<span><button type="button" class="btn btn1 link1 editSettings">Edit</button></span>
					</p>
				</div>
					<div class="showForm form form-input-set gnrl-set-mb">
						<div class=" form-group">
							<div class="row">
								<div class="col-xl-2">
									<label for="name" class="label1">Name</label>
								</div>
								<div class="col-xl-6">
									<input type="text" class="form-control t1" id="exampleInputname1" aria-describedby="emailHelp"
									 value="{{ Auth::user()->name }}" readonly="readonly">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-xl-2">
									<label for="exampleInputEmail1">Email</label>
								</div>
								<div class="col-xl-6">
									<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
									value="{{ Auth::user()->email }}" readonly="readonly">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-xl-2">
									<label for="username">Username</label>
								</div>
								<div class="col-xl-6">
									<input type="text" class="form-control" id="exampleInputname1" aria-describedby="emailHelp"
									value="{{ Auth::user()->username }}" readonly="readonly">
								</div>
							</div>
						</div>
					</div>

				

				<form class="editForm" style="display:none" method="POST" 
				    action="<?php echo route('user.gen_update', ['id' => Auth::user()->id]);?>" >
				    	@csrf
					<div class="form form-input-set gnrl-set-mb">
						<div class=" form-group">
							<div class="row">
								<div class="col-xl-2">
									<label for="name" class="label1">Name</label>
								</div>
								<div class="col-xl-6">
									<input type="text" class="form-control t1" name="name" aria-describedby="emailHelp"
									 value="{{ Auth::user()->name }}">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-xl-2"> 
									<label for="email">Email</label>
								</div>
								<div class="col-xl-6">
									<input type="email" class="form-control" name="email" aria-describedby="emailHelp"
									value="{{ Auth::user()->email }}" readonly="readonly">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-xl-2">
									<label for="username">Username</label>
								</div>
								<div class="col-xl-6">
									<input type="text" class="form-control" name="username" aria-describedby="emailHelp"
									value="{{ Auth::user()->username }}" readonly="readonly">
								</div>
							</div>
						</div>
						<div class="form-group mt-4" >
							<div class="row">
								<div class="col-xl-2">
								</div>
								<div class="col-xl-6 col-lg-10">
									<div class="savewidth">
										<button type="submit" class="btn rectangle">Save</button>
										<button type="button" class="btn cancel">Cancel</button>
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
<script type="text/javascript">
		$(document).ready(function(){
			$(".editSettings").click(function(){
				$(".editForm").toggleClass("main");
				$(".showForm").toggleClass('hide');
				$(".editSettings").toggleClass("hide");
			});
			$(".cancel").click(function(){
				$(".editForm").toggleClass("main");
				$(".showForm").toggleClass('hide');
				$(".editSettings").toggleClass("hide");
			});
		});
</script>

@endsection