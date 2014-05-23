<?php namespace Stolz\SchemaSpy;

// use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Config;

class Command extends \Illuminate\Console\Command {

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
	protected $description = 'Generates a database report using http://schemaspy.sourceforge.net';

	/**
	 * Default command to run schemaSpy.jar
	 *
	 * @var string
	 */
	protected $command = 'java -jar schemaSpy.jar';

	/**
	 * Parameters passed to schemaSpy.jar
	 *
	 * @var array
	 */
	protected $parameters = [];

	/**
	 * Create a new command instance
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Set parameters from config file
	 *
	 * @return SchemaSpyCommand
	 */
	protected function setParametersFromConfig()
	{
		// Set output dir parameter
		$this->parameters['-o'] = Config::get('laravel-schema-spy::output', app_path('database/schema'));

		// Set database connection parameters
		$connections = Config::get('database.connections', []);
		$connection = ($this->argument('connection')) ?: Config::get('database.default');
		if(isset($connections[$connection]))
		{
			$this->info("Using '$connection' connection");

			$this->parameters['-host']	= $connections[$connection]['host'];
			$this->parameters['-db']	= $connections[$connection]['database'];
			$this->parameters['-u']		= $connections[$connection]['username'];
			$this->parameters['-p']		= $connections[$connection]['password'];
		}
		else
			$this->comment("Unknown connection '$connection'. Command will fail unless you provide DB credentials.");

		return $this;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		// Merge automatic parameters with user configurable parameters
		$this->parameters = array_merge($this->setParametersFromConfig()->parameters, Config::get('laravel-schema-spy::arguments', []));

		// Ask for missing mandatory parameters
		if( ! isset($this->parameters['-db']))
			$this->parameters['-db'] = $this->ask('Enter database name');

		if( ! isset($this->parameters['-u']))
			$this->parameters['-u'] = $this->ask('Enter database username');

		// Build command
		$command = Config::get('laravel-schema-spy::command', $this->command);
		foreach($this->parameters as $key => $value)
			$command .= " $key $value";

		// Run command
		exec($command, $output, $returnValue);

		if($returnValue == 0)
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
		return array(
			array('connection', InputArgument::OPTIONAL, 'Database connection name'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
// 			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
