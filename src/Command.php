<?php namespace Stolz\SchemaSpy;

use Config;
use Illuminate\Console\Command as ConsoleCommand;
use Symfony\Component\Console\Input\InputArgument;

class Command extends ConsoleCommand
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'db:spy';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate a database report using http://schemaspy.sourceforge.net';

	/**
	 * Parameters passed to schemaSpy.jar
	 *
	 * @var array
	 */
	protected $parameters = [];

	/**
	 * Set schemaspy command parameters.
	 *
	 * @return array
	 */
	protected function setParameters()
	{
		$parameters = [];

		// Set output directory
		$parameters['-o'] = Config::get('spy.output', base_path('database/schema'));

		// Set database connection details
		$connections = Config::get('database.connections', []);
		$connection = ($this->argument('connection')) ?: Config::get('database.default');
		if(isset($connections[$connection]))
		{
			$this->info("Using '$connection' connection");

			$parameters['-host'] = $connections[$connection]['host'];
			$parameters['-db']   = $connections[$connection]['database'];
			$parameters['-u']    = $connections[$connection]['username'];
			$parameters['-p']    = $connections[$connection]['password'];
		}
		else
			$this->comment("Unknown connection '$connection'. Command will fail unless you provide DB credentials.");

		// Merge with user's parameters
		$parameters = array_merge($parameters, Config::get('spy.parameters', []));

		// Ask for missing mandatory parameters
		if( ! isset($parameters['-db']))
			$parameters['-db'] = $this->ask('Enter database name');

		if( ! isset($parameters['-u']))
			$parameters['-u'] = $this->ask('Enter database username');

		return $this->parameters = $parameters;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		// Set schemaSpy parameters
		$this->setParameters();

		// Build command
		$command = Config::get('spy.command', 'java -jar schemaSpy.jar');

		foreach($this->parameters as $key => $value)
			$command .= " $key $value";

		// Run command
		exec($command, $output, $returnValue);

		if($returnValue === 0)
			$this->info('Files successfully written to ' . $this->parameters['-o']);
		else
		{
			$this->error('Something went wrong');
			$this->error(implode(PHP_EOL, $output));
		}

		return $returnValue;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['connection', InputArgument::OPTIONAL, 'Database connection name', Config::get('database.default')],
		];
	}
}
