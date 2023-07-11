<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ville;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Gouvernorat;
use App\Models\Image;
use App\Models\Carte;
use App\Models\Adherent;
class Amicale extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'amicales';
    protected $primaryKey = 'id';
    protected $fillable = ['nom','nom_responsable','email','numero','cin', 'gov_id','ville_id','image'];

    public function villes() {
        return $this->belongsTo(Ville::class);
    }

    public function gouvernorats() {
        return $this->belongsTo(Gouvernorat::class);
    }

  

    public function adherents() {
        return $this->hasMany(Adherent::class);
    }
    
    public function Cartes() {
        return $this->hasMany(Carte::class);
    }
}
