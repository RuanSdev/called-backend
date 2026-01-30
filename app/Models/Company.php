<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
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
        return $this->belongsToMany(User::class, 'user_company')->withTimestamps();
    }
    public function casts()
    {
        return [
            'is_active' => 'boolean',
            'created_at' => 'datetime:Y-m-d',
            'updated_at' => 'datetime:Y-m-d',
            'deleted_at' => 'datetime:Y-m-d',
        ];
    }
}
