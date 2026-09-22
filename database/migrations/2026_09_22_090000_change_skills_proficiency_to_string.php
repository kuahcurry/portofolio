<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->string('proficiency', 50)->default('intermediate')->change();
        });

        // Convert existing numeric percentage values to standardized level tiers
        DB::table('skills')->whereRaw("CAST(proficiency AS INTEGER) >= 90 AND proficiency NOT IN ('expert', 'advanced', 'intermediate', 'beginner')")->update(['proficiency' => 'expert']);
        DB::table('skills')->whereRaw("CAST(proficiency AS INTEGER) >= 80 AND CAST(proficiency AS INTEGER) < 90 AND proficiency NOT IN ('expert', 'advanced', 'intermediate', 'beginner')")->update(['proficiency' => 'advanced']);
        DB::table('skills')->whereRaw("CAST(proficiency AS INTEGER) >= 60 AND CAST(proficiency AS INTEGER) < 80 AND proficiency NOT IN ('expert', 'advanced', 'intermediate', 'beginner')")->update(['proficiency' => 'intermediate']);
        DB::table('skills')->whereRaw("CAST(proficiency AS INTEGER) < 60 AND CAST(proficiency AS INTEGER) > 0 AND proficiency NOT IN ('expert', 'advanced', 'intermediate', 'beginner')")->update(['proficiency' => 'beginner']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->integer('proficiency')->default(85)->change();
        });
    }
};
