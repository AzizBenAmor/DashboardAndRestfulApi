<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Carte;

class Cause extends Model
{
    use HasFactory;
    protected $table = 'causes';
    protected $primaryKey = 'id';
    protected $fillable = ['description'];
    public function cartes() {
        return $this->hasMany(Carte::class);
    }
}
