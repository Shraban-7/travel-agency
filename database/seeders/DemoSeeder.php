<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\ApplicationStatusLog;
use App\Models\Client;
use App\Models\JobDemand;
use App\Models\Lead;
use App\Models\Package;
use App\Models\PackageDeparture;
use App\Models\Payment;
use App\Models\StudyIntake;
use App\Models\StudyProgram;
use App\Models\University;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // 8 packages, each with 2 departures
        $packages = Package::factory(8)->create();

        foreach ($packages as $index => $package) {
            for ($i = 1; $i <= 2; $i++) {
                $departureDate = now()->addDays(($index * 2 + $i) * 15 + fake()->numberBetween(5, 20));
                $durationDays = (int) ($package->duration_days ?: 7);

                PackageDeparture::create([
                    'package_id' => $package->id,
                    'departure_date' => $departureDate->toDateString(),
                    'return_date' => $departureDate->copy()->addDays($durationDays)->toDateString(),
                    'seats_total' => 40,
                    'seats_booked' => fake()->numberBetween(0, 30),
                    'status' => 'open',
                ]);
            }
        }

        // 10 job demands
        JobDemand::factory(10)->create();

        // 4 universities, each with 2 programs, each program with 1 intake
        $universities = University::factory(4)->create();

        foreach ($universities as $university) {
            $programs = StudyProgram::factory(2)->create([
                'university_id' => $university->id,
            ]);

            foreach ($programs as $program) {
                $startDate = now()->addMonths(fake()->numberBetween(2, 10));

                StudyIntake::create([
                    'program_id' => $program->id,
                    'intake_name' => $startDate->format('M Y'),
                    'start_date' => $startDate->toDateString(),
                    'application_deadline' => $startDate->copy()->subMonth()->toDateString(),
                ]);
            }
        }

        // 20 leads
        Lead::factory(20)->create();

        // 8 clients, each with 1 application + 1 status log + 1 (partial) payment
        $clients = Client::factory(8)->create();

        foreach ($clients as $i => $client) {
            $n = $i + 1;

            $application = Application::factory()->create([
                'client_id' => $client->id,
                'tracking_code' => 'TA-2026-' . str_pad((string) $n, 6, '0', STR_PAD_LEFT),
            ]);

            ApplicationStatusLog::create([
                'application_id' => $application->id,
                'from_status' => null,
                'to_status' => 'submitted',
                'note' => 'Application submitted.',
                'public_visible' => true,
            ]);

            $partialAmount = (int) round(((float) $application->total_fee) / 2);

            Payment::create([
                'application_id' => $application->id,
                'client_id' => $client->id,
                'amount' => $partialAmount,
                'currency' => 'BDT',
                'method' => 'cash',
                'type' => 'installment',
                'receipt_no' => 'R-' . str_pad((string) $n, 6, '0', STR_PAD_LEFT),
                'paid_at' => now(),
            ]);

            $application->update([
                'paid_amount' => $partialAmount,
                'due_amount' => (float) $application->total_fee - $partialAmount,
            ]);
        }
    }
}
