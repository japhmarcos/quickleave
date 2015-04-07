<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Auth;

class RedirectIfAuthenticated {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->check())
		{
			if (Auth::user()->role == 'member') {
				return new RedirectResponse(url('/user'));
			}
			elseif (Auth::user()->role == 'manager') {
				return new RedirectResponse(url('/manager'));
			}
			elseif (Auth::user()->role == 'admin') {
				return new RedirectResponse(url('/admin'));
			}
			
			//return new RedirectResponse(url('/auth/logout'));
		}

		return $next($request);
	}

}
