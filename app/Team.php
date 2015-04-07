<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {

	protected $table = 'teams';

	protected $fillable = ['team_name', 'team_code', 'manager_id'];

	public function user() {
		return $this->hasMany('App\User'); //->where('user_parent', 0);
	}
	 
	public function manager() {
		return $this->hasOne('App\User', 'user_id', 'manager_id'); //user_id = FK manager_id = LOCAL KEY
	}

	public function leaves() {
		return $this->hasManyThrough('App\Leave','App\User','team_id','user_id');
	}

	public function members() {
		return $this->hasMany('App\User','team_id');
	}

}
