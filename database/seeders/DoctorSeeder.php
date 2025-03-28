<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    public function run()
    {
   

$doctors = [
    [
        'fullname' => 'Dr. Rajesh Sharma',
        'email' => 'rajesh.sharma@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543210',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-1.svg',
        'gender' => 'Male',
        'dob' => '1980-05-15',
        'address' => 'New Delhi, India',
        'speciality' => 'General physician',
        'education' => 'MBBS, MD (General Medicine)',
        'experience' => 10,
        'fees' => 1000.00,
        'about' => 'Experienced general physician providing primary healthcare services.',
    ],
    [
        'fullname' => 'Dr. Priya Mehta',
        'email' => 'priya.mehta@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543211',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-2.svg',
        'gender' => 'Female',
        'dob' => '1985-08-22',
        'address' => 'Mumbai, India',
        'speciality' => 'Gynecologist',
        'education' => 'MBBS, MS (Gynecology)',
        'experience' => 12,
        'fees' => 1500.00,
        'about' => 'Specialist in women’s reproductive health and maternity care.',
    ],
    [
        'fullname' => 'Dr. Anil Kapoor',
        'email' => 'anil.kapoor@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543212',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-3.svg',
        'gender' => 'Male',
        'dob' => '1979-12-10',
        'address' => 'Bangalore, India',
        'speciality' => 'Dermatologist',
        'education' => 'MBBS, MD (Dermatology)',
        'experience' => 7,
        'fees' => 1200.00,
        'about' => 'Expert in treating skin diseases, hair loss, and cosmetic procedures.',
    ],
    [
        'fullname' => 'Dr. Sneha Desai',
        'email' => 'sneha.desai@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543214',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-4.svg',
        'gender' => 'Female',
        'dob' => '1988-09-05',
        'address' => 'Chennai, India',
        'speciality' => 'Pediatricians',
        'education' => 'MBBS, MD (Pediatrics)',
        'experience' => 9,
        'fees' => 1100.00,
        'about' => 'Caring pediatrician specializing in child healthcare and vaccinations.',
    ],
    [
        'fullname' => 'Dr. Ramesh Verma',
        'email' => 'ramesh.verma@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543213',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-5.svg',
        'gender' => 'Male',
        'dob' => '1975-07-18',
        'address' => 'Hyderabad, India',
        'speciality' => 'Neurologist',
        'education' => 'MBBS, DM (Neurology)',
        'experience' => 15,
        'fees' => 2000.00,
        'about' => 'Expert in diagnosing and treating brain and nerve disorders.',
    ],
    [
        'fullname' => 'Dr. Vinay Kumar',
        'email' => 'vinay.kumar@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543215',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-6.svg',
        'gender' => 'Male',
        'dob' => '1982-11-30',
        'address' => 'Kolkata, India',
        'speciality' => 'Gastriontrologist',
        'education' => 'MBBS, DM (Gastroenterology)',
        'experience' => 13,
        'fees' => 1800.00,
        'about' => 'Specialist in treating digestive system disorders and liver diseases.',
    ],
    [
        'fullname' => 'Dr. Smita Verma',
        'email' => 'smita.verma@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543201',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-2.svg',
        'gender' => 'Female',
        'dob' => '1982-07-22',
        'address' => 'Mumbai, India',
        'speciality' => 'General physician',
        'education' => 'MBBS, MD (Internal Medicine)',
        'experience' => rand(1, 15),
        'fees' => 1200.00,
        'about' => 'Expert in general medicine and lifestyle disease management.',
    ],

    [
        'fullname' => 'Dr. Rakesh Kumar',
        'email' => 'rakesh.kumar@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543208',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-3.svg',
        'gender' => 'Male',
        'dob' => '1980-01-15',
        'address' => 'Indore, India',
        'speciality' => 'Neurologist',
        'education' => 'MBBS, DM (Neurology)',
        'experience' => rand(1, 15),
        'fees' => 2000.00,
        'about' => 'Specialist in treating neurological disorders and brain diseases.',
    ],

    [
        'fullname' => 'Dr. Kiran Desai',
        'email' => 'kiran.desai@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543205',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-6.svg',
        'gender' => 'Female',
        'dob' => '1981-04-19',
        'address' => 'Hyderabad, India',
        'speciality' => 'Dermatologist',
        'education' => 'MBBS, MD (Cosmetic Dermatology)',
        'experience' => rand(1, 15),
        'fees' => 1400.00,
        'about' => 'Specialized in skin care and cosmetic procedures.',
    ],

    [
        'fullname' => 'Dr. Arjun Khanna',
        'email' => 'arjun.khanna@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543217',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-8.svg',
        'gender' => 'Male',
        'dob' => '1984-06-25',
                'address' => 'Jaipur, India',
        'speciality' => 'Pediatricians',
        'education' => 'MBBS, MD (Pediatrics)',
        'experience' => rand(1, 15),
        'fees' => 1700.00,
        'about' => 'Caring pediatrician specializing in child healthcare and vaccinations.',
    ],
    [
        'fullname' => 'Dr. Arjun Malhotra',
        'email' => 'arjun.malhotra@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543210',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-7.svg',
        'gender' => 'Male',
        'dob' => '1985-03-12',
        'address' => 'Pune, India',
        'speciality' => 'Neurologist',
        'education' => 'MBBS, DM (Neurology)',
        'experience' => rand(1, 15),
        'fees' => 2100.00,
        'about' => 'Expert in brain and nervous system disorders with over 10 years of experience.',
    ],

    [
        'fullname' => 'Dr. Kunal Bansal',
        'email' => 'kunal.bansal@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543211',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-8.svg',
        'gender' => 'Male',
        'dob' => '1978-06-25',
        'address' => 'Jaipur, India',
        'speciality' => 'Gastriontrologist',
        'education' => 'MBBS, DM (Gastroenterology)',
        'experience' => rand(1, 15),
        'fees' => 1750.00,
        'about' => 'Senior specialist in digestive system diseases and liver disorders.',
    ],

    [
        'fullname' => 'Dr. Neha Choudhary',
        'email' => 'neha.choudhary@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543212',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-9.svg',
        'gender' => 'Female',
        'dob' => '1990-11-05',
        'address' => 'Chandigarh, India',
        'speciality' => 'Pediatricians',
        'education' => 'MBBS, MD (Pediatrics)',
        'experience' => rand(1, 15),
        'fees' => 1250.00,
        'about' => 'Specialist in child healthcare and vaccinations with a friendly approach.',
    ],

    [
        'fullname' => 'Dr. Aditi Sharma',
        'email' => 'aditi.sharma@example.com',
        'password' => Hash::make('password123'),
        'phone' => '9876543213',
        'role' => 'doctor',
        'profile_image' => 'assets/img/gen-p-10.svg',
        'gender' => 'Female',
        'dob' => '1986-02-18',
        'address' => 'Ahmedabad, India',
        'speciality' => 'Gynecologist',
        'education' => 'MBBS, MS (Gynecology)',
        'experience' => rand(1, 15),
        'fees' => 1550.00,
        'about' => 'Women’s health expert specializing in maternity and reproductive health.',
    ],

            
            
];


        

        // Insert Data into Users & Doctors Tables
        // foreach ($doctors as $doc) {
        //     $user = User::create([
        //         'fullname' => $doc['fullname'],
        //         'email' => $doc['email'],
        //         'password' => $doc['password'],
        //         'phone' => $doc['phone'],
        //         'role' => $doc['role'],
        //         'profile_image' => $doc['profile_image'],
        //         'gender' => $doc['gender'],
        //         'dob' => $doc['dob'],
        //         'address' => $doc['address'],
        //     ]);

        //     Doctor::create([
        //         'user_id' => $user->id,
        //         'speciality' => $doc['speciality'],
        //         'education' => $doc['education'],
        //         'experience' => $doc['experience'],
        //         'fees' => $doc['fees'],
        //         'about' => $doc['about'],
        //     ]);
        // }

         
    

    }
}
