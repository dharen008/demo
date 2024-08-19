<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create( 'holidays', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'name', 100 )->nullable();
            $table->date( 'date' )->nullable();
            $table->bigInteger( 'created_by' )->unsigned()->nullable();
            $table->timestamp( 'created_at' )->nullable();
            $table->bigInteger( 'updated_by' )->unsigned()->nullable();
            $table->timestamp( 'updated_at' )->nullable();
        } );
    }
    
    public function down(): void {
        Schema::dropIfExists( 'holidays' );
    }
};
