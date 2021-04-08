	<div class="col-lg-3 col-md-4 col-sm-4">
		<div class="card self-design employr-resve">
			<div class="card-body">
                <ul class="list-group">
					<span class="text text-secondary">SETTINGS</span>
					<li class="list-group-item"><a  class="{{ (Route::current()->getName() == 'user.gen_settings') ? 'act' : '' }}" 
                            href="{{ route('user.gen_settings') }}" >General</a></li>

					<li class="list-group-item"><a class="{{ (Route::current()->getName() == 'user.pay_settings') ? 'act' : '' }}" 
                            href="{{ route('user.pay_settings') }}">Payment method</a></li>

					<li class="list-group-item"><a  class="{{ (Route::current()->getName() == 'user.pass_settings') ? 'act' : '' }}" 
                            href="{{ route('user.pass_settings') }}">Password</a></li>

					<li class="list-group-item"><a class="{{ (Route::current()->getName() == 'user.not_settings') ? 'act' : '' }}" 
                            href="{{ route('user.not_settings') }}">Notification</a></li>
                    
                    @if($user->user_type == '1')
					<li class="list-group-item"><a  class="{{ (Route::current()->getName() == 'user.editprofile') ? 'act' : '' }}" 
                            href="{{ route('user.editprofile') }}">Job Profile</a></li>
                    @endif
				</ul>
			</div>
        </div>
	</div>