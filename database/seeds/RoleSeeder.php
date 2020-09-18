<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
	private permissions =[

		'Articles' => [
			'Browse Articles',
			 'Read Articles', 
			 'Edit Articles' , 
			 'Add Articles' , 
			 'Delete Articles'
		]
 		
 		'Invoices' => [
			'Browse Invoices',
			 'Read Invoices', 
			 'Edit Invoices' , 
			 'Add Invoices' , 
			 'Delete Invoices'
		]

		'Bills' => [
			'Browse Bills',
			 'Read Bills', 
			 'Edit Bills' , 
			 'Add Bills' , 
			 'Delete Bills'
		]



		'Receipts' => [
			'Browse Receipts',
			 'Read Receipts', 
			 'Edit Receipts' , 
			 'Add Receipts' , 
			 'Delete Receipts'
		]

		'Orders' => [
			'Browse Orders',
			 'Read Orders', 
			 'Edit Orders' , 
			 'Add Orders' , 
			 'Delete Orders'
		]

		'Categories' => [
			'Browse Categories',
			 'Read Categories', 
			 'Edit Categories' , 
			 'Add Categories' , 
			 'Delete Categories'
		]



		'Clients' => [
			'Browse Clients',
			 'Read Clients', 
			 'Edit Clients' , 
			 'Add Clients' , 
			 'Delete Clients'
		]


		'Parts' => [
			'Browse Parts',
			 'Read Parts', 
			 'Edit Parts' , 
			 'Add Parts' , 
			 'Delete Parts'
		]


		'Types' => [
			'Browse Types',
			 'Read Types', 
			 'Edit Types' , 
			 'Add Types' , 
			 'Delete Types'
		]



		'Suppliers' => [
			'Browse Suppliers',
			 'Read Suppliers', 
			 'Edit Suppliers' , 
			 'Add Suppliers' , 
			 'Delete Suppliers'
		]

		'Profiles' => [
			'Browse Profiles',
			 'Read Profiles', 
			 'Edit Profiles' , 
			 'Add Profiles' , 
			 'Delete Profiles'
		]


		'Discounts' => [
			'Browse Discounts',
			 'Read Discounts', 
			 'Edit Discounts' , 
			 'Add Discounts' , 
			 'Delete Discounts'
		]


        'Permissions' => [
			'Browse Permissions',
			 'Read Permissions', 
			 'Edit Permissions' , 
			 'Add Permissions' , 
			 'Delete Permissions'
		]

		'Roles' => [
			'Browse Roles',
			 'Read Roles', 
			 'Edit Roles' , 
			 'Add Roles' , 
			 'Delete Roles'
		]



		'Store-contacts' => [
			'Browse Store-contacts',
			 'Read Store-contacts', 
			 'Edit Store-contacts' , 
			 'Add Store-contacts' , 
			 'Delete Store-contacts'
		]


		'Store-abouts' => [
			'Browse Store-abouts',
			 'Read Store-abouts', 
			 'Edit Store-abouts' , 
			 'Add Store-abouts' , 
			 'Delete Store-abouts'
		]

	]



	public function run()
	{
		foreach ($this->permission as $resource => $permissions) {
			foreach ($permissions as $permission) {
				Permission::create(['name' => $permission]);
			}
		}
	
		$admin = Role::create(['name' => 'Super Admin']);
		$admin = Role::create(['name' => 'Super Admin']);
		
		$canUpdatePartScore = Permission::create(['name' => 'Update Part Views']);
		$admin->givePermissionTo($canUpdatePartScore);
		
		$permission = Permission::create(['name' => 'Access Stock']);
		$role = Role::create(['name' => 'Member']);
		$role->givePermissionTo($permission);

	}

}