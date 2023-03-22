<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniData extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function scopeFilter($query, array $filters)
    {
        
        

        if($filters['search'] ?? false and $filters['tahun'] ?? false){
            $tahun = $filters['tahun'];
            $search = $filters['search'];
            return $query->where('tahun',$tahun)
                ->where(function ($query) use ($search)
                {
                    $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('pekerjaan', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('no', 'like', '%' . $search . '%')
                    ->orWhere('tahun', 'like', '%' . $search . '%');
                });
        }

        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('pekerjaan', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('no', 'like', '%' . $search . '%')
                    ->orWhere('tahun', 'like', '%' . $search . '%');
        });
        
        $query->when($filters['tahun'] ?? false, function($query, $tahun){
            return $query->where('tahun', 'like', '%' . $tahun . '%');
        });

    }
	
}
