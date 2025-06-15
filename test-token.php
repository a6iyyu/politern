<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Pengguna;
use Illuminate\Support\Facades\Log;

// Get the user
$user = Pengguna::where('email', 'qisthyayleen@gmail.com')->first();

if (!$user) {
    die("User not found\n");
}

echo "Before update:\n";
echo "Email: " . $user->email . "\n";
echo "Reset Token: " . ($user->reset_token ?? 'null') . "\n";
echo "Token Created At: " . ($user->reset_token_created_at ?? 'null') . "\n\n";

// Generate and save new token
$token = \Illuminate\Support\Str::random(60);
$user->reset_token = $token;
$user->reset_token_created_at = now();
$saved = $user->save();

echo "After update (save status: " . ($saved ? 'success' : 'failed') . "):\n";
echo "Reset Token: " . $user->reset_token . "\n";
echo "Token Created At: " . $user->reset_token_created_at . "\n\n";

// Verify from database
$updatedUser = Pengguna::find($user->id_pengguna);
if ($updatedUser) {
    echo "From database:\n";
    echo "Reset Token: " . $updatedUser->reset_token . "\n";
    echo "Token Created At: " . $updatedUser->reset_token_created_at . "\n";
} else {
    echo "Failed to retrieve updated user from database\n";
}
