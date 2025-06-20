<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'firstname',
        'lastname',
        'email',
        'password',
        'role',
        'age',
        'gender',
        'field_of_study',
        'company_name',
        'cv_path',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the user's favorites.
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoriteStudents()
    {
        return $this->belongsToMany(User::class, 'favorites', 'user_id', 'favoritable_id')
                    ->where('favoritable_type', User::class)
                    ->where('role', 'student');
    }

    public function scopeStudents($query)
    {
        return $query->where('role', 'student');
    }

    public function scopeBedrijven($query)
    {
        return $query->where('role', 'bedrijf');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getIsStudentAttribute()
    {
        return $this->role === 'student';
    }

    public function getIsBedrijfAttribute()
    {
        return $this->role === 'bedrijf';
    }

    public function getIsAdminAttribute()
    {
        return $this->role === 'admin';
    }

    public function canViewDashboard()
    {
        return $this->is_active;
    }

    public function getDashboardRoute()
    {
        return match($this->role) {
            'admin' => '/admin/dashboard',
            'bedrijf' => '/bedrijf/dashboard',
            'student' => '/student/dashboard',
            default => '/student/dashboard'
        };
    }
}
