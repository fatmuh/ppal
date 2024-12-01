<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     */
    public static function menu(): array
    {
        return [
            'dashboard' => [
                'icon' => 'layout-dashboard',
                'route_name' => 'dashboard',
                'params' => [
                //     'layout' => 'side-menu'
                ],
                'title' => 'Dashboard',
                'roles' => ['super_admin', 'admin']

            ],
            'kta' => [
                'icon' => 'credit-card',
                'route_name' => 'kta.list',
                'params' => [
                //     'layout' => 'side-menu'
                ],
                'title' => 'KTA',
                'roles' => ['super_admin', 'admin']

            ],
            'users' => [
                'icon' => 'users',
                'route_name' => 'user.list',
                'params' => [
                //     'layout' => 'side-menu'
                ],
                'title' => 'Admin',
                'roles' => ['super_admin']

            ],
        ];
    }
}
