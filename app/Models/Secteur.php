<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partenaire;
use App\Models\Profession;

class Secteur extends Model
{
    protected $table = 'secteurs';
    protected $primaryKey = 'id';
    protected $fillable = ['nom'];

    public function partenaires() {
        return $this->hasMany(Partenaire::class);
    }
    public function professions() {
        return $this->hasMany(Profession::class);
    }
}
