<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate(int $int)
 * @method static create(array $all)
 * @method static findOrFail(Product $product)
 * @method static find(Product $product)
 * @method static where(string $string, string $string1, string $string2)
 */
class Product extends Model
{
    protected $fillable = ['id', 'product_name', 'product_price'];
}
