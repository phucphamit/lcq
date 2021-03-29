<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';

    public function category(){
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

}
