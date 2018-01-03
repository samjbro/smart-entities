Add the following to App\Providers\AuthServiceProvider in the boot function below $this->registerPolicies():

`Auth::provider('smartprovider', function() {
    return new App\Extensions\SmartUserProvider($this->app['hash'], app()->make(App\Services\UserService::class));
});`


In config/auth:
1) Change guards.web.provider to 'smart'
2) Add the following to the providers array:
`'smart' => [
    'driver' => 'smartprovider',
    'model' => App\Entities\UserEntity::class,
]`