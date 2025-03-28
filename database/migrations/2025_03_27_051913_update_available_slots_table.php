<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('available_slots', function (Blueprint $table) {
        $table->time('start_time')->after('date');  
        $table->time('end_time')->after('start_time');  
        // $table->dropColumn('time');  

    });
}

public function down()
{
    Schema::table('available_slots', function (Blueprint $table) {
        $table->time('time')->after('date'); // Agar rollback ho to wapas time add ho
        $table->dropColumn(['start_time', 'end_time']);
    });
}

};
