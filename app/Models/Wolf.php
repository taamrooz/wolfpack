<?php

namespace App\Models;

use App\Models\Relations\WithAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Wolf extends Model
{
    use HasFactory, WithAble;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'gender',
        'birthdate',
        'lat',
        'lng',
        'pack_id',
    ];

    protected $with = [
        //'pack'
    ];

    public function pack()
    {
        return $this->belongsTo('App\Models\Pack');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'birthdate' => 'date',
    ];
}
