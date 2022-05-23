<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->integer('quantity');
            $table->integer('percent');
            $table->decimal('price', 11, 2);
            $table->timestamp('start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('approved')->default(1);
            $table->timestamps();
        });

        Schema::create('history_discounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('discount_id')->index();
            $table->bigInteger('user_id')->index();
            $table->string('section_used')->nullable();
            $table->boolean('approved')->default(1);
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
        Schema::dropIfExists('discounts');
        Schema::dropIfExists('history_discounts');
    }
}
