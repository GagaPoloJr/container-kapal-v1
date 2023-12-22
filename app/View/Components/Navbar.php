<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $navbarData = [
            ['route' => 'dashboard', 'label' => 'Dashboard', 'isHasChild' => false],
            ['route' => 'dashboard', 'label' => 'Pencatatan Resi', 'isHasChild' => false],
            [
                'route' => 'dashboard',
                'label' => 'Pencatatan Bongkaran',
                'isHasChild' => true,
                'children' => [
                    ['route' => 'dashboard', 'label' => 'Daftar Bongkaran Container'],
                    ['route' => 'dashboard', 'label' => 'Bon Truck'],
                    ['route' => 'dashboard', 'label' => 'Daftar Bongkaran Container Rinci'],
                    ['route' => 'dashboard', 'label' => 'Surat Penyerahan DO'],

                ],
            ],
            [
                'route' => 'dashboard',
                'label' => 'Pencatatan Checking',
                'isHasChild' => true,
                'children' => [
                    ['route' => 'dashboard', 'label' => 'Pencatatan Tally Checking'],
                    ['route' => 'dashboard', 'label' => 'Pencatatan Ret Checking'],
                    ['route' => 'dashboard', 'label' => 'Pencatatan Validasi Pengiriman'],

                ],
            ],
            ['route' => 'dashboard', 'label' => 'Invoice', 'isHasChild' => false],
            [
                'route' => 'master',
                'label' => 'Master',
                'isHasChild' => true,
                'children' => [
                    ['route' => 'customers', 'label' => 'Pelanggan'],
                    ['route' => 'trucks', 'label' => 'Truk'],
                    ['route' => 'settings.index', 'label' => 'Pengaturan'],
                    ['route' => 'users', 'label' => 'Pengguna / Karyawan'],

                ],
            ],

        ];

        return view('components.navbar', compact('navbarData'));
    }
}
