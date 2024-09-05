<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakeDataSeeder extends Seeder
{
    /**
     * Seed the application's database with vital signs data.
     */
    public function run()
    {
        // Define device IDs based on the devices provided
        $deviceIds = [
            1 => 1,  // Device for patient 1
            2 => 3,  // Device for patient 2
            3 => 4,  // Device for patient 3
            4 => 5,  // Device for patient 4
            5 => 6,  // Device for patient 5
            6 => 7,  // Device for patient 6
            7 => 8,  // Device for patient 7
            8 => 9,  // Device for patient 8
            9 => 10, // Device for patient 9
            10 => 11, // Device for patient 10
            11 => 12, // Device for patient 11
            12 => 1,  // Reuse Device ID for patient 12 (Adjust if needed)
        ];

        // Vital signs data for patients
        $vitalSignsData = [
            1 => [
                ['device_id' => $deviceIds[1], 'blood_pressure' => '120/80', 'pulse_rate' => 72, 'timestamp' => now()->subDays(1)],
                ['device_id' => $deviceIds[1], 'blood_pressure' => '122/82', 'pulse_rate' => 74, 'timestamp' => now()->subDays(2)],
                ['device_id' => $deviceIds[1], 'blood_pressure' => '119/77', 'pulse_rate' => 70, 'timestamp' => now()->subDays(3)],
            ],
            2 => [
                ['device_id' => $deviceIds[2], 'blood_pressure' => '118/76', 'pulse_rate' => 68, 'timestamp' => now()->subDays(1)],
                ['device_id' => $deviceIds[2], 'blood_pressure' => '117/75', 'pulse_rate' => 69, 'timestamp' => now()->subDays(2)],
            ],
            3 => [
                ['device_id' => $deviceIds[3], 'blood_pressure' => '124/80', 'pulse_rate' => 74, 'timestamp' => now()->subDays(1)],
                ['device_id' => $deviceIds[3], 'blood_pressure' => '123/82', 'pulse_rate' => 73, 'timestamp' => now()->subDays(2)],
                ['device_id' => $deviceIds[3], 'blood_pressure' => '121/79', 'pulse_rate' => 71, 'timestamp' => now()->subDays(3)],
            ],
            4 => [
                ['device_id' => $deviceIds[4], 'blood_pressure' => '120/78', 'pulse_rate' => 70, 'timestamp' => now()->subDays(1)],
                ['device_id' => $deviceIds[4], 'blood_pressure' => '121/79', 'pulse_rate' => 72, 'timestamp' => now()->subDays(2)],
                ['device_id' => $deviceIds[4], 'blood_pressure' => '119/77', 'pulse_rate' => 69, 'timestamp' => now()->subDays(3)],
            ],
            5 => [
                ['device_id' => $deviceIds[5], 'blood_pressure' => '122/81', 'pulse_rate' => 73, 'timestamp' => now()->subDays(1)],
                ['device_id' => $deviceIds[5], 'blood_pressure' => '121/80', 'pulse_rate' => 72, 'timestamp' => now()->subDays(2)],
                ['device_id' => $deviceIds[5], 'blood_pressure' => '123/82', 'pulse_rate' => 74, 'timestamp' => now()->subDays(3)],
            ],
            6 => [
                ['device_id' => $deviceIds[6], 'blood_pressure' => '119/76', 'pulse_rate' => 71, 'timestamp' => now()->subDays(1)],
                ['device_id' => $deviceIds[6], 'blood_pressure' => '120/77', 'pulse_rate' => 72, 'timestamp' => now()->subDays(2)],
                ['device_id' => $deviceIds[6], 'blood_pressure' => '121/78', 'pulse_rate' => 70, 'timestamp' => now()->subDays(3)],
            ],
            7 => [
                ['device_id' => $deviceIds[7], 'blood_pressure' => '125/82', 'pulse_rate' => 75, 'timestamp' => now()->subDays(1)],
                ['device_id' => $deviceIds[7], 'blood_pressure' => '124/80', 'pulse_rate' => 74, 'timestamp' => now()->subDays(2)],
                ['device_id' => $deviceIds[7], 'blood_pressure' => '123/81', 'pulse_rate' => 76, 'timestamp' => now()->subDays(3)],
            ],
            8 => [
                ['device_id' => $deviceIds[8], 'blood_pressure' => '122/79', 'pulse_rate' => 72, 'timestamp' => now()->subDays(1)],
                ['device_id' => $deviceIds[8], 'blood_pressure' => '121/78', 'pulse_rate' => 71, 'timestamp' => now()->subDays(2)],
                ['device_id' => $deviceIds[8], 'blood_pressure' => '120/77', 'pulse_rate' => 70, 'timestamp' => now()->subDays(3)],
            ],
            9 => [
                ['device_id' => $deviceIds[9], 'blood_pressure' => '118/75', 'pulse_rate' => 69, 'timestamp' => now()->subDays(1)],
                ['device_id' => $deviceIds[9], 'blood_pressure' => '119/76', 'pulse_rate' => 70, 'timestamp' => now()->subDays(2)],
                ['device_id' => $deviceIds[9], 'blood_pressure' => '120/77', 'pulse_rate' => 71, 'timestamp' => now()->subDays(3)],
            ],
            10 => [
                ['device_id' => $deviceIds[10], 'blood_pressure' => '121/80', 'pulse_rate' => 71, 'timestamp' => now()->subDays(1)],
                ['device_id' => $deviceIds[10], 'blood_pressure' => '122/81', 'pulse_rate' => 72, 'timestamp' => now()->subDays(2)],
                ['device_id' => $deviceIds[10], 'blood_pressure' => '123/82', 'pulse_rate' => 73, 'timestamp' => now()->subDays(3)],
            ],
            11 => [
                ['device_id' => $deviceIds[11], 'blood_pressure' => '120/79', 'pulse_rate' => 70, 'timestamp' => now()->subDays(1)],
                ['device_id' => $deviceIds[11], 'blood_pressure' => '121/80', 'pulse_rate' => 71, 'timestamp' => now()->subDays(2)],
                ['device_id' => $deviceIds[11], 'blood_pressure' => '122/81', 'pulse_rate' => 72, 'timestamp' => now()->subDays(3)],
            ],
            12 => [
                ['device_id' => $deviceIds[12], 'blood_pressure' => '119/78', 'pulse_rate' => 71, 'timestamp' => now()->subDays(1)],
                ['device_id' => $deviceIds[12], 'blood_pressure' => '120/79', 'pulse_rate' => 72, 'timestamp' => now()->subDays(2)],
                ['device_id' => $deviceIds[12], 'blood_pressure' => '121/80', 'pulse_rate' => 73, 'timestamp' => now()->subDays(3)],
            ],
        ];

        // Insert vital signs data
        foreach ($vitalSignsData as $patientId => $vitals) {
            foreach ($vitals as $vital) {
                DB::table('vital_signs')->insert(array_merge(['patient_id' => $patientId], $vital));
            }
        }
    }
}
