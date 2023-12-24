Clear view if not updated when starting serve:
- php artisan view:clear

Create features in Laravel, -m is used for migrations:
- php artisan make:model NameInSingular -m

Create a migration:
- php artisan make:migration create_fornecedores_table

SQL and system commands:

- systemclt status mysql -> show status of mysql
- systemclt start/stop mysql -> start/stop service mysql
sudo systemctl enable/disable mysql -> enable/disable sql when system starts
Check if the extension mysql is loaded:

- php -r "var_dump(extension_loaded('pdo_mysql'));"
If it returns false, is necessary to able it on php.ini - delete the ";" in the line extension=pdo_mysql then restart sql service (systemctl restart mysql) If nothing works, it may be necessary to reinstall the php again, making purge and then reinstalling.

- sudo apt-get purge 'php*'
- sudo apt-get install php7.4-common php7.4-mysql php7.4-cli

Artisan commands:

- php artisan migrate -> Creates the columns or tables on the DB
- php artisan migrate:rollback -> revert migrate of last migration
- php artisan migrate:rollback --step=2 -> revert the migrations based on the steps in the table migrations.

Useful artisan commands:

- php artisan migrate:status  - show the list of migrations
- php artisan migrate:reset   - revert/rollback all migrations
- php artisan migrate:refresh - rollback and migrate all migrations
- php artisan migrate:fresh   - drop all objects from database and execute migration

Interactive console (TINKER)

- php artisan tinker

Inserting data on database via tinker:
- \App\Fornecedor::create(['nome'=>'Fornecedor ABC', 'site'=>'forncedorabc.com.br', 'uf'=>'SP', 'email'=>'contato@fornecedorabc.com.br']);
Getting data from database:
- $fornecedores = \App\Fornecedor::all();


Is possible to print those values as well:
- print_r($fornecedores->toArray());


Get specific or multiple object(s) from database:
- $fornecedores = Fornecedor::find(2);
- $fornecedores = Fornecedor::find([1, 2, 3]);
- $contatos = SiteContato::where('column name', 'operator for comparison', 'value')->get();
- operators: >, >=, <, <=, <>, ==, like

Complex use of where, comparison operators (* >>>use \App\SiteContato):
- $contatos = SiteContato::whereIn('value to compare', 'params');
- $contatos = SiteContato::whereNotIn('value to compare', 'params');
- ex: $contatos = SiteContato::whereIn('motivo_contato', [1, 3])->get();

- $contatos = SiteContato::whereBetween('value to compare', 'params');
- $contatos = SiteContato::whereNotBetween('value to compare', 'params');
- ex: $contatos = SiteContato::whereBetween('motivo_contato', [1, 3])->get();

- $contatos = SiteContato::where('nome', '<>', 'Fernando')->whereIn('motivo_contato', [1, 2])->get();

SQL:
- SELECT * FROM sg.site_contatos where nome <> 'Fernando' or motivo_contato in(1, 2) or created_at between '2020-08-31 00:00:00' and '2020-08-31 23:59:59';

Tinker:
- $contatos = SiteContato::where('nome', '<>', 'Fernando')->orWhereIn('motivo_contato', [1, 2])->orWhereBetween('created_at', ['2020-08-31 00:00:00', '2020-08-31 23:59:59'])->get();

SQL:
- SELECT * FROM sg.site_contatos where updated_at is null;

Tinker:
- $contatos = SiteContato::whereNull('updated_at')->get();

SQL:
- SELECT * FROM sg.site_contatos where updated_at is not null;

Tinker:
- $contatos = SiteContato::whereNotNull('updated_at')->get();


- SELECT * FROM sg.site_contatos where created_at = '2020-08-31';
- $contatos = SiteContato::whereDate('created_at', '2020-08-31')->get();
- $contatos = SiteContato::whereDay('created_at', '31')->get();
- $contatos = SiteContato::whereMonth('created_at', '11')->get();
- $contatos = SiteContato::whereYear('created_at', '2023')->get();
- $contatos = SiteContato::whereTime('created_at', '=', '20:30:00')->get();

Get equal columns:
- $contatos = SiteContato::whereColumn('created_at', 'updated_at')->get();
Comparing:
- $contatos = SiteContato::whereColumn('created_at', '<>', 'updated_at')->get();

SQL:
- SELECT * FROM sg.site_contatos where (nome = 'Jorge' or nome = 'Ana') and (motivo_contato in (1, 2) or id between 4 and 6);

Tinker:
- $contatos = SiteContato::where(function($query){$query->where('nome', 'Jorge')->orWhere('nome', 'Ana');})->where(function($query){$query->whereIn('motivo_contato', [1, 2])->orWhereBetween('id', [4, 6]);})->get();


- $contatos = SiteContato::orderBy('motivo_contato')->orderBy('nome', 'asc')->get();


COLLECTIONS:

- $contatos = SiteContato::where('id', '>', 3)->get(); - creates a collection
- $contatos->first(); - returns first element from the collection
- $contatos->last(); - returns last element from the collection
- $contatos->reverse(); - returns collection in reverse order


- SiteContato::all()->toArray();
- SiteContato::all()->toJson();

Get all emails:
- SiteContato::all()->pluck('email');

Returns associative array:
- SiteContato::all()->pluck('email', 'nome');

Update values on DB:
- use \App\Fornecedor;
- $fornecedor = Fornecedor->find(1);
- $fornecedor->nome = "TESTE";
- $fornecedor->save();

Using fill() to update multiple values:
- $fornecedor->fill(['nome' => 'New Test', 'site' => 'site.com.br'])->save();

Removing data from DB with delete():
- $contato = SiteContato::find(4);
- $contato->delete();

Removing data from DB with destroy('id'):
- SiteContato::destroy(7);

Excluding ids with softDelete:
- use \App\Fornecedores;
- $fornecedor = Fornecedor::find(2);
- $fornecedor->delete(); -> same code, but considering softDelete, Laravel only include the value in the field "deleted_at"

Forcing deletion of row from DB with forceDelete with softDelete:
- use \App\Fornecedores;
- $fornecedor2 = Fornecedor::find(2);
- $fornecedor2->forceDelete();

Recovering rows that were deleted with softDelete:
- Fornecedor::withTrashed()->get(); - returns all results with deleted rows.
- Fornecedor::onlyTrashed()->get(); - returns only deleted rows (softDelete).

- $fornecedores = Fornecedor::onlyTrashed()->get(); - creating a variable to receive deleted rows.
- $fornecedores[0]->restore(); -restoring row that was deleted.

Running seeders - necessary to insert runner into DatabaseSeeder.php:
- php artisan db:seed

Run specific seeder:
- php artisan db:seed --class=SiteContatoSeeder

Creating a factory:
- php artisan make:factory SiteContatoFactory --model=SiteContato

Creating middleware and migration file:
- php artisan make:middleware LogAccess -m

Creating controller and models Laravel based using resource:
- php artisan make:controller --resource ProdutoController --model=Produto