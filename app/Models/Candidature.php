<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    public function formations()
    {
        return $this->belongsTo(Formation::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'statut',
        'formation_id',
        'user_id',
    ];
}
