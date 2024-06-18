<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function collection(){
        return $this->belongsTo(Collection::class,'collection_id');
    }
    public function children(){
        return $this->belongsTo(Children::class,'children_id');
    }
    public function man(){
        return $this->belongsTo(Man::class,'man_id');
    }
    public function women(){
        return $this->belongsTo(Women::class,'women_id');
    }
}
