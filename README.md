# Laravel SchemaSpy

[Laravel SchemaSpy](https://github.com/Stolz/laravel-schema-spy) is a [Laravel artisan command](https://laravel.com/docs/master/artisan) that acts as an interface for the program [SchemaSpy](http://schemaspy.sourceforge.net). With SchemaSpy you can analyze the schema metadata of a database and generate browser readable files with useful information such:

- Visual ER diagram.
- Proper table insertion/deletion order for database migrations.

SchemaSpy is much more than that so please check the [official site](http://schemaspy.sourceforge.net) to see the full power of the tool.

## Requirements

Before installing the package make sure the following requirements are installed on your system:

- [JAVA >=5](http://www.java.com/getjava/).
- [SchemaSpy](http://schemaspy.sourceforge.net) JAR file:
- The proper JAVA connector for your database system (i.e: [MySQL](http://dev.mysql.com/downloads/connector/j/)).
- The `dot` command from [Graphviz](http://www.graphviz.org/) should be accessible via the **PATH** environment variable.

Graphviz itself is not required, only its `dot` command is used to generated the output.

## Installation

Install via [Composer](https://getcomposer.org/)

	composer require stolz/laravel-schema-spy --dev

If you are using an old version of Laravel or if you have disabled its package discovery feature, then you have to manually edit `config/app.php` file and register the service provider under `providers` key

	'providers' => array(
		...
		Stolz\SchemaSpy\ServiceProvider::class,
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
