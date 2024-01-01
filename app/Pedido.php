<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pedido extends Model
{
    // protected $fillable = [];
    public function produtos() {
        // return $this->belongsToMany('App\Produto', 'pedidos_produtos');
        return $this->belongsToMany('App\Item', 'pedidos_produtos', 'pedido_id', 'produto_id')->withPivot('id', 'created_at', 'updated_at');
        /* 
        parameters belongsToMany
        1 - Model N x N that relates with the Model that we are using, Item is being used by PedidoProduto 
        2 - Auxiliar table that saves relationship data
        3 - FK name from the table mapped by the relationship table (Pedido)
        4 - FK name from the table mapped by the model used in the relation (App\Pedido) that we are implementing (Produto)
        */

    }
}
