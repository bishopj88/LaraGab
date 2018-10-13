<?php

namespace BishopJ88\LaraGab;

use Illuminate\Support\ServiceProvider;

class LaraGabServiceProvider extends ServiceProvider
{
    
    protected $defer = false;
    
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/laragab.php' => config_path('laragab.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {   
        $this->app->bind('BishopJ88\LaraGab\LaraGab',function($app){
            return new LaraGab($app);
        });
    }

}