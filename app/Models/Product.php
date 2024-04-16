<?php

namespace App\Models;

use App\Models\InventoryTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inv;

class Product extends Model
{
    use HasFactory;

    public function supplier()
    {
    return $this->belongsTo(Supplier::class);
    }
    
}
