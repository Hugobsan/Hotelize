<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zip_code',
        'website',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->state} {$this->zip_code}";
    }

    public function getZipCodeAttribute($value)
    {
        return substr($value, 0, 5) . '-' . substr($value, 5);
    }

    public function setZipCodeAttribute($value)
    {
        $this->attributes['zip_code'] = str_replace('-', '', $value);
    }
}
