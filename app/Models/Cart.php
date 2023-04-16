<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public $table = 'shopping_cart';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function items() {
        return $this->hasOne('\App\Models\Item','id', 'item_id')->orderBy('title','ASC');
    }
}