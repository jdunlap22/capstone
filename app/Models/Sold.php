<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sold extends Model
{
    use HasFactory;

    public $table = 'items_sold';
    protected $user_id = 'user_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'item_id',
        'order_id',
        'item_price',
        'quantity',    
    ];


    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}