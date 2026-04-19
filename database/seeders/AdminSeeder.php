<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Enums\UserStatus;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Schema::disableForeignKeyConstraints();
        // Admin::query()->truncate();
        // Schema::enableForeignKeyConstraints();

        Admin::query()->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@domain.com',
                'password' => Hash::make('12344321aA@'),
                'status' => UserStatus::ACTIVE->value,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
