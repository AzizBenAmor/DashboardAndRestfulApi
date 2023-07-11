<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partenaire;
use App\Models\Secteur;
use App\Models\Specialite;

class Profession extends Model
{
    use HasFactory;
    protected $table = 'professions';
    protected $primaryKey = 'id';
    protected $fillable = ['nom'];

    public function secteurs() {
        return $this->belongsTo(Secteur::class);
    }
    public function partenaires() {
        return $this->hasMany(Partenaire::class);
    }

    public function specialites() {
        return $this->hasMany(Specialite::class);
    }
}
