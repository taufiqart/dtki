<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorium extends Model
{
	use HasFactory;
	protected $guarded = ['id'];

	public function galery()
	{
		return $this->hasMany(Galery::class);
	}
	public function profilLab()
	{
		return $this->hasMany(ProfilLab::class);
	}

	public function kepalaAnggotaLab()
    {
        return $this->hasMany(KepalaAnggotaLab::class)->orderBy('role_name','DESC');
    }

    public function kegiatan()
    {
    	return $this->hasMany(LaboratoriumKegiatan::class);
    }
}
