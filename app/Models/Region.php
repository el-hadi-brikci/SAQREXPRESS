<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function bureaux()
    {
        return $this->hasMany(Bureau::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
