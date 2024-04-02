<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserExpriance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_detail_id',
        'company',
        'designation_start',
        'designation_end',
        'started_date',
        'ended_date',
        'salary_start',
        'salary_end',
        'description',
    ];

    protected $casts = [
        'user_detail_id' => 'integer',
        'started_date' => 'date',
        'ended_date' => 'date',
    ];

    public function userDetail(): belongsTo
    {
        return $this->belongsTo(UserDetail::class, 'user_detail_id', 'id');
    }
}
