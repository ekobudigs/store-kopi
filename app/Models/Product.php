<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'category_product_id', 'price', 'desc', 'stok'];

    public function categoryProduct(): BelongsTo
    {
        return $this->belongsTo(CategoryProduct::class);
    }

    public function scopeFilter($query, array $fillters)
    {

        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });

    }
}
