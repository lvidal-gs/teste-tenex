<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelaCarnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcela_carnes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('numero');
            $table->decimal('valor', 10, 2);
            $table->date('data_vencimento');
            $table->boolean('entrada')->nullable();

            $table->unsignedBigInteger('carne_id');
            $table->foreign('carne_id')->references('id')->on('carnes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parcela_carnes');
    }
}
