<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_docente';
    protected $fillable = ['nombre','apellidos','email','telefono','rol'];
    public function temas()
    {
        return $this->hasMany(Temas::class, 'docente_id', 'id_docente');
    }
}
