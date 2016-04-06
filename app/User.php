<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param $relation
     *
     * @return bool
     */
    public function owns($relation)
    {
        return $relation->user_id == $this->id;
    }

    /**
     * User has many flyers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flyers()
    {
        return $this->hasMany(Flyer::class);
    }

    /**
     * Save flyer.
     *
     * @param Flyer $flyer
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function publish(Flyer $flyer)
    {
        return $this->flyers()->save($flyer);
    }
}
