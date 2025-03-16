<?php

use App\Models\UserType;
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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\UserType::class)
                ->after('remember_token')
                ->constrained()
                ->cascadeOnDelete();
        });

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('adminpassword'),
            'remember_token' => Str::random(10),
            'user_type_id' => UserType::query()->where('name', 'admin')->get()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'David K',
            'email' => 'david@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('davidpassword'),
            'remember_token' => Str::random(10),
            'user_type_id' => UserType::query()->where('name', 'user')->get()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Sarah M',
            'email' => 'sarah@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('sarahpassword'),
            'remember_token' => Str::random(10),
            'user_type_id' => UserType::query()->where('name', 'user')->get()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
};
