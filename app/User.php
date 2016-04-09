<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'sid', 'nickname', 'grade', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $guarded = ['id'];



    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    // 判断用户是否具有某个角色
    
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
     
        return !! $role->intersect($this->roles)->count();
    }

    // 判断用户是否具有某权限
    public function hasPermission($permission)
    {
        return $this->hasRole($permission->roles);
    }
    
    // 给用户分配角色
    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    public function owns($post)
    {
        return $this->id === $post->user_id;
    }

    public function articles()
    {
        return $this->hasMany(Articles::class);
    }




    public static function nickname($id)
    {
        $user = SELF::find($id, ['nickname']);
        return $user
        ? $user->nickname
        : '';
    }

}
