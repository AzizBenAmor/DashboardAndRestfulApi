<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ville;
use App\Models\Gouvernorat;
use App\Models\Amicale;
use App\Models\Carte;
use App\Models\Transaction;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Adherent extends Authenticatable
{
    use HasFactory,SoftDeletes,HasApiTokens;
    protected $table = 'adherents';
    protected $primaryKey = 'id';
    protected $fillable = ['nom','email','password','tel','cin', 'adress','password_changed', 'gov_id','ville_id','amicale_id','carte_id'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function villes() {
        return $this->belongsTo(Ville::class);
    }

    public function gouvernorats() {
        return $this->belongsTo(Gouvernorat::class);
    }

    public function amicales() {
        return $this->belongsTo(Amicale::class);
    }

    public function cartes() {
        return $this->belongsTo(Carte::class);
    }
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
