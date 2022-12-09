<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AlterAddTimestampsColumnToUserTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (!Schema::hasColumn('users', 'timestamps')){
                Schema::table('users', function (Blueprint $table) {
                    $table->timestamps();
                });
            }
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            if (!Schema::hasColumn('users', 'timestamps')){
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('timestamps');
                });
            }
        }
    }
