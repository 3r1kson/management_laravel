<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Intantiation object
        $fornecedor = new Fornecedor();
        $fornecedor->nome = "Fornecedor 100";
        $fornecedor->site = "fornecedor100.com.br";
        $fornecedor->uf = "CE";
        $fornecedor->email = "contato@fornecedor100.com.br";
        $fornecedor->save();

        // method create - carefull with fillable
        Fornecedor::create([ 
            'nome' => 'Fornecdor 200',
            'site'=> 'fornecedor200.com.br',
            'uf' => 'CE',
            'email'=> 'contato@fornecedor200.com.br'
        ]);

        // insert - doesn't is verified by Eloquent
        DB::table('fornecedores')->insert([
            'nome' => 'Fornecdor 300',
            'site'=> 'fornecedor300.com.br',
            'uf' => 'SP',
            'email'=> 'contato@fornecedor300.com.br'
        ]);
    }
}
