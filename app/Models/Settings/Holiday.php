<?php

namespace App\Models\Settings;

use App\Extended\Models\ExtendedModel;

class Holiday extends ExtendedModel
{
	protected $fillable = [
		'name',
		'date',
	];
}