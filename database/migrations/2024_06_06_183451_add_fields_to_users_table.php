<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("users", function (Blueprint $table) {
            $table->string("username")->unique();
            $table->date("dob")->nullable();
            $table->string("gender");
            $table->string("address");
            $table->string("city");
            $table->string("contact");
            $table->string("paypal_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("users", function (Blueprint $table) {
            $table->dropColumn("username");
            $table->dropColumn("dob");
            $table->dropColumn("gender");
            $table->dropColumn("address");
            $table->dropColumn("city");
            $table->dropColumn("contact");
            $table->dropColumn("paypal_id");
        });
    }
};
