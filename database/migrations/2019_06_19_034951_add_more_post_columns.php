<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMorePostColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dateTime('publish_at')->nullable();
            $table->dateTime('publish_until')->nullable();
            $table->boolean('is_published')->default(false);
            $table->string('category')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('publish_at');
            $table->dropColumn('publish_until');
            $table->dropColumn('is_published');
            $table->dropColumn('category');
            $table->dropForeign('user_id');
            $table->dropColumn('user_id');
        });
    }
}
