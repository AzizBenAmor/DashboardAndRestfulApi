<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partenaire;
use App\Models\Profession;
class Specialite extends Model
{
    use HasFactory;
    protected $table = 'specialites';
    protected $primaryKey = 'id';
    protected $fillable = ['nom','specialite_id'];

    public function partenaires() {
        return $this->hasMany(Partenaire::class);
    }

    public function professions() {
        return $this->belongsTo(Profession::class);
    }
}
