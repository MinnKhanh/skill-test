<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->unsignedTinyInteger('age')->nullable()->after('last_name');
            $table->string('gender')->nullable()->after('age');
            $table->date('birth_date')->nullable()->after('gender');
            $table->foreignId('avatar_image_id')->nullable()->after('birth_date')->constrained('images')->nullOnDelete();
            $table->string('google_id')->nullable()->unique()->after('avatar_image_id');
            $table->string('google_avatar_url')->nullable()->after('google_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['avatar_image_id']);
            $table->dropUnique(['google_id']);
            $table->dropColumn([
                'first_name',
                'last_name',
                'age',
                'gender',
                'birth_date',
                'avatar_image_id',
                'google_id',
                'google_avatar_url',
            ]);
        });
    }
};
