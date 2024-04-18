<?php

namespace App\Providers;

use App\Services\MailchimpNewsletter;
use App\Services\ConvertKitNewsletter;
use Illuminate\Support\Facades\Gate;
use App\Services\Newsletter;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(Newsletter::class, function(){

            $client = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us18'
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        //Paginator::useBootstrap();
        Model::unguard();

        Gate::define('admin', function (User $user){
            return $user->username == 'juancr';
        });
    }
}
