<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Profile extends Model
{
     use HasFactory;






    protected static $logAttributes = ['user_id', 'firstname', 'lastname', 'phone_number', 'address', 'profile_picture', 'birthdate', 'gender', 'nationality', 'bio'];  
    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $action = $model->wasRecentlyCreated ? 'created' : 'updated'; 

            activity()->performedOn($model)
            ->causedBy(auth()->user())
            ->log("Profile $action");
        });
    }


     

  protected $table = 'profiles'; 
    protected $fillable = ['user_id', 'firstname', 'lastname', 'phone_number', 'address', 'profile_picture', 'birthdate', 'gender', 'nationality', 'bio'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }


        public function getFullNameAttribute()
    {
        $firstname = $this->firstname;
        $middlename = $this->middlename ?? '';  // Handle nullable middlename
        $lastname = $this->lastname;

        // Get the first letter of the middle name (if exists)
        $middleInitial = $middlename ? strtoupper(substr($middlename, 0, 1)) . '.' : '';

        return "{$firstname} {$middleInitial} {$lastname}";
    }
}
