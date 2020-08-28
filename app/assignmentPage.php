<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assignmentPage extends Model
{

    protected $fillable = [
        'published'
    ];


    public function assigment_users(){

        return $this->hasMany(User::class);

    }

    public function submissions(){

        return $this->hasMany(user_Submission_Score::class);
    }
}
