<?php

namespace SampleManager\Models;

use Illuminate\Database\Eloquent\Model;
use SampleManager\Models\Sample;
use SampleManager\User;

class Request extends Model
{
    // Attributes
    protected $table = 'requests';

    protected $hidden = [
        'user_id',
    ];

    // Relations
    public function samples()
    {
        return $this->belongsToMany(Sample::class)->withPivot('quantity');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Cleaner model output
    public function toArray()
    {
        $attributes = $this->attributesToArray();
        $attributes = array_merge($attributes, $this->relationsToArray());

        unset($attributes['pivot']['sample_id']);
        unset($attributes['pivot']['request_id']);

        return $attributes;
    }
}
