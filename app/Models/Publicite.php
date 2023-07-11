<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Image;

class Publicite extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'publicites';
    protected $primaryKey = 'id';
    protected $fillable = ['owner','video','dateFin','dateDebut','image'];
  
}
