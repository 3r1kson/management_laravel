<?php

// use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return 'Olá, seja bem vindo ao curso!';
});
*/

// middleware on route
// Route::middleware(LogAcessoMiddleware::class)
// ->get('/', 'PrincipalController@principal')
// ->name('site.index');
// Route::get('/sobre-nos', 'SobreNosController@sobreNos')->name('site.sobrenos');
// Route::middleware(LogAcessoMiddleware::class)
// ->get('/contato', 'ContatoController@contato')
// ->name('site.contato');

Route::get('/', 'PrincipalController@principal')
->name('site.index')->middleware('log.access');
Route::get('/sobre-nos', 'SobreNosController@sobreNos')->name('site.sobrenos');
Route::get('/contato', 'ContatoController@contato')
->name('site.contato');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato');
Route::get('/login/{erro?}', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@authentication')->name('site.login');
Route::middleware(['log.access', 'authentication:padrao, visitante'])->prefix('/app')->group(function() {
    Route::get('/home', 'HomeController@index')->name('app.home');
    Route::get('/sair', 'LoginController@sair')->name('app.sair');
    // Route::get('/cliente', 'ClienteController@index')->name('app.cliente');

    // fornecedores
    Route::get('/fornecedor', 'FornecedorController@index')->name('app.fornecedor');
    Route::get('/fornecedor/list', 'FornecedorController@list')->name('app.fornecedor.list');
    Route::post('/fornecedor/list', 'FornecedorController@list')->name('app.fornecedor.list');
    Route::get('/fornecedor/add', 'FornecedorController@add')->name('app.fornecedor.add');
    Route::post('/fornecedor/add', 'FornecedorController@add')->name('app.fornecedor.add');
    Route::get('/fornecedor/edit/{id}/{msg?}', 'FornecedorController@edit')->name('app.fornecedor.edit');
    Route::get('/fornecedor/exclude/{id}', 'FornecedorController@exclude')->name('app.fornecedor.exclude');

    // produto
    // Route::get('/produto', 'ProdutoController@index')->name('app.produto');
    // Route::get('/produto/create', 'ProdutoController@create')->name('app.produto.create');
    Route::resource('produto', 'ProdutoController');

    //produtos detalhes
    Route::resource('produto-detalhe', 'ProdutoDetalheController');

    Route::resource('cliente', 'ClienteController');
    Route::resource('pedido', 'PedidoController');
    Route::resource('pedido-produto', 'PedidoProdutoController');
    
});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('site.teste');

Route::fallback(function() {
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">clique aqui</a> para ir para página inicial';
});
