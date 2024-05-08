<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = ['name', 'email', 'password', 'curso', 'cu' , 'tema_asignado']; // Campos permitidos para asignación masiva

    // Nombre de la tabla en la base de datos
    protected $table = 'estudiantes';

    public function temas()
    {
        return $this->belongsTo(Temas::class, 'tema_asignado', 'id_tema');
    }

    // No necesitas definir los timestamps en el modelo si ya están en la base de datos
    public $timestamps = false;
}
