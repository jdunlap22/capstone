<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    public $table = 'order_info';
    protected $user_id = 'user_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'session_id',
        'ip_address',
    ];


    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}