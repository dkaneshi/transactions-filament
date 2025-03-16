<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER update_balance_on_updated_deposit
            AFTER UPDATE OF amount ON deposits
            BEGIN
                UPDATE accounts
                SET balance = balance - OLD.amount + NEW.amount
                WHERE id = NEW.account_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_balance_on_updated_deposit');
    }
};
