<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ville;
use App\Models\Adherent;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Amicale;
class Gouvernorat extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'gouvernorats';
    protected $primaryKey = 'id';
    protected $fillable = ['nom'];

    public function villes() {
        return $this->hasMany(Ville::class);
    }
    public function adherents() {
        return $this->hasMany(Adherent::class);
    }

    public function amicales() {
        return $this->hasMany(Amicale::class);
    }

   
}
