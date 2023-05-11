<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Favorito
 *
 * @property $id
 * @property $user_id
 * @property $comic_id
 * @property $comic_title
 * @property $created_at
 * @property $updated_at
 *
 * @property Comic $comic
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Favorito extends Model
{

    static $rules = [
		'user_id' => 'required',
		'comic_id' => 'required',
		'comic_title' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','comic_id','comic_title'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function comic()
    {
        return $this->hasOne('App\Models\Comic', 'id_comics', 'comic_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }


}
