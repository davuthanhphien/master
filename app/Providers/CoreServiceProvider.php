<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Menu\MenuRepository;
use App\Repositories\Menu\MenuRepositoryInterface;
use App\Repositories\Banner\BannerRepository;
use App\Repositories\Banner\BannerRepositoryInterface;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Widgets\WidgetsReposiory;
use App\Repositories\Widgets\WidgetsRepositoryInterface;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MenuRepositoryInterface::class,MenuRepository::class);
        $this->app->singleton(BannerRepositoryInterface::class,BannerRepository::class);
        $this->app->singleton(PermissionRepositoryInterface::class,PermissionRepository::class);
        $this->app->singleton(RoleRepositoryInterface::class,RoleRepository::class);
        $this->app->singleton(UserRepositoryInterface::class,UserRepository::class);
        $this->app->singleton(WidgetsRepositoryInterface::class,WidgetsReposiory::class);
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
