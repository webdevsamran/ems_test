<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cv_status',
        'status',
        'department_id',
        'designation_id',
        'cnic_number',
        'basic_salary'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed'
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return Auth::user()->status == 1 && (bool)Auth::id();
    }

    public function details()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'id')
            ->with(['cvType', 'cvSource', 'cvMedium','educations', 'experiences'])
            ->latest();
    }


    public function remarks(): HasMany
    {
        return $this->hasMany(Remark::class, 'user_id', 'id')
            ->join('users', 'users.id', '=', 'remarks.updated_by_id')
            ->select('remarks.*', 'users.name as updated_by_name')
            ->latest();
    }

    public function latestRemark(): HasOne
    {
        return $this->hasOne(Remark::class, 'user_id', 'id')
            ->latest();
    }

    public function getLatestRemark()
    {
        return $this->hasMany(Remark::class, 'user_id', 'id')
            ->groupBy('remarks.user_id')
            ->select('remarks.user_id', DB::raw('MAX(remarks.created_at) as latest_created_at'))
            ->orderBy('latest_created_at', 'desc')
            ->get();
    }

    public function files(): hasOne
    {
        return $this->hasOne(UserFile::class, 'user_id', 'id');
    }

    public function profile(): hasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function skills(){
        return $this->hasManyThrough(CvSkill::class,UserSkill::class,'user_id','id','id','skill_id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id')->latest('date');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function salarySetups(): hasOne
    {
        return $this->hasOne(SalarySetup::class, 'user_id', 'id');
    }

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'user_id', 'id')->latest('date');
    }
}
