<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Purchase;
use App\Models\LoyaltyCard;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create users
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'sad457459@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'kaled',
            'email' => 'odemfmpoej@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'santiago',
            'email' => 'santi@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user4 = User::create([
            'name' => 'santiag',
            'email' => 'santiago2@gmail.com', // Changed to avoid duplicate email
            'password' => Hash::make('password'),
        ]);

        // Create purchases for user 4
        Purchase::create([
            'user_id' => $user4->id,
            'amount' => 1.00,
            'description' => 'primera',
            'status' => 'approved',
        ]);

        Purchase::create([
            'user_id' => $user4->id,
            'amount' => 10000.00,
            'description' => 'dnnjr',
            'status' => 'pending',
        ]);

        // Create loyalty card for user 4
        LoyaltyCard::create([
            'user_id' => $user4->id,
            'purchases_count' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // It's generally not recommended to delete data in a down migration,
        // but for a seeder-migration, we can make an exception.
        DB::table('loyalty_cards')->delete();
        DB::table('purchases')->delete();
        DB::table('users')->where('email', 'sad457459@gmail.com')->delete();
        DB::table('users')->where('email', 'odemfmpoej@gmail.com')->delete();
        DB::table('users')->where('email', 'santi@gmail.com')->delete();
        DB::table('users')->where('email', 'santiago2@gmail.com')->delete();
    }
};
