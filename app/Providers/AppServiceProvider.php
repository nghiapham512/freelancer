<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add('QUẢN LÝ WEBSITE');
            $event->menu->add([
                'text' => 'QUẢN LÝ DỰ ÁN',
                'icon' => 'briefcase',
                'submenu' => [
                    [
                        'text' => 'Danh sách dự án',
                        'url'  => route('admin.projects.index'),
                    ],
                ]
            ]);
            $event->menu->add('QUẢN LÝ TÀI KHOẢN');
            $event->menu->add([
                'text'      =>  'TÀI KHOẢN ADMIN',
                'icon'      =>  'vcard',
                'submenu'   =>  [
                    [
                        'text'  =>  'Danh sách admin',
                        'url'   =>  route('admin.admin_account.index')
                    ],

                    [
                        'text' => 'Thêm admin',
                        'url' => route('admin.admin_account.add')
                    ]
                ]
            ]);
            $event->menu->add([
                'text'      =>  'TÀI KHOẢN USER',
                'icon'      =>  'users',
                'submenu'   =>  [
                    [
                        'text'  =>  'Danh sách user',
                        'url'   =>  route('admin.user_account.index')
                    ],
                ]
            ]);
            $event->menu->add('MY PROFILE');
            $event->menu->add([
                'text'      =>  'TÀI KHOẢN CỦA TÔI',
                'icon'      =>  'user',
                'url'       =>  route('admin.my_profile.index'),
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            'backend\Admin\AdminRepositoryInterface'  => 'backend\Admin\AdminRepository',
            'backend\User\UserRepositoryInterface'  => 'backend\User\UserRepository',
        ];
        foreach ($repositories as $key=>$val){
            $this->app->bind("App\\Repositories\\$key", "App\\Repositories\\$val");
        }
    }
}
