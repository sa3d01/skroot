<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\RoleHierarchy;
use App\Http\Enums\UserRole;

class UserSeeder extends Seeder
{
    private $usersIds = array();
    private $numberOfUsers = 10;
    private $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        /* Create roles */
        $this->createRoles();

        /*  insert users   */
        $this->createUsers();
    }

    private function createRoles()
    {
        foreach (UserRole::ROLES as $id => $roleEnum) {
            $roleObject = Role::create(['name' => $roleEnum]);
            RoleHierarchy::create(['role_id' => $roleObject->id, 'hierarchy' => $id]);
        }
    }

    private function createUsers()
    {
        $this->createSuperAdmin();
        $this->createSampleCustomer();
        $this->createSampleSupplier();
        $this->createDummyUsers();
    }

    private function createSuperAdmin()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => "password", // will be bcrypted at User model
            'remember_token' => Str::random(10),
            'menuroles' => 'user,admin'
        ]);
        $user->assignRole(UserRole::of(UserRole::ROLE_SUPER_ADMIN));
        $user->assignRole(UserRole::of(UserRole::ROLE_ADMIN));
        $user->assignRole(UserRole::of(UserRole::ROLE_USER));
    }

    private function createSampleCustomer()
    {
        $user = User::create([
            'name' => 'Customer',
            'email' => 'customer@site.com',
            'email_verified_at' => now(),
            'phone' => '+971524559806',
            'phone_verified_at' => now(),
            'password' => '123456',
        ]);
        $user->assignRole(UserRole::of(UserRole::ROLE_CUSTOMER));
    }

    private function createSampleSupplier()
    {
        $user = User::create([
            'name' => 'Supplier',
            'email' => 'supplier@site.com',
            'email_verified_at' => now(),
            'password' => '123456',
        ]);
        $user->assignRole(UserRole::of(UserRole::ROLE_SUPPLIER));
    }

    private function createDummyUsers()
    {
        for ($i = 0; $i < $this->numberOfUsers; $i++) {
            $user = User::create([
                'name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => '123456',
                'remember_token' => Str::random(10),
                'menuroles' => 'user'
            ]);
            $user->assignRole(UserRole::of(UserRole::ROLE_USER));
            array_push($this->usersIds, $user->id);
        }
    }

}
