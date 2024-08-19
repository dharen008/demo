<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create( 'countries', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' )->unsigned();
            $table->string( 'name', 100 )->nullable();
            $table->string( 'slug', 100 )->nullable();
            $table->string( 'code', 5 )->nullable();
            $table->integer( 'phone_code' )->nullable();
            $table->bigInteger( 'created_by' )->unsigned()->nullable();
            $table->timestamp( 'created_at' )->nullable();
            $table->bigInteger( 'updated_by' )->unsigned()->nullable();
            $table->timestamp( 'updated_at' )->nullable();
            $table->softDeletes();
        } );
    }

    public function down(): void {
        Schema::dropIfExists( 'countries' );
    }
};