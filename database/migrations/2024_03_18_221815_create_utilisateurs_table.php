<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('utilisateurs', function (Blueprint $table){
            $table->id();
            $table->string('CIN');
            $table->string('name');
            $table->string('prenom');
            $table->date('birth');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone_number');
            $table->string('role');
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
        DB::table('utilisateurs')->update(['password' => DB::raw('CIN || birth')]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
