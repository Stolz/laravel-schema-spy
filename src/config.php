<?php

return array(

	/*
	 |--------------------------------------------------------------------------
	 | Directory where generated files will be written
	 |--------------------------------------------------------------------------
	 |
	 | NOTE: For security reasons, setting this option to any path within your
	 | public_path() directory will be a really bad idea.
	 |
	 | Default: app_path('database/schema')
	 |
	 */

	'output' => app_path('database/schema'),

	/*
	 |--------------------------------------------------------------------------
	 | Base command to run schemaSpy.jar on your system
	 |--------------------------------------------------------------------------
	 |
	 | No parameters here, instead use 'arguments' array below!
	 |
	 | Default: java -jar schemaSpy.jar
	 |
	 */

	'command' => 'java -jar schemaSpy.jar',

	/*
	|--------------------------------------------------------------------------
	| Extra parametes to pass to the command
	|--------------------------------------------------------------------------
	|
	| Database connection settings will be read form Laravel database config so
	| there is no need to specify them here unless you want to override them.
	|
	| Full list of possible arguments: http://schemaspy.sourceforge.net/
	|
	*/

	'arguments' => [
		'-t'  => 'mysql',
		'-dp' => '/path/to/mysql-connector-java-5.1.30-bin.jar', // download from http://dev.mysql.com/downloads/connector/j/
		'-hq' => null,
	],
);
