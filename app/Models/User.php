<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *
     */
    public static function lists($searchForm)
    {
        $whereParams = [];
        $query = User::where($whereParams);
        if (issetAndNotEmpty($searchForm['username'])) {
            $query->where('username', 'like', '%' . $searchForm['username'] . '%');
        }
        return $query->paginate(config('app.pageSize'));
    }
}