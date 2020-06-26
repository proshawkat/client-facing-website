<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    public function tags(){
        return $this->hasMany(Tag::class, 'story_id', 'id');
    }

    public function client(){
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'story_id', 'id');
    }

    public function section(){
        return $this->hasOne(Section::class, 'id', 'section_id');
    }

//    public function tagsExp(){
//       $tags =  $this->tags();
//        $tagsCom = "";
//        foreach ($tags as $value){
//            $tagsCom .= $value->name .',';
//        }
//       return $tagsCom;
//    }
}
