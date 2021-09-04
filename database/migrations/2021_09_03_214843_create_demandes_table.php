<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->enum('typeDem',['congé','permission']);
            $table->date('dateDem');
            $table->date('dateDeb');
            $table->integer('duree')
                ->default(1);
            $table->string('objet',128);
            $table->enum('decision',['Accordé','Refusé'])->default('Refusé');
            $table->foreignIdFor(User::class)
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
    }
}
