<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function client(){
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
