<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffreschoisiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offreschoisies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreignId('commerce_id')->constrained();
            $table->foreignId('offre_id')->constrained();

            $table->primary(['commerce_id','offre_id']);
            $table->dateTime('dateSouscription');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offreschoisies');
    }
}
