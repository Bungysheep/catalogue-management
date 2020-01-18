<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_access', function (Blueprint $table) {
            $table->string('role_code', 16);
            $table->string('entity_key', 16);
            $table->jsonb('override_access', 1024)->default('{}');

            $table->unique([
                'role_code',
                'entity_key'
            ]);

            $table->foreign('role_code')->references('role_code')->on('roles')->onDelete('cascade');
            $table->foreign('entity_key')->references('entity_key')->on('entity_access')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_access');
    }
}
