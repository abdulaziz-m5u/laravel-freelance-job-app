<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Proposal extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function getRejectedAtAttribute($value)
    {
        
        return $value ? Carbon::parse($value)->format('d, M Y') : null;
    }

    public function getApprovedAtAttribute($value)
    {
        
        return $value ? Carbon::parse($value)->format('d, M Y  H:i:s') : null;
    }

    public function getDeliveryTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d, M Y H:i:s') : null;
    }

    public function getattachmentsAttribute()
    {
        return $this->getMedia('attachments');
    }
}
