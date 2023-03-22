<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dosenTendik extends Model
{
	use HasFactory;

	protected $guarded = ['id'];

	public function scopeFilter($query, array $filters)
	{
		if($filters['search'] ?? false and $filters['category'] ?? false){
			$category = $filters['category'];
			$search = $filters['search'];
			return $query->where('category',$category)
				->where(function ($query) use ($search)
				{
					$query->where('nama', 'like', '%' . $search . '%')
					->orWhere('nip', 'like', '%' . $search . '%')
					->orWhere('email', 'like', '%' . $search . '%')
					->orWhere('jabatan', 'like', '%' . $search . '%');
				});
		}
		$query->when($filters['search'] ?? false, function($query, $search){
			return $query->where('nama', 'like', '%' . $search . '%')
					->orWhere('nip', 'like', '%' . $search . '%')
					->orWhere('email', 'like', '%' . $search . '%')
					->orWhere('jabatan', 'like', '%' . $search . '%');
		});

		$query->when($filters['category'] ?? false, function($query, $category){
			return $query->where('category', 'like', '%' . $category . '%');
		});
	}

	public function getRouteKeyName()
	{
		return 'nip';
	}
}
