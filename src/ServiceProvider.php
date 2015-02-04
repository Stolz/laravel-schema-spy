<?php namespace Stolz\SchemaSpy;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
	/**
	 * Path to the default config file.
	 *
	 * @var string
	 */
	protected $configFile = __DIR__ . '/config.php';

	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function register()
	{
		// Merge user's configuration
		$this->mergeConfigFrom($this->configFile, 'spy');

		// Bind 'stolz.schemaspy.command.spy' component to the IoC container
		$this->app->bind('stolz.schemaspy.command.spy', function ($app) {
			return new Command();
		});
	}

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Register paths to be published by 'vendor:publish' artisan command
		$this->publishes([
			$this->configFile => config_path('spy.php'),
		]);

		// Add artisan command
		$this->commands('stolz.schemaspy.command.spy');
	}


}
