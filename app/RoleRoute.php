<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleRoute extends Model {

    protected $table = 'role_routes';
    protected $fillable = ['route', 'method', 'role_id'];

}
