<?php namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider {
    public function boot()
    {
        View::Composer(array('admin.admin','userMenu'), 'App\Http\ViewComposers\AdminComposer');
    }

    public function register()
    {

    }
}