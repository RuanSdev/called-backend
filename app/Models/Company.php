<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'trade_name',
        'document',
        'email',
        'phone',
        'is_active',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
