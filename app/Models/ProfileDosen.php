<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileDosen extends Model
{
    use HasFactory;

    private static function json(){
        $path = storage_path()."/json/ProfileDosen.json";
        $json = json_decode(file_get_contents($path), true);
        return $json;
    }

    public static function body(){
        $json = static::json();
        return $json["body"];
    }
}
