<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Message extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = 
    [
        'created_at',
        'updated_at'
    ];

    public function record(): HasOne
    {
        return $this->hasOne(Record::class);
    }
}
