<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assigmentPage extends Model
{
    public function assigment_users(){

        return $this->hasMany(User::class);

    }

    public function submissions(){

        return $this->hasMany(user_Submission_Score::class);
    }
}
