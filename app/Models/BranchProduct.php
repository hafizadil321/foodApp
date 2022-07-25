<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Branch;

class BranchProduct extends Model
{
    use HasFactory;

    protected $table = 'branch_product';
    protected $guarded = [];

    // public function products()
    // {
    //     return $this->belongsTo(Product::class);
    // }
    public function products()
    {
        return $this->hasMany(Product::class,'id', 'product_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }
}
