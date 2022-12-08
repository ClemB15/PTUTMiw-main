<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->decimal('note',2,1);
            $table->text('commentaireAvis');

            $table->foreignId('user_id')->constrained();
            $table->foreignId('commerce_id')->constrained();
            $table->unique(['user_id', 'commerce_id']);
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
        Schema::dropIfExists('commentaires');
    }
}
