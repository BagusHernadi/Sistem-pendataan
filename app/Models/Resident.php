<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Resident extends Model
{
    use SoftDeletes;
    
    protected $table = 'residents';

    protected $fillable = [
        'nik',
        'name',
        'gender',
        'birth_date',
        'birth_place',
        'address',
        'religion',
        'marital_status',
        'occupation',
        'phone',
        'status',
        'photo',
    ];

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute()
    {
        if (!$this->photo) {
            return asset('img/default-avatar.png');
        }
        
        if (str_starts_with($this->photo, 'http')) {
            return $this->photo;
        }
        
        return Storage::url($this->photo);
    }
}
