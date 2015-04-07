<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Team;
use App\User;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();
		$this->call('QuickLeaveSeeder');
	}
}

class QuickLeaveSeeder extends Seeder {

	public function run() {

		// delete database data
		DB::table('users')->delete();
		DB::table('teams')->delete();

		$team_admin = Team::create(array(
			'team_name' => 'admin',
			'team_code' => 'admin' 
			));

		User::create(array(
			'firstname' => 'Admin',
			'lastname' => 'Adminlast',
			'username' => 'admin',
			'email' => 'admin@gmail.com',
			'password' => Hash::make('admin'),
			'sl_bal' => null,
			'vl_bal' => null,
			'role' => 'admin',
			'date_hired' => '2015-03-15',
			'gender' => 'M',
			'team_id' => $team_admin->id
		));

		$team_director = Team::create(array(
			'team_name' => 'director',
			'team_code' => 'director' 
			));

		$director = User::create(array(
			'firstname' => 'Director',
			'lastname' => 'Directorlast',
			'username' => 'director',
			'email' => 'director@gmail.com',
			'password' => Hash::make('director'),
			'sl_bal' => null,
			'vl_bal' => null,
			'role' => 'director',
			'date_hired' => '2015-03-15',
			'gender' => 'M',
			'team_id' => $team_director->id
		));

		for($i = 0; $i < 5; $i++) {
			$team = Team::create(array(
				'team_name' => 'teamname'.$i,
				'team_code' => 'teamcode'.$i
				));

			$manager = User::create(array(
				'firstname' => 'Manager'.$i,
				'lastname' => 'Managerlast'.$i,
				'username' => 'manager'.$i,
				'email' => 'manager'.$i.'@gmail.com',
				'password' => Hash::make('password'),
				'sl_bal' => 5,
				'vl_bal' => 7,
				'role' => 'manager',
				'date_hired' => '2015-03-15',
				'gender' => 'M',
				'team_id' => $team->id,
				'manager_id' => null,
				));

			$member = User::create(array(
				'firstname' => 'Member'.$i,
				'lastname' => 'Memberlast'.$i,
				'username' => 'member'.$i,
				'email' => 'email'.$i.'@gmail.com',
				'password' => Hash::make('password'),
				'sl_bal' => 5,
				'vl_bal' => 7,
				'role' => 'member',	
				'date_hired' => '2015-03-15',
				'gender' => 'M',
				'team_id' => $team->id,
				'manager_id' => $manager->id
				));

			$team = Team::find($team->id);
			$team->manager_id = $manager->id;
			$team->save();
		}

		
	}
}
