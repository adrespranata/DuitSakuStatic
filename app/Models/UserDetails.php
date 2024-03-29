<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'first_name',
        'address',
        'city',
        'country',
        'postal_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
