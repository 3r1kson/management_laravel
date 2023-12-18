<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Eloquent naming method:
// Site_Contato
// site_contato
// site_contatos

class SiteContato extends Model
{
    protected $fillable = ['nome', 'telefone', 'email', 'motivo_contatos_id', 'mensagem'];

}
