<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiresTable extends Migration
{
    public function up()
    {
        Schema::create('tires', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedInteger('price');
            $table->date('draw_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tires');
    }
}
