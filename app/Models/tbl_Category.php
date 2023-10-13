<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_Category extends Model
{
    use HasFactory;

    protected $table = 'tbl_Category';

    public function category()
    {
        return $this->belongsTo(tbl_Category::class, 'category_id');
    }
}