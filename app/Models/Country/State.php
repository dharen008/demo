<?php

namespace App\Models\Country;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Extended\Models\ExtendedModel;
use Spatie\Activitylog\LogOptions;
use App\Models\User;

class State extends ExtendedModel
{
	use SoftDeletes;

	protected $fillable = [
		'name',
		'slug',
	];

	public function countries() {
		return $this->belongsTo( Country::class );
	}
}