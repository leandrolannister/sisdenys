<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){       
      
      Gate::define('Admin',function ($user){
        if ($user->perfil == 'Admin')
          return true;
      });

      Gate::define('Tecnico',function ($user){
        if ($user->perfil == 'Tecnico')
          return true;
      });      

      Gate::define('Comum',function ($user){
        if ($user->perfil == 'Comum')
          return true;
      });                 
    }
}
