<?php

namespace App\Models;

use App\Models\Relations\WithAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pack extends Model
{
    use HasFactory, WithAble;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',

    ];

    protected $with = [
        'wolves'
    ];

    public function wolves()
    {
        return $this->hasMany('App\Models\Wolf');
    }
}
