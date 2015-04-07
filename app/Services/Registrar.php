<?php namespace App\Services;

use App\User;
use Validator;
use DB;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */


	public function validator(array $data)
	{
		return Validator::make($data, [
			'username' 	=> 'required|max:255|unique:users',
			'password' 	=> 'required|confirmed|min:6',
			'firstname' => 'required|max:255',
			'lastname' 	=> 'required|max:255',
			'email' 	=> 'required|email|max:255|unique:users',
			'gender'	=> 'required',
			//'team_id' => 'required',
			'team_code' => 'exists:teams,team_code'
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{

		//$team = Team::where('team_code', $data['team_code'])->get();
		//$team_id = $team->id;

		$team_id = DB::table('teams')->where('team_code',$data['team_code'])->pluck('id');

		return User::create([
			'username'	=> $data['username'],
			'password'	=> bcrypt($data['password']),
			'firstname' => $data['firstname'],
			'lastname'	=> $data['lastname'],
			'email' 	=> $data['email'],
			'gender' 	=> $data['gender'],
			'team_id'   => $team_id
		]);
	}
}
