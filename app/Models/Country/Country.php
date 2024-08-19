<?php

namespace App\Models\Country;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Extended\Models\ExtendedModel;
use App\Models\User;

class Country extends ExtendedModel
{
	use SoftDeletes;

	protected $fillable = [
		'phone_code',
		'name',
		'slug',
		'code',
	];

	public function states() {
		return $this->hasMany( State::class );
	}
}