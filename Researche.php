<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Researche extends Model
{
    protected $fillable = [
        'researcher_name',
        'researcher_address',
        'type_spacimen',
        'type_animal',
        'researcher_sent',
        'researcher_stat',
        'researcher_medtech',
        'researcher_rev',
        'money_stat',
        'money_rev'       
    ];
    public function reorders()
    {
        return $this->hasMany('App\Reorder');
    }
    
    
}
