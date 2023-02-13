<?php

namespace Mirage\Reports\Providers;

use Illuminate\Support\ServiceProvider;

class ReportProvider extends ServiceProvider{

    public function register(){

    }

    public function boot(){
        $this->loadRoutesFrom(__DIR__."/../routes/web.php");
        $this->loadViewsFrom(__DIR__.'/../resources/views/reports' , 'reports');
    }
}
