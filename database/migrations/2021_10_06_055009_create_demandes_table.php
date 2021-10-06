<?php

use App\Models\TypeDemande;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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
            $table->dateTime('dateDem');
            $table->dateTime('dateDeb');
            $table->integer('duree');
            $table->enum('decision',['Accorde','Refuse'])
                ->nullable();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(TypeDemande::class);
            $table->integer('v_by')->nullable();
            $table->dateTime('v_at')->nullable();
            $table->softDeletes();
            $table->timestamps(); 
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
