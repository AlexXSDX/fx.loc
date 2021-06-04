<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("currencies", function (Blueprint $table) {
            $table->id();
            $table->string("name", 50);
            $table->date("date");
            $table->decimal("rate", $precision = 8, $scale = 4);
            $table->timestamps();

            $table->index(["name", "date"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
