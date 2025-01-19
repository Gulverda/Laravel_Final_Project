<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->text('bio')->nullable();  // Add bio column
            $table->string('avatar')->nullable();  // Add avatar column
        });
    }
    
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['bio', 'avatar']);  // Drop bio and avatar columns if rolled back
        });
    }
    
};
