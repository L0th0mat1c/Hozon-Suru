<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

   

    public function user_id()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function card_id()
    {
        return $this->belongsTo('App\Models\Card');
    }
}
