<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Labtest extends Model
{
    protected $fillable = [
        'lab_name',
        'lab_type',
        'lab_price'       
    ];
    public function reorders()
    {
        return $this->hasMany('App\Reorder');
    }
}
