<?php

namespace Web3\Storage;

use Web3\Storage\Web3StorageAPIClient;
use Illuminate\Support\ServiceProvider;

class Web3StorageAPIClientServiceProvider extends ServiceProvider
{

    public $singletons = [
        Web3StorageAPIClient::class => Web3StorageAPIClient::class
    ];
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
