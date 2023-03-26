<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'action',
    ];

       public function admin(): HasOne
    {
        return $this->hasOne(Admin::class,'id', 'staff_id');
    }
}
