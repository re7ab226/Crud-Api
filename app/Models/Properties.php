<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Properties extends Model
{
    use HasFactory;
    protected $table='properties';
    protected $fillable = 
    [
 

     'title',
     'slug',
    'price',
    'featured',
    'purpose',
    'category_id ',
    'image',
    'bedroom',
    'bathroom',
    'detailed_address',
    'Area', 
    'Year_building',
    'Finishing_type',
    'License_RealEstate',
    'Payment_method',
    'location_id ',
    'agent_id ',
    'description',
    'video',
    'floor_plan',
    'location_latitude',
    'location_longitude',

];

 
public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}


}
