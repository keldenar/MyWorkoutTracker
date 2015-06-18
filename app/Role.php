<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name', 'description'];

    public function RoleRoutes()
    {
        return $this->hasMany('App\RoleRoute', 'role_id');
    }


    public function users()
    {
        return $this->belongsToMany('App\User', 'user_roles', 'role_id');
    }
}

