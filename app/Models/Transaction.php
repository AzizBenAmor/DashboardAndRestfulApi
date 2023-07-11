<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partenaire;
use App\Models\Adherent;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $fillable = ['partenaire_id','adherent_id'];
   
    public function adherents() {
        return $this->belongsTo(Adherent::class);
    }
   
    public function partenaires() {
        return $this->belongsTo(Partenaire::class);
    }
}
