<?php

use App\Models\Sponsor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->string('url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Loop over every sponsor and set the url to app url
        $sponsors = Sponsor::all();
        foreach ($sponsors as $sponsor) {
            $sponsor->url = config('app.url');
            $sponsor->save();
        }

        Schema::table('sponsors', function (Blueprint $table) {
            $table->string('url')->nullable(false)->change();
        });
    }
};
