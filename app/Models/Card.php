<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    
    protected $fillable = [
        'title',
        'price',
        'description',
        'adress',
        'siret_number',
        'articles_number',
        'display',
        'allergenes',
        'location_id',
        'category_id',
        'user_id',
        'background_image',
        'start_time',
        'end_time'
    ];
    use HasFactory;

    protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d ');
}

}
