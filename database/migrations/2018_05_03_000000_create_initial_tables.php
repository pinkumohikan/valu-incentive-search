<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration
{
    public function up()
    {
        Schema::create('valu_owners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('valu_user_id');
            $table->string('name');
            $table->unsignedInteger('watcher_count');
            $table->string('job')->nullable();
            $table->text('self_introduction')->nullable();
            $table->string('icon_url')->nullable();
            $table->timestamps();
            $table->unique('valu_user_id');
        });

        Schema::create('display_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('valu_owner_id');
            $table->string('ip_address');
            $table->string('user_agent', 300);
            $table->timestamps();
            $table->foreign('valu_owner_id')->references('id')->on('valu_owners');
        });

        Schema::create('valu_incentives', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('valu_owner_id');
            $table->string('name');
            $table->text('description');
            $table->string('condition');
            $table->date('registered_at');
            $table->date('period_start_at');
            $table->date('period_end_at');
            $table->text('image_url');
            $table->mediumText('thumbnail');
            $table->timestamps();
            $table->foreign('valu_owner_id')->references('id')->on('valu_owners');
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue');
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
            $table->index(['queue', 'reserved_at']);
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->unique();
            $table->text('value');
            $table->integer('expiration');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cache');

        Schema::dropIfExists('failed_jobs');

        Schema::dropIfExists('jobs');

        Schema::dropIfExists('valu_incentives');

        Schema::dropIfExists('display_permissions');

        Schema::dropIfExists('valu_owners');
    }
}
