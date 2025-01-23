<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class Utility {
    public static function sendEmail($email, $model){
        Mail::to($email)->send($model);
    }
}