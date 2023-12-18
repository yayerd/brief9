<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    protected $fillable = [
        'titre',
        'criteres',
        'duree',
    ];
}
