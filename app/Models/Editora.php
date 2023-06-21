<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editora extends Model
{
    protected $fillable = ['nome', 'endereco', 'cidade', 'uf', 'telefone'];

    use HasFactory;

    public function livros()
    {
        return $this->hasMany(Livro::class);
    }
}
