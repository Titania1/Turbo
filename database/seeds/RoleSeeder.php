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
			'Force Delete Articles',
		],

		'Invoices' => [
			'Browse Invoices',
			'Read Invoices',
			'Edit Invoices',
			'Add Invoices',
			'Delete Invoices',
			'Restore Invoices',
			'Force Delete Invoices',
		],

		'Bills' => [
			'Browse Bills',
			'Read Bills',
			'Edit Bills',
			'Add Bills',
			'Delete Bills',
			'Restore Bills',
			'Force Delete Bills',
		],

		'Receipts' => [
			'Browse Receipts',
			'Read Receipts',
			'Edit Receipts',
			'Add Receipts',
			'Delete Receipts',
			'Restore Receipts',
			'Force Delete Receipts',
		],

		'Orders' => [
			'Browse Orders',
			'Read Orders',
			'Edit Orders',
			'Add Orders',
			'Delete Orders',
			'Restore Orders',
			'Force Delete Orders',
		],

		'Categories' => [
			'Browse Categories',
			'Read Categories',
			'Edit Categories',
			'Add Categories',
			'Delete Categories',
			'Restore Categories',
			'Force Delete Categories',
		],

		'Clients' => [
			'Browse Clients',
			'Read Clients',
			'Edit Clients',
			'Add Clients',
			'Delete Clients',
			'Restore Clients',
			'Force Delete Clients',
		],
		'Garage' => [
			'Browse Garages',
			'Read Garages',
			'Edit Garages',
			'Add Garages',
			'Delete Garages',
			'Restore Garages',
			'Force Delete Garages',

		],

		'Parts' => [
			'Browse Parts',
			'Read Parts',
			'Edit Parts',
			'Add Parts',
			'Delete Parts',
			'Restore Parts',
			'Force Delete Parts',
		],

		'Types' => [
			'Browse Types',
			'Read Types',
			'Edit Types',
			'Add Types',
			'Delete Types',
			'Restore Types',
			'Force Delete Types',
		],

		'Suppliers' => [
			'Browse Suppliers',
			'Read Suppliers',
			'Edit Suppliers',
			'Add Suppliers',
			'Delete Suppliers',
			'Restore Suppliers',
			'Force Delete Suppliers',
		],

		'Profiles' => [
			'Browse Profiles',
			'Read Profiles',
			'Edit Profiles',
			'Add Profiles',
			'Delete Profiles',
			'Restore Profiles',
			'Force Delete Profiles',
		],

		'Discounts' => [
			'Browse Discounts',
			'Read Discounts',
			'Edit Discounts',
			'Add Discounts',
			'Delete Discounts',
			'Restore Discounts',
			'Force Delete Discounts',
		],

		'Permissions' => [
			'Browse Permissions',
			'Read Permissions',
			'Edit Permissions',
			'Add Permissions',
			'Delete Permissions',
			'Restore Permissions',
			'Force Delete Permissions',
		],

		'Roles' => [
			'Browse Roles',
			'Read Roles',
			'Edit Roles',
			'Add Roles',
			'Delete Roles',
			'Restore Roles',
			'Force Delete Roles',
		],

		'Store-contacts' => [
			'Browse Store-contacts',
			'Read Store-contacts',
			'Edit Store-contacts',
			'Add Store-contacts',
			'Delete Store-contacts',
			'Restore Store-contacts',
			'Force Delete Store-contacts',
		],

		'Store-abouts' => [
			'Browse Store-abouts',
			'Read Store-abouts',
			'Edit Store-abouts',
			'Add Store-abouts',
			'Delete Store-abouts',
			'Restore Store-abouts',
			'Force Delete Store-abouts',
		],

	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
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
