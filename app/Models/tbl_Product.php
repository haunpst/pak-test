<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_Product extends Model
{
    use HasFactory;

    protected $table = 'tbl_Product';

    public function category()
    {
        return $this->belongsTo(tbl_Category::class, 'category_id');
    }
}
