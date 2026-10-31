<?php

namespace App\Providers;

use App\Models\Listing;
use App\Models\Project;
use App\Models\User;
use App\Services\BrandSettings;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(BrandSettings::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access-admin', fn (User $user) => $user->is_admin);
        Relation::enforceMorphMap(['listing' => Listing::class, 'project' => Project::class]);
        Livewire::addNamespace(namespace: 'admin', viewPath: resource_path('views/admin'));
        View::share('brand', app(BrandSettings::class));
        RateLimiter::for('enquiries', fn (Request $request) => Limit::perMinute(5)->by($request->ip()));
        RateLimiter::for('availability', fn (Request $request) => Limit::perMinute(60)->by($request->ip()));
    }
}
