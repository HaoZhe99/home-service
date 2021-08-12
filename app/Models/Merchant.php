<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Merchant extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const STATUS_SELECT = [
        'pending'  => 'Pending',
        'reject'   => 'Reject',
        'approved' => 'Approved',
    ];

    public $table = 'merchants';

    protected $appends = [
        'ssm_document',
        'logo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'description',
        'contact_number',
        'status',
        'address',
        'state_id',
        'longitude',
        'latitude',
        'ssm_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function getSsmDocumentAttribute()
    {
        return $this->getMedia('ssm_document')->last();
    }

    public function getLogoAttribute()
    {
        return $this->getMedia('logo')->last();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
