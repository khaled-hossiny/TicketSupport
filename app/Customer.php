<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //

    public function tickets(){
        return $this->hasMany('App\Ticket');
    }

    public function fullName(){
        return $this->firstName . ' ' . $this->lastName;
    }
}
