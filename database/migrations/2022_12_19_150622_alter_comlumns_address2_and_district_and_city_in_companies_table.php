<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AlterComlumnsAddress2AndDistrictAndCityInCompaniesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('companies', function (Blueprint $table) {
                if (Schema::hasColumn('companies', 'address2')) {
                    $table->dropColumn('address2');
                }
            });
            Schema::table('companies', function (Blueprint $table) {
                if (Schema::hasColumn('companies', 'district')) {
                    $table->dropColumn('district');
                }
            });
            Schema::table('companies', function (Blueprint $table) {
                if (Schema::hasColumn('companies', 'city')) {
                    $table->dropColumn('city');
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
