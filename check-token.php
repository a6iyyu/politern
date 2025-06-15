<?php

use App\Models\Pengguna;
use Illuminate\Contracts\Console\Kernel;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$user = Pengguna::where('email', 'qisthyayleen@gmail.com')->first();
if (!$user) die("User not found\n");

echo "Current token information:\n";
echo "Email: {$user->email}\n";
echo "Reset Token: " . ($user->reset_token ?? 'null') . "\n";
echo "Token Created At: " . ($user->reset_token_created_at ?? 'null') . "\n";