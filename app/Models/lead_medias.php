<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lead_medias extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function channel()
    {
        return $this->belongsTo(lead_channels::class, 'channel_id');
    }

    public function lead_sources(){
        return $this->hasMany(lead_sources::class);
    }

}
