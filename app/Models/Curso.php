<?php
//Guillermo Andres Mosquera Renteria
//ficha 2675857
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'imagen'];

}
