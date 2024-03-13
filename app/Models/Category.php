<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name', 'category_description'];

    // Define the relationship with Subcategory
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
    
}
