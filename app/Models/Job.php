<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Job extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['id','created_at','updated_at'];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function proposals(){
        return $this->hasMany(Proposal::class);
    }

    public function getDeliveryDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d, M Y') : null;
    }

    public function setDeliveryDateAttribute($value)
    {
        $this->attributes['delivery_date'] = $value ? Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d') : null;
    }

    public function getattachmentsAttribute()
    {
        return $this->getMedia('attachments');
    }
}
