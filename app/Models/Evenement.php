<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Image;

class Evenement extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'evenements';
    protected $primaryKey = 'id';
    protected $fillable = ['title','image'];

}
