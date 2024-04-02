<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cv_type_id',
        'cv_source_id',
        'cv_medium_id',
        'cv_skill_ids',
        'phone',
        'address',
        'education',
        'experience',
    ];

    protected $casts = [
        'cv_skill_ids' => 'array',
    ];
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cvSource(): BelongsTo
    {
        return $this->belongsTo(CvSource::class, 'cv_source_id', 'id');
    }
    public function cvType(): BelongsTo
    {
        return $this->belongsTo(CvType::class, 'cv_type_id', 'id');
    }

    public function cvMedium(): BelongsTo
    {
        return $this->belongsTo(CvMedium::class, 'cv_medium_id', 'id');
    }

    public function educations(): hasMany
    {
        return $this->hasMany(UserEducation::class, 'user_detail_id', 'id');
    }

    public function experiences(): hasMany
    {
        return $this->hasMany(UserExpriance::class, 'user_detail_id', 'id');
    }
}
