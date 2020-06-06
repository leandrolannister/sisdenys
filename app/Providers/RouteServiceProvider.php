<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapWebRoutesInstituicao();

        $this->mapWebRoutesUnidade();

        $this->mapWebRoutesUser();

        $this->mapWebRoutesTipoUsuario();

        $this->mapWebRoutesGrupoChamado();

        $this->mapWebRoutesChamado();

        $this->mapWebRoutesTipoChamado();
               
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapWebRoutesInstituicao()
    {
      Route::prefix('instituicao')
        ->middleware('web')
        ->namespace('App\Http\Controllers\Instituicao')
        ->group(base_path('routes/Instituicao.php'));
    }

    protected function mapWebRoutesUnidade()
    {
      Route::prefix('unidade')
        ->middleware('web')
        ->namespace('App\Http\Controllers\Unidade')
        ->group(base_path('routes/Unidade.php'));
    }

    protected function mapWebRoutesUser()
    {
      Route::prefix('user')
        ->middleware('web')
        ->namespace('App\Http\Controllers\User')
        ->group(base_path('routes/User.php'));
    }

    protected function mapWebRoutesTipoUsuario()
    {
      Route::prefix('tipousuario')
        ->middleware('web')
        ->namespace('App\Http\Controllers\TipoUsuario')
        ->group(base_path('routes/TipoUsuario.php'));
    }

    protected function mapWebRoutesGrupoChamado()
    {
      Route::prefix('grupochamado')
        ->middleware('web')
        ->namespace('App\Http\Controllers\GrupoChamado')
        ->group(base_path('routes/GrupoChamado.php'));
    }

    protected function mapWebRoutesChamado()
    {
      Route::prefix('chamado')
        ->middleware('web')
        ->namespace('App\Http\Controllers\Chamado')
        ->group(base_path('routes/Chamado.php'));
    }    

    protected function mapWebRoutesTipoChamado()
    {
      Route::prefix('tipochamado')
        ->middleware('web')
        ->namespace('App\Http\Controllers\TipoChamado')
        ->group(base_path('routes/TipoChamado.php'));
    } 
    
    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
