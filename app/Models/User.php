<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



    protected static $logAttributes = ['username', 'email', 'password', 'role_id', 'isDeleted', 'isActive'];  
    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $logName = 'user_activity'; 
            $action = $model->wasRecentlyCreated ? 'created' : 'updated'; 

            activity()->performedOn($model)
            ->causedBy(auth()->user())
            ->log("User $action");
        });
    }




    protected $table = 'users'; 
    protected $fillable = ['username', 'email', 'password', 'role_id', 'isDeleted', 'isActive'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    // Define the relationship with the Profile model
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Define the relationship with the Role model
    public function role()
    {
        return $this->belongsTo(Role::class);
    }











}
