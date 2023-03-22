<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilLab extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters) 
    {
        $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereHas('category', function($query) use ($category){
                $query->where('nama', $category);
            });
        });
    }
    public function galery()
    {
        return $this->hasMany(Galery::class);
    }
    public function category()
    {
        return $this->belongsTo(Laboratorium::class);
    }    
}
