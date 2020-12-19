<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'tournament_id',
        'score'
    ];

    protected $casts = [
        'score' => 'array',
    ];

    public function tournament()
    {
        return $this->belongsTo('App\Models\Tournament');
    }
}
