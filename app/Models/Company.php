<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function business_listings()
    {
        return $this->hasMany(BusinessListing::class);
    }

    public function admins()
    {
        return $this->belongsTo(Admin::class);
    }
}
