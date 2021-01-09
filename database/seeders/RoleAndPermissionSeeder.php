<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Navigation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\{Permission, Role};

class RoleAndPermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $user = User::create([
      'name' => "super admin",
      'email' => 'super-admin@gmail.com',
      'password' => Hash::make('root'),
    ]);
    // Reset cached roles and permissions
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    $userAdmin = User::create([
      'name' => "admin",
      'email' => 'admin@gmail.com',
      'password' => Hash::make('root'),
    ]);
    // this can be done as separate statements
    Role::create(['name' => 'admin']);

    $role = Role::create(['name' => 'super admin']);
    $role->givePermissionTo(Permission::all());
    $user->assignRole("super admin");
    $userAdmin->assignRole("admin");
    $permission = Permission::create(['name' => "Mengolah Permission"]);


    $m = Menu::create(['name' => "Super Admin"]);


    $parent = $m->Navigations()->create([
      "name" => "Mengolah Permission",
      "permission_name" => $permission->name,
    ]);
    $m->Navigations()->create([
      "name" => "Menu",
      "parent_id" => $parent->id,
      "permission_name" => $permission->name,
      "url" => "super-admin/menu",
    ]);
    $m->Navigations()->create([
      "name" => "Navigation",
      "parent_id" => $parent->id,
      "permission_name" => $permission->name,
      "url" => "super-admin/navigation",
    ]);
    $m->Navigations()->create([
      "name" => "Role",
      "parent_id" => $parent->id,
      "permission_name" => $permission->name,
      "url" => "super-admin/role",
    ]);
    $m->Navigations()->create([
      "name" => "Permission",
      "parent_id" => $parent->id,
      "permission_name" => $permission->name,
      "url" => "super-admin/permission",
    ]);
    $m->Navigations()->create([
      "name" => "Role Permission",
      "parent_id" => $parent->id,
      "permission_name" => $permission->name,
      "url" => "super-admin/role-permission",
    ]);
    $m->Navigations()->create([
      "name" => "User Role",
      "parent_id" => $parent->id,
      "permission_name" => $permission->name,
      "url" => "super-admin/role-user",
    ]);
  }
}
