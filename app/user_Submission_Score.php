<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\assignmentPage;

class user_Submission_Score extends Model
{
    public function belongToAssigment(){

        return $this->belongsTo(assignmentPage::class);
    }

    public function belongsToUser(){

        return $this->belongsTo(User::class);
    }
}
