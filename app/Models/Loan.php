<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\LogsActivity;
class Loan extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'book_id',
        'loan_date',
        'return_date',
        'actual_return_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'loan_date' => 'date',
            'return_date' => 'date',
            'actual_return_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}