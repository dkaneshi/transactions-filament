<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER update_balance_deposit
            AFTER INSERT ON deposits
            BEGIN
                UPDATE accounts
                SET balance = balance + NEW.amount
                WHERE id = NEW.account_id;
            END;
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_balance_deposit_trigger');
    }
};
