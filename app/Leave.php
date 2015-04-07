<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model {

	protected $table = 'leaves';
	protected $fillable = ['type', 'from_dt', 'to_dt', 'note']; //removed 'remark' -lee

	public function user() {
		return $this->belongsTo('App\User');
	}

}
