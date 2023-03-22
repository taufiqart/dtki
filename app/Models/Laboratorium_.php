<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorium extends Model
{
    use HasFactory;

    public static function POSL(){
        $path = storage_path()."/json/laboratorium/posl.json";
        $json = json_decode(file_get_contents($path), true);
        return $json;
    }

    public static function IBL(){
        $path = storage_path()."/json/laboratorium/ibl.json";
        $json = json_decode(file_get_contents($path), true);
        return $json;
    }
    public static function ACL(){
        $path = storage_path()."/json/laboratorium/acl.json";
        $json = json_decode(file_get_contents($path), true);
        return $json;
    }
    public static function ICPL(){
        $path = storage_path()."/json/laboratorium/icpl.json";
        $json = json_decode(file_get_contents($path), true);
        return $json;
    }

}
