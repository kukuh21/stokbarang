<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-kecamatan', function($user) {
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });


        Gate::define('manage-jenissurat', function($user) {
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('manage-users', function($user) {
            // TODO: logika untuk mengizinkan manage users
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('manage-suratmasuk', function($user) {
            // TODO: logika untuk mengizinkan manage users
            return count(array_intersect(["KECAMATAN","PENGGUNA","VERIFIKATOR","OPERATOR", "SUBKON"], json_decode($user->roles)));
        });

        Gate::define('manage-suratkeluar', function($user) {
            // TODO: logika untuk mengizinkan manage users
            return count(array_intersect(["KECAMATAN","OPERATOR","SUBKON"], json_decode($user->roles)));
        });

        Gate::define('manage-bidang', function($user) {
            // TODO: logika untuk mengizinkan manage users
            return count(array_intersect(["KECAMATAN"], json_decode($user->roles)));
        });

        Gate::define('manage-kodesurat', function($user) {
            // TODO: logika untuk mengizinkan manage users
            return count(array_intersect(["KECAMATAN"], json_decode($user->roles)));
        });

        Gate::define('manage-laporankecamatan', function($user) {
            // TODO: logika untuk mengizinkan manage users
            return count(array_intersect(["KECAMATAN"], json_decode($user->roles)));
        });

        Gate::define('manage-userskecamatan', function($user) {
            // TODO: logika untuk mengizinkan manage users
            return count(array_intersect(["KECAMATAN"], json_decode($user->roles)));
        });

        Gate::define('manage-kodesurattugas', function($user) {
            // TODO: logika untuk mengizinkan manage users
            return count(array_intersect(["KECAMATAN"], json_decode($user->roles)));
        });

        Gate::define('manage-kodesuratsppd', function($user) {
            // TODO: logika untuk mengizinkan manage users
            return count(array_intersect(["KECAMATAN"], json_decode($user->roles)));
        });

        Gate::define('manage-pegawai', function($user) {
            // TODO: logika untuk mengizinkan manage users
            return count(array_intersect(["KECAMATAN"], json_decode($user->roles)));
        });

        Gate::define('manage-surattugas', function($user) {
            // TODO: logika untuk mengizinkan manage users
            return count(array_intersect(["KECAMATAN","OPERATOR","SUBKON"], json_decode($user->roles)));
        });

        Gate::define('manage-suratsppd', function($user) {
            // TODO: logika untuk mengizinkan manage users
            return count(array_intersect(["KECAMATAN","OPERATOR","SUBKON"], json_decode($user->roles)));
        });

        Gate::define('manage-skpd', function($user) {
            return count(array_intersect(["KECAMATAN"], json_decode($user->roles)));
        });

    }
}
