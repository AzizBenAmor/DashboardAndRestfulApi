<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Image;
use App\Models\Partenaire;
class Offer extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'offers';
    protected $primaryKey = 'id';
    protected $fillable = ['nom','description','adress','reduction','prix','dateDebut','dateFin','tel','permanent','stat','type','image','partenaire_id',''];
    public function partenaires()
    {
        return $this->belongsTo(Partenaire::class, 'partenaire_id');
    }
  
}
