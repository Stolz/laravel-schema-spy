# Laravel SchemaSpy

[Laravel SchemaSpy](https://github.com/Stolz/laravel-schema-spy) is a [Laravel artisan command](http://laravel.com/docs/commands) that acts as an interface for the program [SchemaSpy](http://schemaspy.sourceforge.net/) from [John Currier](https://sites.google.com/site/johncurrier/).

With SchemaSpy you can analyze the schema metadata of a database and generate browser readable files with useful information such:

- Visual ER diagram.
- Proper table insertion/deletion order for database migrations.

## Requirements

SchemaSpy is a java-based command line tool so besides Laravel and [SchemaSpy](http://schemaspy.sourceforge.net/) program itself you will need:

- A working JAVA installation (JRE or JDK).
- The `dot` command from [Graphviz](http://www.graphviz.org/) accesible in your $PATH.

Graphvis is not required to view the output just the `dot` command that is used to generated the output.

## Installation

To get the latest version simply require it in your Laravel project `composer.json` file by running:

	composer require "stolz/laravel-schema-spy:dev-master" --dev

Once the package is installed you need to register the service provider with the application. Open up `app/config/app.php` and find the `providers` key.

	'providers' => array(
		...
		'Stolz\SchemaSpy\ServiceProvider',

## Usage

	php artisan db:spy [connection]

If no connection is provided Laravel's default one will be used.

## Configuration

To configure the package use the following command to copy the configuration file to `app/config/packages/stolz/laravel-schema-spy/config.php`.

	php artisan config:publish stolz/laravel-schema-spy

All available settings are included inside `config.php` and with the provided comments they should be self-explanatory.

## License

MIT License
(c) [Stolz](https://github.com/Stolz)
