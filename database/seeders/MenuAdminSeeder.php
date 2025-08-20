<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuAdmin;
use App\Models\Role;

class MenuAdminSeeder extends Seeder
{
    public function run()
    {
        // Contoh menu dengan group dan parent
        $dashboard = MenuAdmin::create([
            'title' => 'Dashboard',
            'route_name' => 'dashboard.index',
            'icon' => 'feather-home',
            'group' => '',
            'order' => 1,
            'parent_id' => null,
        ]);

        $orders = MenuAdmin::create([
            'title' => 'Orders',
            'route_name' => 'orders.index',
            'icon' => 'feather-shopping-bag',
            'group' => 'Sales',
            'order' => 2,
            'parent_id' => null,
        ]);

        $product = MenuAdmin::create([
            'title' => 'Product',
            'route_name' => 'products.index',
            'icon' => 'feather-folder',
            'group' => 'Sales',
            'order' => 3,
            'parent_id' => null,
        ]);
        $production = MenuAdmin::create([
            'title' => 'Produksi',
            'route_name' => 'productions.index',
            'icon' => 'feather-life-buoy',
            'group' => 'Sales',
            'order' => 4,
            'parent_id' => null,
        ]);
        $productBrand = MenuAdmin::create([
            'title' => 'Product Brand',
            'route_name' => 'product-brands.index',
            'icon' => 'feather-tag',
            'group' => 'Sales',
            'order' => 5,
            'parent_id' => null,
        ]);
        $stock = MenuAdmin::create([
            'title' => 'Stok',
            'route_name' => 'stocks.index',
            'icon' => 'feather-package',
            'group' => 'Sales',
            'order' => 6,
            'parent_id' => null,
        ]);

        $stock = MenuAdmin::create([
            'title' => 'Stok Toko',
            'route_name' => 'stocks.index_shop',
            'icon' => 'feather-package',
            'group' => 'Sales',
            'order' => 7,
            'parent_id' => null,
        ]);

        $stock = MenuAdmin::create([
            'title' => 'Laporan',
            'route_name' => 'reports.order',
            'icon' => 'feather-pie-chart',
            'group' => 'Sales',
            'order' => 8,
            'parent_id' => null,
        ]);
        $stock = MenuAdmin::create([
            'title' => 'Laporan Stok',
            'route_name' => 'reports.stock',
            'icon' => 'feather-pie-chart',
            'group' => 'Sales',
            'order' => 9,
            'parent_id' => null,
        ]);
        $warranty = MenuAdmin::create([
            'title' => 'Garansi',
            'route_name' => 'warranties.index',
            'icon' => 'feather-gift',
            'group' => 'Sales',
            'order' => 9,
            'parent_id' => null,
        ]);

        $adminMenu = MenuAdmin::create([
            'title' => 'Admin Menu',
            'route_name' => 'menu_admins.index',
            'icon' => 'feather-grid',
            'group' => 'Main',
            'order' => 10,
            'parent_id' => null,
        ]);
        $role = MenuAdmin::create([
            'title' => 'Roles',
            'route_name' => 'roles.index',
            'icon' => 'feather-users',
            'group' => 'Main',
            'order' => 11,
            'parent_id' => null,
        ]);
        $permission = MenuAdmin::create([
            'title' => 'Permissions',
            'route_name' => 'permissions.index',
            'icon' => 'feather-lock',
            'group' => 'Main',
            'order' => 12,
            'parent_id' => null,
        ]);
        $province = MenuAdmin::create([
            'title' => 'Provinsi',
            'route_name' => 'provinces.index',
            'icon' => 'feather-map-pin',
            'group' => 'Main',
            'order' => 13,
            'parent_id' => null,
        ]);

        $brand = MenuAdmin::create([
            'title' => 'Brand',
            'route_name' => 'brands.index',
            'icon' => 'feather-tag',
            'group' => 'Main',
            'order' => 14,
            'parent_id' => null,
        ]);

        $vehicle = MenuAdmin::create([
            'title' => 'Kendaraan',
            'route_name' => 'vehicles.index',
            'icon' => 'feather-truck',
            'group' => 'Main',
            'order' => 15,
            'parent_id' => null,
        ]);

        $customer = MenuAdmin::create([
            'title' => 'Customer',
            'route_name' => 'customers.index',
            'icon' => 'feather-users',
            'group' => 'User',
            'order' => 16,
            'parent_id' => null,
        ]);

        $user = MenuAdmin::create([
            'title' => 'User',
            'route_name' => 'users.index',
            'icon' => 'feather-user',
            'group' => 'User',
            'order' => 17,
            'parent_id' => null,
        ]);

        $shop = MenuAdmin::create([
            'title' => 'Shops',
            'route_name' => 'shops.index',
            'icon' => 'feather-pocket',
            'group' => 'User',
            'order' => 18,
            'parent_id' => null,
        ]);

        $slider = MenuAdmin::create([
            'title' => 'Slider',
            'route_name' => 'sliders.index',
            'icon' => 'feather-sliders',
            'group' => 'Web',
            'order' => 19,
            'parent_id' => null,
        ]);

        $profileWeb = MenuAdmin::create([
            'title' => 'Profile Web',
            'route_name' => 'options.index',
            'icon' => 'feather-settings',
            'group' => 'Web',
            'order' => 20,
            'parent_id' => null,
        ]);
        $about = MenuAdmin::create([
            'title' => 'About',
            'route_name' => 'abouts.index',
            'icon' => 'feather-globe',
            'group' => 'Web',
            'order' => 21,
            'parent_id' => null,
        ]);
        $about = MenuAdmin::create([
            'title' => 'Web Menu',
            'route_name' => 'menus.index',
            'icon' => 'feather-grid',
            'group' => 'Web',
            'order' => 22,
            'parent_id' => null,
        ]);



        // Assign permissions: contoh, semua menu hanya admin yang bisa akses
        $adminRole = Role::where('name', 'superadmin')->first();

        if ($adminRole) {
            $menus = MenuAdmin::all();
            foreach ($menus as $menu) {
                $menu->roles()->syncWithoutDetaching([$adminRole->id]);
            }
        }
    }
}
