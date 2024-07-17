<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lead_sources extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lead_media(){
        return $this->hasMany(lead_medias::class, 'media_id');
    }
}
