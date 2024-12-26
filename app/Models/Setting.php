<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Setting extends Model
{
    use HasFactory;




    protected static $logAttributes = ['function_desc',
        'function',
        'type'];  
    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $action = $model->wasRecentlyCreated ? 'created' : 'updated'; 

            activity()->performedOn($model)
            ->causedBy(auth()->user())
            ->log("Setting $action");
        });
    }









       protected $fillable = [
        'function_desc',
        'function',
        'type',
    ];
}
