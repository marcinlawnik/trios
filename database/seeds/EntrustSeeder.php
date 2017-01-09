<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 30.12.2016
 * Time: 00:16
 */
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user_admin = User::create([
            'name' => 'admin',
            'email' => 'something@something.com',
            'password' => bcrypt('qwerty'),
        ]);

        $user_mod = User::create([
            'name' => 'moderator_przemek',
            'email' => 'something22@xddd.com',
            'password' => bcrypt('qwerty'),
        ]);

        //create a role of admin
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Have all permission',
        ]);
        //create a role of mode

        $mod = Role::create(array(
            'name' => 'mod',
            'display_name' => 'Moderator',
            'description' => 'Mange trios',
        ));
        //trio permission
        $create_trio = \App\Permission::create(array(
            'name' => 'trio.create',
            'display_name' => 'Trio create',
            'description' => 'Create Trio'
        ));

        $update_trio = \App\Permission::create(array(
            'name' => 'trio.edit',
            'display_name' => 'Trio edit',
            'descreption' => 'Edit exisiting trio'
        ));

        $delete_trop = \App\Permission::create(array(
            'name' => 'trio.delete',
            'display_name' => 'Trio remove',
            'descreption' => 'Delete exisiting trio'
        ));

        $view_trio = \App\Permission::create(array(
            'name' => 'trio.view',
            'display_name' => 'Trios view',
            'descreption' => 'View all trios'
        ));

        //user management permission
        $create_user = \App\Permission::create(array(
            'name' => 'user.create',
            'display_name' => 'User create',
            'description' => 'Create user'
        ));

        $update_user = \App\Permission::create(array(
            'name' => 'user.edit',
            'display_name' => 'User edit',
            'descreption' => 'Edit exisiting user'
        ));

        $delete_user = \App\Permission::create(array(
            'name' => 'user.delete',
            'display_name' => 'Delete user',
            'descreption' => 'Delete user'
        ));

        $view_user = \App\Permission::create(array(
            'name' => 'user.view',
            'display_name' => 'Users view',
            'descreption' => 'View all users'
        ));
        

        $admin->attachPermission(array($view_trio, $create_trio, $delete_trop, $update_trio, $create_user, $delete_user, $update_user, $view_user));
        $mod->attachPermission(array($view_trio, $create_trio, $delete_trop, $update_trio));

        $user_admin->attachRole($admin);
        $user_mod->attachRole($mod);
    }
}