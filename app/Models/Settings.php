<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Settings extends Model
{

    protected $fillable = [
        'app_name','email','currency', 'cookie_link',"service_fee", "frontsite_link", "cookie_link", "privacy_link", "term_link", "help_link", "insta_link", "stripe_mode", "stripe_test_secret_key", "stripe_test_pub_key", "stripe_live_secret_key", "stripe_live_pub_key"
    ];

}
