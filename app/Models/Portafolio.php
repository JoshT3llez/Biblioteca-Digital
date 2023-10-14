<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portafolio extends Model{
    use HasFactory;
    protected $table = 'portafolio';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'descripcion', 'ubicacion','pdf'];

}
