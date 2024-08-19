<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void {
		Schema::create( 'states', function ( Blueprint $table ) {
			$table->bigIncrements( 'id' );
            $table->foreignId( 'country_id' )->nullable()->constrained( 'countries' )->cascadeOnDelete();
			$table->string( 'name', 100 )->nullable();
			$table->string( 'slug', 100 )->nullable();
            $table->string( 'timezone', 100 )->nullable();
			$table->bigInteger( 'created_by' )->unsigned()->nullable();
			$table->timestamp( 'created_at' )->nullable();
			$table->bigInteger( 'updated_by' )->unsigned()->nullable();
			$table->timestamp( 'updated_at' )->nullable();
            $table->softDeletes();
		} );
	}

	public function down(): void {
		Schema::dropIfExists( 'states' );
	}
};
