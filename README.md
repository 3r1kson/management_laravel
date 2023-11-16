Clear view if not updated when starting serve:

php artisan view:clear
Create features in Laravel, -m is used for migrations:

php artisan make:model NameInSingular -m
Create a migration:

php artisan make:migration create_fornecedores_table
SQL and system commands:

systemclt status mysql -> show status of mysql
systemclt start/stop mysql -> start/stop service mysql
sudo systemctl enable/disable mysql -> enable/disable sql when system starts
Check if the extension mysql is loaded:

php -r "var_dump(extension_loaded('pdo_mysql'));"
If it returns false, is necessary to able it on php.ini - delete the ";" in the line extension=pdo_mysql then restart sql service (systemctl restart mysql) If nothing works, it may be necessary to reinstall the php again, making purge and then reinstalling.

sudo apt-get purge 'php*'
sudo apt-get install php7.4-common php7.4-mysql php7.4-cli
Artisan commands:

php artisan migrate -> Creates the columns or tables on the DB
php artisan migrate:rollback -> revert migrate of last migration
php artisan migrate:rollback --step=2 -> revert the migrations based on the steps in the table migrations.

Useful artisan commands:

php artisan migrate:status  - show the list of migrations
php artisan migrate:reset   - revert/rollback all migrations
php artisan migrate:refresh - rollback and migrate all migrations
php artisan migrate:fresh   - drop all objects from database and execute migration

Interactive console (TINKER)

php artisan tinker