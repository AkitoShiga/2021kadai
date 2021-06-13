<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterUser extends Model
{
    use HasFactory;
    protected $table = 'register_users';
    protected $primaryKey = 'email';
    protected $keyType = 'string';
    protected$fillable = [
        'email',
        'name',
    ];
    public $incrementing = false;
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
}
