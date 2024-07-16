<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lead_channels extends Model
{
    use HasFactory;
    
    public function lead_medias(){
        return $this->hasMany(lead_medias::class);
    }
    
}
