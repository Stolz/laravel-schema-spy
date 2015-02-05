<?php namespace Stolz\SchemaSpy;

class LegacyServiceProvider extends \Illuminate\Support\ServiceProvider
{
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Bind 'stolz.schemaspy.command.spy' component to the IoC container
		$this->app->bind('stolz.schemaspy.command.spy', function ($app) {
			return new Command();
		});

		// Add artisan command
		$this->commands('stolz.schemaspy.command.spy');
	}

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		//$this->package('stolz/spy', 'spy'); // Only valid if config file is at src/config/config.php
		$this->app->config->package('stolz/spy', __DIR__, 'spy');
	}
}
