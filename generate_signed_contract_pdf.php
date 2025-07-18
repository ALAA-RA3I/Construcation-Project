<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

// Bootstrap Laravel
$app = Application::configure(basePath: dirname(__FILE__))
    ->withRouting(
        web: __DIR__ . '/routes/web.php',
        api: __DIR__ . '/routes/api.php',
        commands: __DIR__ . '/routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Hardcoded data for the signed contract
$contractData = [
    'date' => now()->format('Y-m-d'),
    'client' => (object)[
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com',
        'phone' => '+1-555-0123',
        'address' => '123 Main Street, City, State 12345'
    ],
    'propertyUnit' => (object)[
        'unit_number' => 'A-1501',
        'floor' => '15',
        'type' => '2 Bedroom, 2 Bathroom',
        'area' => '1200'
    ],
    'propertyBook' => (object)[
        'space' => '120',
        'price' => 450000,
        'down_payment' => 90000,
        'monthly_payment' => 2500
    ],
    'order' => (object)[
        'note' => 'Signed contract for unit A-1501 at Sunset Towers',
        'contract_number' => 'CON-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT)
    ],
    'secret_code' => 'ABC123',
    // You can add 'company_signature_path' if you want to pass it to the view
];

try {
    // Set DomPDF options for better font and HTML support
    \Barryvdh\DomPDF\Facade\Pdf::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
        'defaultFont' => 'Arial',
    ]);
    // Generate PDF using the Blade view
    $pdf = Pdf::loadView('contracts.pdf', $contractData);
    $pdf->setPaper('A4', 'portrait');
    $filename = 'signed_contract_' . $contractData['order']->contract_number . '_' . date('Y-m-d_H-i-s') . '.pdf';
    $contractsPath = storage_path('app/public/contracts');
    if (!file_exists($contractsPath)) {
        mkdir($contractsPath, 0755, true);
    }
    $filePath = $contractsPath . '/' . $filename;
    $pdf->save($filePath);
    Storage::disk('public')->put('contracts/' . $filename, $pdf->output());
    echo "✅ Signed contract PDF generated successfully!\n";
    echo "📄 File: $filename\n";
    echo "📁 Location: $filePath\n";
    echo "🌐 Public URL: " . url('storage/contracts/' . $filename) . "\n";
    echo "📊 File size: " . number_format(filesize($filePath) / 1024, 2) . " KB\n";
    if (file_exists($filePath) && is_readable($filePath)) {
        echo "✅ File verification: PASSED\n";
    } else {
        echo "❌ File verification: FAILED\n";
    }
} catch (Exception $e) {
    echo "❌ Error generating signed contract PDF: " . $e->getMessage() . "\n";
    echo "📋 Stack trace:\n" . $e->getTraceAsString() . "\n";
}
