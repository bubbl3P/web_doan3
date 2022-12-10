<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AltterColumnCompanyIdNullableInPostsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            if (Schema::hasColumn('posts', 'company_id')) {
                Schema::table('posts', function (Blueprint $table) {
                    $table->unsignedBigInteger('company_id')->nullable()->change();
                });
            }
        }


        public function down()
        {

        }
    }
