<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Services extends Model
{

    protected $fillable = [
        'name','status','added_by'
    ];

     /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    static function getById($id){

      $service = Services::find($id);
      return !empty($service) ? $service->name : '' ;
    }
}
