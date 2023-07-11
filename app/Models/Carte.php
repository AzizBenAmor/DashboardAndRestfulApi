<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Adherent;
use App\Models\Cause;
use App\Models\Amicale;
use Illuminate\Database\Eloquent\SoftDeletes;


class Carte extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'cartes';
    protected $primaryKey = 'id';
    protected $fillable = ['codeBar','is_active','cause_id','amicale_id'];

    public function adherents() :  HasOne  {
        return $this->hasOne (Adherent::class);
    }
    public function causes() {
        return $this->belongsTo(Cause::class);
    }
    public function amicales() {
        return $this->belongsTo(Amicale::class);
    }
}
