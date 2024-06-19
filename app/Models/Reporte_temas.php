<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte_temas extends Model
{
    use HasFactory;
    protected $fillable = ['action', 'id_tema', 'user_id'];
    public function temas(){
        return $this->hasMany(Temas::class, 'id_tema', 'id_tema');
    }
    public function users(){
        return $this->hasMany(Temas::class, 'id', 'id');
    }
}
