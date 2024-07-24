<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leads extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lead_status()
    {
        return $this->belongsTo(lead_statuses::class, 'status');
    }

    public function lead_probability()
    {
        return $this->belongsTo(lead_probabilities::class, 'probability');
    }

    public function type()
    {
        return $this->belongsTo(lead_types::class, 'lead_type');
    }

    public function channel()
    {
        return $this->belongsTo(lead_channels::class, 'lead_channel');
    }

    public function media()
    {
        return $this->belongsTo(lead_medias::class, 'lead_media');
    }

    public function source()
    {
        return $this->belongsTo(lead_sources::class, 'lead_source');
    }
}
