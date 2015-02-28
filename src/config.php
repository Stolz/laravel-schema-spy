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

	'output' => base_path('database/schema'),

	/*
	 |--------------------------------------------------------------------------
	 | Base command to run schemaSpy.jar on your system
	 |--------------------------------------------------------------------------
	 |
	 | No parameters here, instead use the 'parameters' array below!
	 |
	 | Default: java -jar schemaSpy.jar
	 |
	 */

	'command' => 'java -jar schemaSpy.jar',

	/*
	|--------------------------------------------------------------------------
	| Extra parameters to pass to the command
	|--------------------------------------------------------------------------
	|
	| Database connection settings will be read form Laravel's database config
	| file but they can be overridden here.
	|
	| Full list of possible parameters: http://schemaspy.sourceforge.net/
	|
	*/

	'parameters' => [
		'-t'  => 'mysql',
		'-dp' => '/path/to/mysql-connector-java-5.1.30-bin.jar', // download from http://dev.mysql.com/downloads/connector/j/
		'-hq' => null,
	],
);
