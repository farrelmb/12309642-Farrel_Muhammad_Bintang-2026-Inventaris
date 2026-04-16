<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    protected $fillable = [
        'item_id',
        'name',
        'total',
        'ket',
        'return_date',
        'returned_total',
        'repair_total',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
