<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            ['route_name' => 'brands.index', 'description' => 'List Brand'],
            ['route_name' => 'brands.create', 'description' => 'Create Brand'],
            ['route_name' => 'brands.store', 'description' => 'Store Brand'],
            ['route_name' => 'brands.edit', 'description' => 'Edit Brand'],
            ['route_name' => 'brands.update', 'description' => 'Update Brand'],
            ['route_name' => 'brands.destroy', 'description' => 'Delete Brand'],

            ['route_name' => 'categories.index', 'description' => 'List Kategori'],
            ['route_name' => 'categories.create', 'description' => 'Create Kategori'],
            ['route_name' => 'categories.store', 'description' => 'Store Kategori'],
            ['route_name' => 'categories.edit', 'description' => 'Edit Kategori'],
            ['route_name' => 'categories.update', 'description' => 'Update Kategori'],
            ['route_name' => 'categories.destroy', 'description' => 'Delete Kategori'],

            ['route_name' => 'customers.index', 'description' => 'List Customer'],
            ['route_name' => 'customers.create', 'description' => 'Create Customer'],
            ['route_name' => 'customers.store', 'description' => 'Store Customer'],
            ['route_name' => 'customers.edit', 'description' => 'Edit Customer'],
            ['route_name' => 'customers.update', 'description' => 'Update Customer'],
            ['route_name' => 'customers.destroy', 'description' => 'Delete Customer'],


            ['route_name' => 'dashboard.index', 'description' => 'Akses dashboard'],

            ['route_name' => 'menu_admins.index', 'description' => 'Kelola menu admin',],
            ['route_name' => 'menu_admins.create', 'description' => 'Kelola menu admin',],
            ['route_name' => 'menu_admins.edit', 'description' => 'Kelola menu admin',],
            ['route_name' => 'menu_admins.store', 'description' => 'Tambah menu admin',],
            ['route_name' => 'menu_admins.update', 'description' => 'Update menu admin',],
            ['route_name' => 'menu_admins.destroy', 'description' => 'Hapus menu admin',],

            ['route_name' => 'menus.index', 'description' => 'Kelola menu Frontend',],
            ['route_name' => 'menus.create', 'description' => 'Tambah menu Frontend',],
            ['route_name' => 'menus.show', 'description' => 'Detail menu Frontend',],
            ['route_name' => 'menus.edit', 'description' => 'Edit menu Frontend',],
            ['route_name' => 'menus.store', 'description' => 'Simpan menu Frontend',],
            ['route_name' => 'menus.update', 'description' => 'Update menu Frontend',],
            ['route_name' => 'menus.destroy', 'description' => 'Hapus menu Frontend',],
            ['route_name' => 'menus.addTranslate', 'description' => 'Add Translate menu Frontend',],
            ['route_name' => 'menus.editTranslate', 'description' => 'Edit Translate menu Frontend',],
            ['route_name' => 'menus.updateTranslate', 'description' => 'Update Translate menu Frontend',],


            ['route_name' => 'messages.index', 'description' => 'List Message',],
            ['route_name' => 'messages.create', 'description' => 'Create Message',],
            ['route_name' => 'messages.store', 'description' => 'Store Message',],
            ['route_name' => 'messages.edit', 'description' => 'Edit Message',],
            ['route_name' => 'messages.update', 'description' => 'Update Message',],
            ['route_name' => 'messages.destroy', 'description' => 'Delete Message',],

            ['route_name' => 'options.index', 'description' => 'List Options'],
            ['route_name' => 'options.edit', 'description' => 'Edit Options'],
            ['route_name' => 'options.update', 'description' => 'Update Options'],

            ['route_name' => 'orders.index', 'description' => 'List Pesanan',],
            ['route_name' => 'orders.show', 'description' => 'Show Pesanan'],
            ['route_name' => 'orders.create', 'description' => 'Create Pesanan'],
            ['route_name' => 'orders.store', 'description' => 'Store Pesanan'],
            ['route_name' => 'orders.edit', 'description' => 'Edit Pesanan'],
            ['route_name' => 'orders.update', 'description' => 'Update Pesanan'],
            ['route_name' => 'orders.destroy', 'description' => 'Delete Pesanan'],
            ['route_name' => 'orders.print', 'description' => 'Print Pesanan'],
            ['route_name' => 'orders.export', 'description' => 'Export Pesanan'],
            ['route_name' => 'orders.markPaid', 'description' => 'Update status bayar Pesanan'],

            ['route_name' => 'permissions.index', 'description' => 'List Permission',],
            ['route_name' => 'permissions.create', 'description' => 'Create Permission',],
            ['route_name' => 'permissions.store', 'description' => 'Store Permission',],
            ['route_name' => 'permissions.edit', 'description' => 'Edit Permission',],
            ['route_name' => 'permissions.update', 'description' => 'Update Permission',],
            ['route_name' => 'permissions.destroy', 'description' => 'Delete Permission',],

            ['route_name' => 'roles.permissions.index', 'description' => 'Akses Update Permission'],
            ['route_name' => 'roles.permissions.update', 'description' => 'Akses Update Permission'],
            ['route_name' => 'roles.permissions.edit', 'description' => 'Akses Permission'],
            ['route_name' => 'role_permissions.index', 'description' => 'Lihat role permissions'],
            ['route_name' => 'role_permissions.store', 'description' => 'Buat role permission'],
            ['route_name' => 'role_permissions.update', 'description' => 'Update role permission'],
            ['route_name' => 'role_permissions.destroy', 'description' => 'Hapus role permission'],
            ['route_name' => 'roles.menus.edit', 'description' => 'Edit menu Role',],
            ['route_name' => 'roles.menus.update', 'description' => 'Update menu Role',],

            ['route_name' => 'shop_users.index', 'description' => 'List User Toko',],
            ['route_name' => 'shop_users.create', 'description' => 'Create User Toko',],
            ['route_name' => 'shop_users.store', 'description' => 'Store User Toko',],
            ['route_name' => 'shop_users.edit', 'description' => 'Edit User Toko',],
            ['route_name' => 'shop_users.update', 'description' => 'Update User Toko',],
            ['route_name' => 'shop_users.destroy', 'description' => 'Delete User Toko',],

            ['route_name' => 'posts.index', 'description' => 'List Post',],
            ['route_name' => 'posts.create', 'description' => 'Create Post',],
            ['route_name' => 'posts.store', 'description' => 'Store Post',],
            ['route_name' => 'posts.edit', 'description' => 'Edit Post',],
            ['route_name' => 'posts.update', 'description' => 'Update Post',],
            ['route_name' => 'posts.destroy', 'description' => 'Delete Post',],

            ['route_name' => 'products.index', 'description' => 'List Produk'],
            ['route_name' => 'products.create', 'description' => 'Create Produk'],
            ['route_name' => 'products.store', 'description' => 'Store Produk'],
            ['route_name' => 'products.show', 'description' => 'Detail Produk'],
            ['route_name' => 'products.edit', 'description' => 'Edit Produk'],
            ['route_name' => 'products.update', 'description' => 'Update Produk'],
            ['route_name' => 'products.destroy', 'description' => 'Delete Produk'],
            ['route_name' => 'products.parts', 'description' => 'Kelola Part Produk'],
            ['route_name' => 'products.parts.store', 'description' => 'Store Part Produk'],
            ['route_name' => 'products.parts.update', 'description' => 'Update Part Produk'],
            ['route_name' => 'products.addParts', 'description' => 'Tambah Part Produk'],
            ['route_name' => 'products.addTranslate', 'description' => 'Tambah Translate Produk'],
            ['route_name' => 'products.editTranslate', 'description' => 'Edit Translate Produk'],
            ['route_name' => 'products.updateTranslate', 'description' => 'Update Translate Produk'],
            ['route_name' => 'products.destroyTranslate', 'description' => 'Hapus Translate Produk'],

            ['route_name' => 'productions.index', 'description' => 'Index Production'],
            ['route_name' => 'productions.create', 'description' => 'Create Production'],
            ['route_name' => 'productions.store', 'description' => 'Store Production'],
            ['route_name' => 'productions.edit', 'description' => 'Edit Production'],
            ['route_name' => 'productions.update', 'description' => 'Update Production'],
            ['route_name' => 'productions.destroy', 'description' => 'Delete Production'],

            ['route_name' => 'provinces.index', 'description' => 'Province List'],
            ['route_name' => 'provinces.store', 'description' => 'Create Province'],
            ['route_name' => 'provinces.show', 'description' => 'Create City'],
            ['route_name' => 'provinces.update', 'description' => 'Update Province'],
            ['route_name' => 'provinces.destroy', 'description' => 'Delete Province'],
            ['route_name' => 'provinces.cities.store', 'description' => 'Create Kota'],
            ['route_name' => 'provinces.cities.update', 'description' => 'Update Kota'],
            ['route_name' => 'provinces.cities.destroy', 'description' => 'Delete Kota'],
            ['route_name' => 'provinces.cities.getCities', 'description' => 'Get Kota'],

            ['route_name' => 'roles.index', 'description' => 'Lihat daftar role'],
            ['route_name' => 'roles.store', 'description' => 'Buat role baru'],
            ['route_name' => 'roles.update', 'description' => 'Update role'],
            ['route_name' => 'roles.destroy', 'description' => 'Hapus role'],

            ['route_name' => 'shops.index', 'description' => 'List Toko',],
            ['route_name' => 'shops.create', 'description' => 'Create Toko',],
            ['route_name' => 'shops.store', 'description' => 'Store Toko',],
            ['route_name' => 'shops.edit', 'description' => 'Edit Toko',],
            ['route_name' => 'shops.update', 'description' => 'Update Toko',],
            ['route_name' => 'shops.destroy', 'description' => 'Delete Toko',],

            ['route_name' => 'sliders.index', 'description' => 'List Slider'],
            ['route_name' => 'sliders.create', 'description' => 'Create Slider'],
            ['route_name' => 'sliders.store', 'description' => 'Store Slider'],
            ['route_name' => 'sliders.edit', 'description' => 'Edit Slider'],
            ['route_name' => 'sliders.update', 'description' => 'Update Slider'],
            ['route_name' => 'sliders.destroy', 'description' => 'Delete Slider'],

            ['route_name' => 'users.index', 'description' => 'List User'],
            ['route_name' => 'users.create', 'description' => 'Create User'],
            ['route_name' => 'users.store', 'description' => 'Store User'],
            ['route_name' => 'users.edit', 'description' => 'Edit User'],
            ['route_name' => 'users.update', 'description' => 'Update User'],
            ['route_name' => 'users.destroy', 'description' => 'Delete User'],

            ['route_name' => 'vehicles.index', 'description' => 'List Kendaraan'],
            ['route_name' => 'vehicles.show', 'description' => 'List Kendaraan'],
            ['route_name' => 'vehicles.create', 'description' => 'Create Kendaraan'],
            ['route_name' => 'vehicles.store', 'description' => 'Store Kendaraan'],
            ['route_name' => 'vehicles.edit', 'description' => 'Edit Kendaraan'],
            ['route_name' => 'vehicles.update', 'description' => 'Update Kendaraan'],
            ['route_name' => 'vehicles.destroy', 'description' => 'Delete Kendaraan'],

            ['route_name' => 'stocks.index', 'description' => 'List Stock'],
            ['route_name' => 'stocks.show', 'description' => 'lihat Stock'],
            ['route_name' => 'stocks.create', 'description' => 'Buat Stock Log'],
            ['route_name' => 'stocks.index_shop', 'description' => 'lihat Stock untuk User'],
            ['route_name' => 'stocks.add_stock', 'description' => 'Add Stock untuk User'],
            ['route_name' => 'stocks.store_stock', 'description' => 'Store Stock untuk User'],
            ['route_name' => 'stock.check', 'description' => 'Cek Stok sebelum order'],

            ['route_name' => 'abouts.index', 'description' => 'lihat About'],
            ['route_name' => 'abouts.update', 'description' => 'Update About'],
            ['route_name' => 'abouts.addTranslate', 'description' => 'Translate About'],
            ['route_name' => 'abouts.editTranslate', 'description' => 'edit Translate About'],
            ['route_name' => 'abouts.updateTranslate', 'description' => 'Update Translate About'],

            ['route_name' => 'product-brands.index', 'description' => 'list product brand'],
            ['route_name' => 'product-brands.create', 'description' => 'Detail product brand'],
            ['route_name' => 'product-brands.show', 'description' => 'Detail product brand'],
            ['route_name' => 'product-brands.store', 'description' => 'Store product brand'],
            ['route_name' => 'product-brands.edit', 'description' => 'Edit product brand'],
            ['route_name' => 'product-brands.update', 'description' => 'Update product brand'],
            ['route_name' => 'product-brands.destroy', 'description' => 'Hapus product brand'],

            ['route_name' => 'warranties.index', 'description' => 'list product Garansi'],
            ['route_name' => 'warranties.create', 'description' => 'Detail product Garansi'],
            ['route_name' => 'warranties.show', 'description' => 'Detail product Garansi'],
            ['route_name' => 'warranties.store', 'description' => 'Store product Garansi'],
            ['route_name' => 'warranties.edit', 'description' => 'Edit product Garansi'],
            ['route_name' => 'warranties.update', 'description' => 'Update product Garansi'],
            ['route_name' => 'warranties.destroy', 'description' => 'Hapus product Garansi'],
            ['route_name' => 'warranties.claim', 'description' => 'Klaim product Garansi'],

            ['route_name' => 'reports.stock', 'description' => 'List Laporan Stok'],
            ['route_name' => 'reports.order', 'description' => 'List Laporan Penjualan'],
            ['route_name' => 'reports.order.items', 'description' => 'detail Laporan Penjualan'],
            ['route_name' => 'reports.orders.export.excel', 'description' => 'Export Excel'],
            ['route_name' => 'reports.orders.export.pdf', 'description' => 'Export Pdf'],
            ['route_name' => 'reports.orders.export.word', 'description' => 'Export Word'],

        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'route_name' => $permission['route_name'],
                'description' => $permission['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
