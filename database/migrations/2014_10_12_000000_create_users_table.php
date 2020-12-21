<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('job_category')->nullable();     // 職種
            $table->string('industry')->nullable();         // 業界
            $table->integer('wage')->nullable();            // 単価
            $table->text('notes')->nullable();              // メモ
            $table->string('status')->default('正社員');     // 雇用体系
            $table->integer('is_workable')->default(0);     // 0 労働可能  5 退職済み
            $table->tinyInteger('role')->default(5);        // 1 管理者  5 一般ユーザ
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->softDeletes();  // 論理削除
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
