<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['ra', 'nome', 'endereco', 'cidade', 'uf', 'telefone'];

    use HasFactory;

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
