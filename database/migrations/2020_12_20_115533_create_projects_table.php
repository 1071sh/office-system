<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->integer('client_id')->unsigned()->nullable();
            // $table->foreign('client_id')->references('id')->on('clients'); // 外部キー参照
            $table->string('name');
            $table->string('industry')->nullable();       // 業界
            $table->integer('billing')->nullable();       // 請求額
            $table->date('start_date')->nullable();       // 開始日
            $table->date('end_date')->nullable();         // 終了日
            $table->text('notes')->nullable();            // 説明;
            $table->boolean('is_deleted')->default(false);// 削除済みか
            $table->softDeletes();  // 論理削除
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
        Schema::dropIfExists('projects');
    }
}
