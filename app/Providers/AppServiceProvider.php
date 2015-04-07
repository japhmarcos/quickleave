<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View, Auth;
use App\User;
use App\Team;

class AppServiceProvider extends ServiceProvider {

	public function boot()
	{
        //$this->manager = User::find(Auth::id());
        //View::share('manager', Auth::id());

        //$this->team = Team::find(Auth::user()->team->id);
        //View::share('team', Auth::user()->team->id);

        //View::share('managerview', Auth::id());
        //View::share('teamview', Auth::user()->team->id);
        
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
