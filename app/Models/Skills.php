<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Skills extends Model
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

      $skill = Skills::find($id);
      return !empty($skill) ? $skill->name : '' ;
    }
}
