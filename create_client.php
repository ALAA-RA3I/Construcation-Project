<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Client;
use Illuminate\Support\Facades\Hash;

try {
    // Create a new client
    $client = Client::create([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'moayad.harmoush@gmail.com',
        'password' => Hash::make('password123'),
        'phone_number' => '+1234567890',
        // 'national_id' => 123456789012345,
        'api_token' => \Illuminate\Support\Str::random(60),
        'is_active' => true,
    ]);

    echo "Client created successfully!\n";
    echo "ID: " . $client->id . "\n";
    echo "Name: " . $client->first_name . " " . $client->last_name . "\n";
    echo "Email: " . $client->email . "\n";
    echo "Phone: " . $client->phone_number . "\n";
    // echo "National ID: " . $client->national_id . "\n";
    echo "API Token: " . $client->api_token . "\n";
    echo "Is Active: " . ($client->is_active ? 'Yes' : 'No') . "\n";
} catch (Exception $e) {
    echo "Error creating client: " . $e->getMessage() . "\n";
}
