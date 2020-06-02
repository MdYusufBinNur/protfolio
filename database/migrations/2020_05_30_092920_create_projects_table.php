<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_category_id');
            $table->string('project_name');
            $table->string('project_client')->nullable();
            $table->longText('project_details')->nullable();
            $table->string('project_links')->nullable();
            $table->date('project_date')->nullable();
            $table->string('project_comments')->nullable();
            $table->string('project_rating')->nullable();
            $table->string('project_image')->nullable();
            $table->timestamps();

            $table->foreign('project_category_id')
                ->on('project_categories')
                ->references('id')
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
        Schema::dropIfExists('projects');
    }
}
