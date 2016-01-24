<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetailsToInquiryProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inquiry_profiles', function (Blueprint $table) {
            //
            $table->text('destination')->nullable();
            $table->text('boat_type')->nullable();
            $table->text('notes')->nullable();
            $table->text('interests')->nullable();
            $table->boolean('processed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inquiry_profiles', function (Blueprint $table) {
            //
            $table->dropColumn('destination');
            $table->dropColumn('boat_type');
            $table->dropColumn('notes');
            $table->dropColumn('interests');
            $table->dropColumn('processed');
        });
    }
}
