<?php
namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;

use App\Notifications\ForgotPassword;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use EloquentJoin;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','username', 'password', 'image', 'status', 'user_type', 'country', 'therisr_score', 'notifications', 'provider' , 'provider_id', 'setpassword', 'stripe_customer_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 


    public function myFreelancer(){
        return $this->hasOne('App\Models\MyFreelancer','freelancer_id','id')
                    ->where(array('user_id' => Auth::user()->id));
    }
    public function countryName()
    { 
        return $this->hasOne('App\Models\Countries','id','country');
    }


    public function userProfile()
    { 
        return $this->hasOne('App\Models\UserProfile','user_id','id');
    }
    
    public function userEmpProfile()
    { 
        return $this->hasOne('App\Models\UserEmpProfile','user_id','id');
    }

    public function userWorkExp()
    { 
        return $this->hasMany('App\Models\UserWorkExp','user_id','id');
    }

    public function userEducation()
    { 
        return $this->hasMany('App\Models\UserEducation','user_id','id');
    }

    public function userSocialLinks()
    { 
        return $this->hasOne('App\Models\UserSocialLinks','user_id','id');
    }

     public function userPortfolio()
    { 
        return $this->hasMany('App\Models\UserPortfolio','user_id','id');
    }

     public function userAvailable()
    { 
        return $this->hasOne('App\Models\UserAvailable','user_id','id');
    }

    // job proposal
    public function userJobProposals(){
        return $this->hasMany('App\Models\JobProposals','user_id','id');
    }

    /**
     * Sends the password reset notification.
     *
     * @param  string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ForgotPassword($token));
    }
}

