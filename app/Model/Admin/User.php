<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Admin\User
 *
 * @property int $id
 * @property string $username 用户名
 * @property string $email 邮箱
 * @property string $sex 性别1：男，2：女
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $password 密码
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Admin\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Admin\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Admin\User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = [''];

    public function userextinfo()
    {
        return $this->hasOne(Userext::class,'user_id','id');
    }

    public function arts()
    {
        return $this->hasMany(Art::class,'user_id','id');
    }

    public function auths()
    {
        return $this->belongsToMany(Auth::class,'admins','user_id','auth_id');
    }
}
