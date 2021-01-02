<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funerals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('area');
            $table->string('whatsapp');
            $table->text('address');
            $table->string('maps');
            $table->decimal('price_a', 20, 2);
            $table->decimal('price_b', 20, 2);
            $table->decimal('price_c', 20, 2);
            $table->string('image');
            $table->longText('area_class_a');
            $table->longText('area_class_b');
            $table->longText('area_class_c');
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
        Schema::dropIfExists('funerals');
    }
}
