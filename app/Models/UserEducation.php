<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserEducation extends Model
{
    use HasFactory;

    protected $table = 'user_education';

    protected $fillable = [
        'user_detail_id',
        'degree',
        'institution',
        'city',
        'passing_year',
        'cgpa',
        'description',
    ];

    protected $casts = [
        'user_detail_id' => 'integer',
        'passing_year' => 'date',
    ];

    public function userDetail(): belongsTo
    {
        return $this->belongsTo(UserDetail::class, 'user_detail_id', 'id');
    }
}
