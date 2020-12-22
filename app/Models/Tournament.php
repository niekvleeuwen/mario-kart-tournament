<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'players',
        'rounds',
    ];

    protected $casts = [
        'players' => 'array',
        'schedule' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function players()
    {
        return $this->hasMany('App\Models\Player');
    }
}
