<?php namespace Stolz\SchemaSpy;

class ServiceProvider extends \Illuminate\Support\ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Register the package namespace
		$this->package('stolz/laravel-schema-spy');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Bind 'stolz.schemaspy.command.spy' component to the IoC container
		$this->app->bind('stolz.schemaspy.command.spy', function($app)
		{
			return new Command();
		});

		// Add artisan command
		$this->commands('stolz.schemaspy.command.spy');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
