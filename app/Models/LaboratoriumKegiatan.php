<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoriumKegiatan extends Model
{
	use HasFactory;
	protected $guarded = ['id'];

	public function scopeFilter($query, array $filters){
		$lab = $filters['lab'];
		$kegiatan = $filters['kegiatan'];

		$query->when($filters['lab']??false, function($query, $lab) use ($kegiatan){
			return $query->where('laboratorium_id', $lab)->whereHas('categoryKegiatan', function($query) use ($kegiatan){
				$query->where('slug_c', $kegiatan);
			});
		});

		$query->when($filters['search']??false, function($query, $search) use ($kegiatan, $lab){
			return $query->where('laboratorium_id',$lab)->where(function ($query) use ($kegiatan, $search){
				$query->whereHas('categoryKegiatan',function($query) use ($kegiatan){
					$query->where('slug_c', $kegiatan);
				})->where(function($query) use ($search){
					$query->where('nama', 'like', '%' . $search . '%')
						->orWhere('nip', 'like', '%' . $search . '%')
						->orWhere('judul', 'like', '%' . $search . '%')
						->orWhere('waktu', 'like', '%' . $search . '%');
				});
			});
		});

		$query->when($filters['category']??false, function($query, $category){
			return $query->whereHas('category', function($query) use ($category){
				$query->where('nama', $category);
			});
		});
	}

	// public function scopeFilters($query, array $filters)
	// {
	// 	$lab = $filters['lab'];
	// 	$kegiatan = $filters['kegiatan'];
	// 	if($filters["search"]??false and $filters['category']??false){
	// 		$search = $filters["search"];
	// 		$category = $filters["category"];

	// 		return $query->where('laboratorium_id',$lab)->where(function ($query) use ($kegiatan, $category, $search){
	// 			$query->whereHas('categoryKegiatan',function($query) use ($kegiatan){
	// 				$query->where('slug_c', $kegiatan);
	// 			})->whereHas('category', function($query) use ($category){
	// 				$query->where('nama', $category);
	// 			})->where(function($query) use ($search){
	// 				$query->where('nama', 'like', '%' . $search . '%')
	// 					->orWhere('nip', 'like', '%' . $search . '%')
	// 					->orWhere('judul', 'like', '%' . $search . '%')
	// 					->orWhere('waktu', 'like', '%' . $search . '%');
	// 			});
	// 		});
	// 	}
	// 	if($filters["category"]??false){
	// 		$category = $filters["category"];
	// 		return $query->where('laboratorium_id',$lab)->where(function ($query) use ($kegiatan, $category){
	// 			$query->whereHas('categoryKegiatan',function($query) use ($kegiatan){
	// 				$query->where('slug_c', $kegiatan);
	// 			})->whereHas('category', function($query) use ($category){
	// 				$query->where('nama', $category);
	// 			});
	// 		});
	// 	}

	// 	if($filters["search"]??false){
	// 		$search = $filters["search"];
	// 		return $query->where('laboratorium_id',$lab)->where(function ($query) use ($kegiatan, $search){
	// 			$query->whereHas('categoryKegiatan',function($query) use ($kegiatan){
	// 				$query->where('slug_c', $kegiatan);
	// 			})->where(function($query) use ($search){
	// 				$query->where('nama', 'like', '%' . $search . '%')
	// 					->orWhere('nip', 'like', '%' . $search . '%')
	// 					->orWhere('judul', 'like', '%' . $search . '%')
	// 					->orWhere('waktu', 'like', '%' . $search . '%');
	// 			});
	// 		});
	// 	}

	// 	return $query->where('laboratorium_id',$lab)->where(function ($query) use ($kegiatan){
	// 		$query->whereHas('categoryKegiatan',function($query) use ($kegiatan){
	// 			$query->where('slug_c', $kegiatan);
	// 		});
	// 	});
	// }

	public function category()
	{
		return $this->belongsTo(Category::class);
	}
	public function categoryKegiatan()
	{
		return $this->belongsTo(CategoryKegiatan::class);
	}
}
