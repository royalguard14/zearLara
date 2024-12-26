<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Module extends Model
{
    use HasFactory;




    protected static $logAttributes = ['name', 'icon', 'description', 'url'];  
    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $action = $model->wasRecentlyCreated ? 'created' : 'updated'; 

            activity()->performedOn($model)
            ->causedBy(auth()->user())
            ->log("Module $action");
        });
    }



    protected $table = 'modules'; 
     protected $fillable = ['name', 'icon', 'description', 'url'];


         public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
