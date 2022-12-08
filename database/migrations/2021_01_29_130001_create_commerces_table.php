<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerces', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nomCom');
            $table->string('ad1Com','150');
            $table->string('ad2Com','150')->nullable();
            $table->decimal('latCom',8,6);
            $table->decimal('longCom',9,6);
            $table->string('telCom', '22');
            $table->string('mailCom', '320');
            $table->text('descCom');
            $table->bigInteger('siretCom');
            $table->string('siteCom','255')->nullable();
            $table->integer('etatCom')->default(0);
            $table->tinyInteger('livraisonCom')->nullable();
            $table->string('conditionLivraisonCom','255')->nullable();
            $table->json('horairesCom')->nullable();
            $table->dateTime('dateCreaCom');
            $table->string('codeCom','13');

            $table->foreignId('categorie_id')->constrained();
            $table->foreignId('sous_categorie_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('ville_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commerces');
    }
}
