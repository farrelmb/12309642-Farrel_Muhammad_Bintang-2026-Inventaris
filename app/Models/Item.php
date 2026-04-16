<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['category_id', 'name', 'total', 'repair'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lendings()
    {
        return $this->hasMany(Lending::class);
    }

    public function getAvailableAttribute()
    {
        $borrowed = $this->lendings()
            ->whereNull('return_date')
            ->sum('total');

        return $this->total - $this->repair - $borrowed;
    }

    public function getLendingTotalAttribute()
    {
        return $this->lendings()
            ->whereNull('return_date')
            ->sum('total');
    }
    
}