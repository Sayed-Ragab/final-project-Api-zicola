<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['filename', 'imageable_id', 'imageable_type'];
       
    protected $appends = ['image_url'];

    public function imageable()
    {
        return $this->morphTo();
    }
    public function getImageUrlAttribute()
{
    return asset('attachments/Clinics/' . $this->filename);
}
}
