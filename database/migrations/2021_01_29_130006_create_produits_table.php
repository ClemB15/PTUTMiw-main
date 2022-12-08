<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('labelProd','15');
            $table->string('descProd','255');
            $table->decimal('prixProd',5,2);
            $table->string('cheminPhotoProd','255');
            $table->integer('quantiteProd');

            $table->foreignId('unite_id')->constrained();
            $table->foreignId('commerce_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
