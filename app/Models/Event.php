<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use File;
use Illuminate\Support\Str;

//use App\Models\Registration;

class Event extends Model
{
    use HasFactory;
    use HasSlug;

    protected static function boot()
    {
        parent::boot();

        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user()->id;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });

        static::deleted(function ($model) {
            File::deleteDirectory(public_path('uploads/events/' . $model->uuid));
        });
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    } // end function getSlugOptions

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'created_by',
        'updated_by',
        'status',
        'start_date',
        'end_date',
        'registration_start_date',
        'registration_end_date',
        'uuid',
        'venue',
        'image'
    ];


    /**
     *get cosponsors .
     *
     * @return Attribute
     */
    protected function cosponsors(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value),
        );
    } // end function cosponsors


    /**
     * created by this user
     * @return BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    } // end function createdBy


    /**
     * updated by this user
     * @return BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    } // end function updatedBy

    // /**
    //  * get registrations
    //  */
    // public function registrations()
    // {
    //     return $this->hasMany(Registration::class);
    // } // end function registrations
} // end class Page