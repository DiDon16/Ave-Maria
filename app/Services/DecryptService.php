<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class DecryptService
{
    public function safeDecrypt($value){
        try {
            return Crypt::decrypt($value);
        } catch (DecryptException $e) {
            //la valeur n'est pas chiffrée
            return $value;
        }
    }
}
