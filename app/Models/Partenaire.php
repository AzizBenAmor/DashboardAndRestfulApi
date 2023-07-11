<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ville;
use App\Models\Gouvernorat;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Secteur;
use App\Models\Notification;
use App\Models\Specialite;
use App\Models\Profession;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Partenaire extends Authenticatable
{
    use HasFactory,SoftDeletes,HasApiTokens;
    protected $table = 'partenaires';
    protected $primaryKey = 'id';
    protected $fillable = ['nom','nom_responsable','cin','email','password','numero','adress', 'gov_id','ville_id','secteur_id','profession_id','specialite_id','image'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    public function gouvernorat()
    {
        return $this->belongsTo(Gouvernorat::class, 'gov_id');
    }

    public function secteur()
    {
        return $this->belongsTo(Secteur::class, 'secteur_id');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }
    
    public function specialite()
    {
        return $this->belongsTo(Specialite::class, 'specialite_id');
    }
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    
    public function offers()
    {
        return $this->hasMany(Offer::class, 'partenaire_id');
    }
}
