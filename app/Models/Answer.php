<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];
    protected $appends = ['attrs'];
    protected $casts = [
        'answer' => 'object',
    ];

    public function getAttrsAttribute(): array
    {
        if (!$this->answer) {
            return [];
        }

        return is_string($this->answer)
            ? json_decode($this->answer, true)
            : (array) $this->answer;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
