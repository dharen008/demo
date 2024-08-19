<?php

namespace App\Extended\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

abstract class ExtendedModel extends Model
{
	use HasFactory;

	// Define the primary key as a string
	protected $primaryKey = 'id';

	// Disable auto-increment for the id column
	public $incrementing = false;

	protected static function boot()
	{
		parent::boot();

		// Generate a unique random 6-digit ID before creating a new CompanyModel instance
		static::creating( function ( $model ) {
			do {
				$randomId = str_pad( mt_rand( 1000000, 9999999 ), 7, '0', STR_PAD_LEFT );
			} while ( self::where( 'id', $randomId )->exists() );
			$model->created_by = auth()->check() ? auth()->user()->id : null;
			$model->id = $randomId;
		} );

		static::updating( function ( $model ) {
			$model->updated_by = auth()->check() ? auth()->user()->id : null;
		} );
	}

	public function createdBy() {
		return $this->belongsTo( User::class, 'created_by' );
	}

	public function updatedBy() {
		return $this->belongsTo( User::class, 'updated_by' );
	}
}
