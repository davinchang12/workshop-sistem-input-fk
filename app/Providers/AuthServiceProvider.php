<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('mahasiswa', function(User $user){
            return $user->role === 'mahasiswa';
        });
        Gate::define('dosen', function(User $user){
            return $user->role === 'dosen' || $user->role === 'admin' || $user->role === 'superadmin';
        });
        Gate::define('admin', function(User $user){
            return $user->role === 'admin' || $user->role === 'superadmin';
        });
        Gate::define('superadmin', function(User $user){
            return $user->role === 'superadmin';
        });
        //
    }
}
