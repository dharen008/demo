<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create( 'user_manage', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId( 'leader_id' )->nullable()->constrained( 'users' )->cascadeOnDelete();
            $table->foreignId( 'user_id' )->nullable()->constrained( 'users' )->cascadeOnDelete();
            $table->bigInteger( 'created_by' )->unsigned()->nullable();
            $table->timestamp( 'created_at' )->nullable();
            $table->bigInteger( 'updated_by' )->unsigned()->nullable();
            $table->timestamp( 'updated_at' )->nullable();
        } );
    }

    public function down(): void {
        Schema::dropIfExists( 'user_manage' );
    }
};