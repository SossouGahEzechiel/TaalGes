<?php

use App\Models\Service;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom',60);
            $table->string('prenom',60);
            $table->string('adresse',60);
            $table->string('tel',60);
            $table->string('email',60);
            $table->string('password',60);
            $table->enum('sexe',['M','F']);
            $table->dateTime('dateEmb');
            $table->enum('natCont',['CDD','CDI'])
                ->default('CDD');
            $table->integer('dureCont')
                ->nullable();
            $table->integer('reserve')
                ->default(30);
            $table->enum('fonction',['admin','user'])->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreignId('service_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
