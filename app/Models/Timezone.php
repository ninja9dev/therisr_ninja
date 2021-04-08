<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
   protected $fillable = [
        'timezone_name', 'offset', 'diff_from_gtm'
    ];

}
