<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Deposit extends Model
{
    public function account(): BelongsTo
    {
        return $this->BelongsTo(Account::class);
    }

    public function transaction(): MorphOne
    {
        return $this->MorphOne(Transaction::class, 'transactionable');
    }
}
