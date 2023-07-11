<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gouvernorat;
use App\Models\Adherent;
use App\Models\Amicale;
use App\Models\Partenaire;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ville extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'villes';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'gov_id'];

    public function gouvernorats() {
        return $this->belongsTo(Gouvernorat::class);
    }
    public function adherents() {
        return $this->hasMany(Adherent::class);
    }  
    public function partenaires() {
        return $this->hasMany(Partenaire::class);
    }

    public function amicales() {
        return $this->hasMany(Amicale::class);
    }

}
