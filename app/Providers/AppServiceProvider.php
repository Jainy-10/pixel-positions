<?php

namespace App\Providers;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Gate::define('create-job', function (User $user) {
            return $user->isEmployer();
        });

        Gate::define('edit-job', function (User $user, Job $job) {
            return $job->employer->user->is($user);
        });

        Gate::define('view-application',  function (User $user, Application $application) {
            return $user->isEmployer() && $application->job->employer->is($user->employer); 
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });
    }

    const HOME = '/dashboard';
}
