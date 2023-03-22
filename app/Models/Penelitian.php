<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Penelitian extends Model
{
	use HasFactory, Sluggable;

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
					->orWhere('judul', 'like', '%' . $search . '%')
					->orWhere('publikasi', 'like', '%' . $search . '%')
					->orWhere('tahun', 'like', '%' . $search . '%');
				});
		}

		$query->when($filters['search'] ?? false, function($query, $search){
			return $query->where('nama', 'like', '%' . $search . '%')
				->orWhere('judul', 'like', '%' . $search . '%')
				->orWhere('publikasi', 'like', '%' . $search . '%')
				->orWhere('tahun', 'like', '%' . $search . '%');
		});

		$query->when($filters['category'] ?? false, function($query, $category){
			return $query->where('category',$category);
		});
	}
	
	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function sluggable(): array
	{
		return [
			'slug' => [
				'source' => 'title'
			]
		];
	}
}
