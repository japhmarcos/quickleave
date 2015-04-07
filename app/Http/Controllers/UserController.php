<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB, Auth, View, Input, Session, Redirect, Validator;
use App\User;
use App\Leave;
use App\Team;
use Hash;
use DateTime;

class UserController extends Controller {

//public $manager, $team, $notif_user;

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin',['only' => array('indexAdmin','showEmployees','editEmployee','updateEmployee','destroy')]);
		$this->middleware('director',['only' => array('indexDirector')]);
		$this->middleware('manager',['only' => array('indexManager','showMembers')]);
		$this->middleware('member',['only' => array('indexMember')]);
		/*
		$this->manager = User::find(Auth::id());
		View::share('manager', $this->manager);

		$this->team = Team::find(Auth::user()->team->id);
        View::share('team', $this->team);
        */

        //not displaying the 
        //$this->notif_user = User::all()->where('created_at', new DateTime('today'));
        //View::share('notif_user', $this->notif_user);

        //working!
        View::share('managerview', Auth::id());
        View::share('teamview', Auth::user()->team->id);
        View::share('adminteams', Team::all());
        View::share('emp', User::all());
        View::share('dirleaves', Leave::all()->where('status','pending'));
        View::share('username', Auth::user()->username);
     }
	
	public function indexAdmin()
	{
		$teams = Team::all();
		$users = User::all(); //User::skip(1)->take(8)->get();
		$leaves = Leave::all()->where('status', 'approved');
		return view('users.admin')->with('users', $users)->with('teams',$teams)->with('leaves',$leaves);
	}

	public function indexManager()
	{
		$team_id = Auth::user()->team->id;
		$teams = Team::find($team_id);
		$members = User::where('team_id',$team_id);
		$team = Team::find(Auth::user()->team->id);
		$manager = Auth::user();
		return view('users.managerdash')->with('manager',$manager)->with('team',$team)->with('members',$members);
	}

	public function indexMember()
	{
		$team_id = Auth::user()->team->id;
		$team = Team::find($team_id);
		$members = User::where('team_id',$team_id);
		$pending = Auth::user()->leave->where('status','pending');
	
		return view('users.userdash')->with('members',$members)->with('pending', $pending)->with('team', $team);
	}

	public function indexDirector()
	{	
		$teams = Team::all();
		$users = User::all();
		$leaves = Leave::all()->where('status', 'pending');
		return view('users.directordash')->with('teams',$teams)->with('users', $users)->with('leaves',$leaves);
	}

	public function showMembers($manager_id)
	{
		
		$manager = User::find($manager_id);
        return View::make('users.members')->with('manager', $manager);
		//$users = User::all();
        //return View::make('users.members')->with('users', $users);
	}

	public function show($username)
	{
		$employee = User::find(Auth::user()->id);
		$team = Team::find($employee->team->id);
        $team_manager = $team->user->where('role','manager');
		return view::make('users.indexprofile')->with('team_manager',$team_manager);
	}

	public function edit($id)
	{
		$user = User::find($id);
		return View::make('users.editProfile')->with('user', $user);
	}

	public function update($id)
	{
		$rules = array(
            'username' => 'max:255',
            'email' => 'email|max:255',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('user/' . $id . '/edit')
                ->withErrors($validator);
        } else {
        $user = User::find($id);
        $prev_uname = $user->username;

        $username = Input::get('username');
        $user->username = $username;
        $user->firstname = Input::get('firstname');
        $user->lastname = Input::get('lastname');
        $user->email = Input::get('email');
        
        if ($prev_uname != $username) {

        $existing_query = DB::select("SELECT EXISTS (SELECT 1 FROM users WHERE username = '" .$username. "') AS existing");
        $existing_uname = $existing_query[0]->existing;
        
        if ($existing_uname == 1) {
            Session::flash('message', "Username has been already taken. Please choose another one.");
            return Redirect::to('user/' . $id . '/edit');
            }
        }
        $user->save();

        Session::flash('message', 'Successfully updated your profile!');

       	return Redirect::to('user/profile/{$user->username}');
       }
		
	}

	public function changePass($id)
	{
		$user = User::find($id);
		return View::make('users.changePass')->with('user', $user);
	}

	public function updatePass($id)
	{
		$rules = array(
			'old_password' => 'required:min:6',
            'new_password' => 'required|min:6',
            'retype_password' => 'required|same:new_password'

        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('user/' . $id . '/changepassword')
                ->withErrors($validator);
        } 
        else {
	        $user = User::find($id);

	        //get inputs
	        $old_pass = Input::get('old_password');
	        $new_pass = Input::get('new_password');

	        //test old to existing password
	        if(Hash::check($old_pass, $user->getAuthPassword())) { 
	        	$user->password = Hash::make($new_pass); 
	        	$user->save();
	        	Session::flash('message', 'Successfully updated password.');
       			return Redirect::to('user/profile/'. $user->username);
       		}
       		else {
       			Session::flash('message', 'Your old password is incorrect.');
       			return Redirect::to('user/' . $id . '/changepassword');
       		}      
       	}	
	}

	public function destroy($id)
	{
		$employee = User::find($id);
		$employee->delete();
		$fullname = $employee->firstname . ' ' . $employee->lastname;

		// redirect
		Session::flash('message','Successfully deleted ' . $fullname . '!');
		return Redirect::to('admin/showemployees');
	}
	
	public function showEmployees()
	{
		$teams = Team::all();
		$employees = User::orderBy('created_at','desc')->get();
		return View::make('users.showEmployees')->with('employees', $employees)->with('teams',$teams); 
	}


	public function editEmployee($id)
	{
		$employee = User::find($id);
		return View::make('users.editEmployee')->with('employee',$employee);
	}

	public function updateEmployee($id)
	{
        $rules = array(
        	'role'			=> 'required',
        	'date_hired' 	=> 'required',
            'sl_bal' 		=> 'required',
            'vl_bal' 		=> 'required'
        );


        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/' . $id . '/editemployee')
                ->withErrors($validator);
        } 
        else {
        $employee = User::find($id);
       	//$employee->role = Input::get('role');
        $employee->date_hired = Input::get('date_hired');
        $employee->sl_bal = Input::get('sl_bal');
        $employee->vl_bal = Input::get('vl_bal');

        $input = Input::get('role');
        $team = Team::find($employee->team->id);
        $team_manager = $team->user->where('role','manager');

        	if ($team_manager->first()) {
        		if ($input == 'manager') {
        			if ($employee->role == 'manager') {
        				$employee->role = $input;
        				$employee->manager_id = null;

        				$team = Team::find($employee->team->id);
			        	$team->manager_id = $employee->id;
			        	$team->save();
        				
				        $all_members = $team->user->where('role','member');
				        foreach ($all_members as $value) {
				        	$value->manager_id = $employee->id;
				        	$value->save();
				       	}
	       			}

        			else {
        				Session::flash('message', 'Manager role has already been taken.');
        				return Redirect::to('admin/' . $id . '/editemployee');
        			}
        		}

        		else {
        			if ($employee->role == 'manager') {	//making manager the member
        				$employee->role = $input;
        				$employee->manager_id = null;

        				$team = Team::find($employee->team->id);
			        	$team->manager_id = null;
			        	$team->save();

			        	$all_members = $team->user->where('role','member');
				        foreach ($all_members as $value) {
				        	$value->manager_id = null;
				        	$value->save();
				       	}    				
	       			}

        			else { 	//retain member role
	        			$employee->role = $input;
	        			$employee->manager_id = $employee->team->manager_id;

	        			$all_members = $team->user->where('role','member');
				        foreach ($all_members as $value) {
				        	$value->manager_id = $employee->team->manager_id;
				        	$value->save();
				       	}
        			}
        		}
        	}

        	else {
        		if ($input == 'manager') {
		        	$employee->role = $input;
		        	$employee->manager_id = null;
		        	$employee->save();

		        	$team = Team::find($employee->team->id);
			        $team->manager_id = $employee->id;
			        $team->save();

		        	$all_members = $team->user->where('role','member');
					        
					foreach ($all_members as $value) {
				      	$value->manager_id = $employee->id;
				       	$value->save();	        	
			     	}
	        	}
	        	else {
	        		$employee->role = $input;
		        	$employee->manager_id = null;

		        	$team = Team::find($employee->team->id);
			        $team->manager_id = null;
			        $team->save();

		        	$all_members = $team->user->where('role','member');
				        
				    foreach ($all_members as $value) {
				       	$value->manager_id = null;
				       	$value->save();	        	
			     	}   
	        	}
		   	}

        $employee->save();

        Session::flash('message', 'Successfully updated '.$employee->firstname."'s information!");
        return Redirect::to('admin/showemployees');
    	}
	}
}
