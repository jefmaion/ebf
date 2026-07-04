<?php

declare(strict_types = 1);

return [

    /** Configure the theme for Tabler.io */
    'theme-config' => [
        'theme'         => 'dark',  /** light, dark */
        'theme-base'    => 'zinc',  /** slate, gray, zinc, neutral, stone */
        'theme-font'    => 'sans-serif',  /** sans-serif, serif, monospace, comic */
        'theme-primary' => 'azure',  /** blue, azure, indigo, purple, pink, red, orange, yellow, lime, green, teal,m cyan    */
        'theme-radius'  => '1',  /** 0, 0.5, 1, 1.5, 2 */
    ],

    /** Sidebar menu items */
    'sidebar-menu' => [

        'Bem-Vindo' => 'nav-header',

      

        'Checkin' => [
            'route' => 'checkin',
            'icon'  => file_get_contents(resource_path('views/components/icons/home.blade.php')),
        ],

        'Checkout' => [
            'route' => 'checkout',
            'icon'  => file_get_contents(resource_path('views/components/icons/home.blade.php')),
        ],

      'Participantes' => [
            'route' => 'participant',
            'icon'  => file_get_contents(resource_path('views/components/icons/home.blade.php')),
        ],

        'Usuários' => [
            'route' => 'users',
            'icon'  => file_get_contents(resource_path('views/components/icons/home.blade.php')),
        ],

        // 'Perfil' => [
        //     'route' => 'profile',
        //     'icon'  => file_get_contents(resource_path('views/components/icons/profile.blade.php')),
        // ],

        // 'Menu Item 1' => [
        //     'route' => '',
        //     'icon'  => file_get_contents(resource_path('views/components/icons/home.blade.php')),

        //     'submenu' => [

        //         'Sub Item 1' => [
        //             'route'   => '',
        //             'icon'    => '',
        //             'submenu' => [
        //                 'Sub Sub Item 2' => [
        //                     'route' => '',
        //                     'icon'  => file_get_contents(resource_path('views/components/icons/home.blade.php')),
        //                     'tag'   => ['color' => 'bg-green', 'label' => 'Opa'],
        //                 ],
        //             ],
        //         ],
        //         'Sub Item 2' => [
        //             'route' => '',
        //             'icon'  => '',
        //         ],
        //         'Sub Item 3' => [
        //             'route' => false,
        //             'icon'  => '',
        //         ],
        //     ],
        // ],

        // 'Menu Item 2' => [
        //     'route' => false,
        //     'icon'  => '',
        // ],

    ],

];
