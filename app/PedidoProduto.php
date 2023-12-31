<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    // setting name table based on migration
    protected $table = 'pedidos_produtos';
}
