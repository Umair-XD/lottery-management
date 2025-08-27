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
            $table->unsignedBigInteger('last_ticket_id')->nullable();
            $table->string('name')->unique();
            $table->unsignedInteger('price');
            // carousel/ticket metadata
            $table->unsignedBigInteger('prize_amount')->comment('Total prize for this tier');
            $table->unsignedInteger('multiplier')->comment('Prize multiplier');
            $table->dateTime('draw_date')->comment('Scheduled draw datetime');
            $table->string('bg_color')->default('#62c9d6')->comment('Background color for carousel card');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tires');
    }
}
