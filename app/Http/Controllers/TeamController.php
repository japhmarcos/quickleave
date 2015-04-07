<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Team;
use App\User;
use App\Leave;
use View, Input, Session, Redirect, Validator, Auth;

class TeamController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin');
		
		View::share('adminteams', Team::all());
		View::share('emp', User::all());
		View::share('dirleaves', Leave::all()->where('status','pending'));
		View::share('username', Auth::user()->username);
	}
	
	public function index()
	{
		$teams = Team::all();
		return View::make('teams.index')->with('teams',$teams); 
	}

	public function create()
	{
		return View::make('teams.create');
	}

	public function store()
	{
		$rules = array(
            'team_name' => 'required|unique:teams',
            'team_code' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('teams/create')
                ->withErrors($validator);
        } else {
        $team = new Team;
        $team->team_name = Input::get('team_name');
        $team->team_code = Input::get('team_code');
        $team->save();

        Session::flash('message', 'Successfully created '.$team->team_name.'!');
        return Redirect::to('teams');
    	}
	}
	
	public function showMembers($id)
	{
		$team = Team::find($id);
		return View::make('teams.showMembers')->with('team',$team);
	}
	
	public function edit($id)
	{
		$team = Team::find($id);
		return View::make('teams.edit')->with('team',$team);
	}

	public function update($id)
	{
        $rules = array(
            'team_name' => 'required|',
            'team_code' => 'required|',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('teams/' . $id . '/edit')
                ->withErrors($validator);
        } else {
        $team = Team::find($id);
        $team->team_name = Input::get('team_name');
        $team->team_code = Input::get('team_code');
        $team->save();

        Session::flash('message', 'Successfully updated '.$team->team_name.'!');
        return Redirect::to('teams');
    	}
	}

	public function destroy($id)
	{
		$team = Team::find($id);
		$team->delete();

		Session::flash('message','Successfully deleted '.$team->team_name.'!');
		return Redirect::to('teams');
	}

	public function destroyMember($id)
	{
		$member = User::find($id);
		$member->delete();

		Session::flash('message','Successfully deleted '.$member->username.'!');
		return Redirect::to('teams');
	}

}
