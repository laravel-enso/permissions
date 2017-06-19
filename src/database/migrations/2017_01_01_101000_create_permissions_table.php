<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_group_id')->unsigned()->index();
            $table->foreign('permission_group_id')->references('id')->on('permission_groups')->onUpdate('restrict')->onDelete('restrict');
            $table->string('name')->unique()->index();
            $table->string('description')->nullable();
            $table->tinyInteger('type');
            $table->boolean('default')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
