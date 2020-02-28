<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('details',500);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('priority_id');
            $table->enum('status',['Pending', 'Completed', 'On Hold', 'Canceled']);
            $table->softDeletes();  // This will add a deleted_at field
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')->on('category')
                ->onDelete('cascade');

            $table->foreign('priority_id')
                ->references('id')->on('priority')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task');
    }
}
