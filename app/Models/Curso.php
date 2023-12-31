<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nome', 'coordenador', 'duracao'];

    use HasFactory;

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }
}
