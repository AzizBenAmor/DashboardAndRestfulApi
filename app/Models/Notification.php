<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Image;
use App\Models\Partenaire;

class Notification extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $fillable = ['nom','lien','image','description','partenaire_id','dateDebut'];
    public function partenaires() {
        return $this->belongsTo(Partenaire::class);
    }

}

