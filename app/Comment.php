<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function replies(){
        return $this->hasMany(Reply::class, 'comment_id', 'id');
    }

    public function client(){
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
