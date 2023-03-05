<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, foreignKey: 'payment_id', localKey: 'id');
    }
}
