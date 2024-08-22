<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carnes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('valor_total', 10, 2);
            $table->decimal('valor_entrada', 10, 2)->nullable();
            $table->date('data_primeiro_vencimento');
            $table->integer('qtd_parcelas');
            $table->string('periodicidade', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carnes');
    }
}
