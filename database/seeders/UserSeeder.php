<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = User::create([
            'employee_number' => 'EMP001',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'email_verified_at' => now(),
            'job_title' => 'Engineering Manager',
            'department' => 'Engineering',
            'employment_type' => 'full_time',
            'hire_date' => '2020-01-15',
            'is_active' => true,
            'salary' => 120000.00,
            'salary_currency' => 'USD',
            'date_of_birth' => '1985-03-20',
            'gender' => 'male',
            'phone_number' => '+1-555-0100',
            'emergency_contact_name' => 'Jane Doe',
            'emergency_contact_phone' => '+1-555-0101',
            'address_line_1' => '123 Main Street',
            'address_line_2' => 'Apt 4B',
            'city' => 'San Francisco',
            'state' => 'CA',
            'postal_code' => '94102',
            'country' => 'USA',
            'password' => Hash::make('password'),
            'manager_id' => null,
        ]);

        User::create([
            'employee_number' => 'EMP002',
            'first_name' => 'Sarah',
            'last_name' => 'Smith',
            'email' => 'sarah.smith@example.com',
            'email_verified_at' => now(),
            'job_title' => 'Senior Software Engineer',
            'department' => 'Engineering',
            'employment_type' => 'full_time',
            'hire_date' => '2021-06-01',
            'is_active' => true,
            'salary' => 95000.00,
            'salary_currency' => 'USD',
            'date_of_birth' => '1990-07-15',
            'gender' => 'female',
            'phone_number' => '+1-555-0200',
            'emergency_contact_name' => 'Michael Smith',
            'emergency_contact_phone' => '+1-555-0201',
            'address_line_1' => '456 Oak Avenue',
            'city' => 'San Francisco',
            'state' => 'CA',
            'postal_code' => '94103',
            'country' => 'USA',
            'password' => Hash::make('password'),
            'manager_id' => $manager->id,
        ]);
    }
}
