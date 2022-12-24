<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDropColumnsCreatedAtAndUpdatedAtInConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configs', function (Blueprint $table) {
            if (Schema::hasColumn('configs', 'created_at')) {
                $table->dropColumn('created_at');
            }
        });
        Schema::table('configs', function (Blueprint $table) {
            if (Schema::hasColumn('configs', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
