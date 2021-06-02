<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'subsubcategory_name_en',
        'subsubcategory_name_hin',
        'subsubcategory_slug_en',
        'subsubcategory_slug_hin',
        'category_id',
        'subcategory_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }
}
