<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use Auth;
class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function hasPermission($actionName)
    {
        if (isNoneAuthorizeAction($actionName))
            return true;
        
        if ($this->role->id == config("constants.SUPERADMIN_ROLE_ID"))
            return true;
        $permissions = $this->role['permissions'];
        return in_array($actionName, $permissions);
    }
}
