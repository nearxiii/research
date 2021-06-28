<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reorder extends Model
{
    protected $fillable = [
        'researche_id',
        'labtest_id',
        'price_or',
        'qty_or',
        'amount_or'
              
    ];
    protected $with=['researche','labtest'];
    public function researche()
    {
        return $this->belongsTo('App\Researche');
    }
    public function labtest()
    {
        return $this->belongsTo('App\Labtest');
    }
    
}
