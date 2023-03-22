<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileDepartemen extends Model
{
	use HasFactory;


	private static function json(){
		$path = storage_path()."/json/ProfileDepartemen.json";
		$json = json_decode(file_get_contents($path), true);
		return $json;
	}

	public static function isi(){
		$json = static::json();
		return $json["isi"];
	}
	public static function galerys(){
		$json = static::json();
		return $json["galerys"];
	}
}
