# Laravel SchemaSpy

[Laravel SchemaSpy](https://github.com/Stolz/laravel-schema-spy) is a [Laravel artisan command](http://laravel.com/docs/master/commands) that acts as an interface for the program [SchemaSpy](http://schemaspy.sourceforge.net). With SchemaSpy you can analyze the schema metadata of a database and generate browser readable files with useful information such:

- Visual ER diagram.
- Proper table insertion/deletion order for database migrations.

SchemaSpy is much more than that so please check the [official site](http://schemaspy.sourceforge.net) to see the full power of the tool.

## Requirements

SchemaSpy is a java-based command line tool so besides Laravel and [SchemaSpy](http://schemaspy.sourceforge.net) program itself you will need:

- A working [JAVA >=5 nstallation](http://www.java.com/getjava/).
- The proper JAVA connector for your database system (i.e: [MySQL](http://dev.mysql.com/downloads/connector/j/)).
- The `dot` command from [Graphviz](http://www.graphviz.org/) should be accessible via the **PATH** environment variable.

Graphvis is not required to view the output, only the `dot` command that is used to generated the output.

## Installation

Install via [Composer](https://getcomposer.org/)

	composer require stolz/laravel-schema-spy --dev

Once the package is installed you need to register the service provider with the application. Open up `config/app.php` and find the `providers` key.

	'providers' => array(
		...
		'Stolz\SchemaSpy\ServiceProvider',
		...

## Usage

	php artisan db:spy [connection]

If no connection is provided Laravel's default one will be used. After successfully running the command open the file `[output-dir]/index.html` with your browser.

## Configuration

To configure the package use the following command to copy the configuration file to `config/spy.php`.

	php artisan vendor:publish

All available settings are included inside `spy.php` and with the provided comments they should be self-explanatory.

## Laravel 4

If you are still using Laravel 4 instead of loading `Stolz\SchemaSpy\ServiceProvider` use `Stolz\SchemaSpy\LegacyServiceProvider` and manually copy the config file:

	cp vendor/stolz/laravel-schema-spy/src/config.php app/config/spy.php

## License

MIT License
© [Stolz](https://github.com/Stolz)

Read the provided `LICENSE` file for details.
