<?php

namespace SampleManager\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use SampleManager\Models\Request;

class Sample extends Model
{
    // Attributes
    protected $table = 'samples';

    protected $hidden = [
        'pivot',
    ];

    protected $appends = [
        'residual_quantity',
        'expired',
        'days_to_rejecting',
        'sampled',
    ];

    // Relations
    public function requests()
    {
        return $this->belongsToMany(Request::class)->withPivot('quantity');
    }

    // Accessors
    public function getResidualQuantityAttribute()
    {
        return (float) $this->residualQuantity();
    }

    public function getExpiredAttribute($value)
    {
        return $this->daysToRejecting() < 0;
    }

    public function getDaysToRejectingAttribute($value)
    {
        return $this->daysToRejecting();
    }

    public function getSampledAttribute($value)
    {
        return $this->quantity !== $this->residualQuantity();
    }

    // Protected methods
    protected function residualQuantity()
    {
        return (float) $this->quantity - $this->requests->sum('pivot.quantity');
    }

    protected function daysToRejecting()
    {
        $real_expiry = Carbon::parse($this->expiry)->addYears(1);

        return Carbon::now()->diffInDays($real_expiry);
    }
}
