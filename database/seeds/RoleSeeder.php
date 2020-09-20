<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
	private $permissions = [
		'Articles' => [
			'Browse Articles',
			'Read Articles',
			'Edit Articles',
			'Add Articles',
			'Delete Articles',
			'Restore Articles',
			'ForceDelete Articles',
		],

		'Invoices' => [
			'Browse Invoices',
			'Read Invoices',
			'Edit Invoices',
			'Add Invoices',
			'Delete Invoices',
			'Restore Invoices',
			'ForceDelete Invoices',
		],

		'Bills' => [
			'Browse Bills',
			'Read Bills',
			'Edit Bills',
			'Add Bills',
			'Delete Bills',
			'Restore Bills',
			'ForceDelete Bills',
		],

		'Receipts' => [
			'Browse Receipts',
			'Read Receipts',
			'Edit Receipts',
			'Add Receipts',
			'Delete Receipts',
			'Restore Receipts',
			'ForceDelete Receipts',
		],

		'Orders' => [
			'Browse Orders',
			'Read Orders',
			'Edit Orders',
			'Add Orders',
			'Delete Orders',
			'Restore Orders',
			'ForceDelete Orders',
		],

		'Categories' => [
			'Browse Categories',
			'Read Categories',
			'Edit Categories',
			'Add Categories',
			'Delete Categories',
			'Restore Categories',
			'ForceDelete Categories',
		],

		'Clients' => [
			'Browse Clients',
			'Read Clients',
			'Edit Clients',
			'Add Clients',
			'Delete Clients',
			'Restore Clients',
			'ForceDelete Clients',
		],
		'Garage' => [
			'Browse Garages',
			'Read Garages',
			'Edit Garages',
			'Add Garages',
			'Delete Garages',
			'Restore Garages',
			'ForceDelete Garages',

		],

		'Parts' => [
			'Browse Parts',
			'Read Parts',
			'Edit Parts',
			'Add Parts',
			'Delete Parts',
			'Restore Parts',
			'ForceDelete Parts',
		],

		'Types' => [
			'Browse Types',
			'Read Types',
			'Edit Types',
			'Add Types',
			'Delete Types',
			'Restore Types',
			'ForceDelete Types',
		],

		'Suppliers' => [
			'Browse Suppliers',
			'Read Suppliers',
			'Edit Suppliers',
			'Add Suppliers',
			'Delete Suppliers',
			'Restore Suppliers',
			'ForceDelete Suppliers',
		],

		'Profiles' => [
			'Browse Profiles',
			'Read Profiles',
			'Edit Profiles',
			'Add Profiles',
			'Delete Profiles',
			'Restore Profiles',
			'ForceDelete Profiles',
		],

		'Discounts' => [
			'Browse Discounts',
			'Read Discounts',
			'Edit Discounts',
			'Add Discounts',
			'Delete Discounts',
			'Restore Discounts',
			'ForceDelete Discounts',
		],

		'Permissions' => [
			'Browse Permissions',
			'Read Permissions',
			'Edit Permissions',
			'Add Permissions',
			'Delete Permissions',
			'Restore Permissions',
			'ForceDelete Permissions',
		],

		'Roles' => [
			'Browse Roles',
			'Read Roles',
			'Edit Roles',
			'Add Roles',
			'Delete Roles',
			'Restore Roles',
			'ForceDelete Roles',
		],

		'Store-contacts' => [
			'Browse Store-contacts',
			'Read Store-contacts',
			'Edit Store-contacts',
			'Add Store-contacts',
			'Delete Store-contacts',
			'Restore Store-contacts',
			'ForceDelete Store-contacts',
		],

		'Store-abouts' => [
			'Browse Store-abouts',
			'Read Store-abouts',
			'Edit Store-abouts',
			'Add Store-abouts',
			'Delete Store-abouts',
			'Restore Store-abouts',
			'ForceDelete Store-abouts',
		],

	];

	public function run()
	{
		foreach ($this->permissions as $resource => $permissions) {
			foreach ($permissions as $permission) {
				Permission::create(['name' => $permission]);
			}
		}
		$admin = Role::create(['name' => 'Super Admin']);
		$canUpdatePartScore = Permission::create(['name' => 'Update Part Views']);
		$admin->givePermissionTo($canUpdatePartScore);
		$permission = Permission::create(['name' => 'Access Stock']);
		$role = Role::create(['name' => 'Member']);
		$role->givePermissionTo($permission);
	}
}
