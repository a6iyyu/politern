<?php

use App\Models\Pengguna;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Str;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();
$user = Pengguna::where('email', 'qisthyayleen@gmail.com')->first();

if (!$user) die("User not found\n");
echo "Before update:\n";
echo "Email: {$user->email}\n";
echo "Reset Token: " . ($user->reset_token ?? 'null') . "\n";
echo "Token Created At: " . ($user->reset_token_created_at ?? 'null') . "\n\n";

$token = Str::random(60);
$user->reset_token = $token;
$user->reset_token_created_at = now();
$saved = $user->save();

echo "After update (save status: " . ($saved ? 'success' : 'failed') . "):\n";
echo "Reset Token: $user->reset_token\n";
echo "Token Created At: {$user->reset_token_created_at}\n\n";

$updated = Pengguna::find($user->id_pengguna);
if ($updated) {
    echo "From database:\n";
    echo "Reset Token: {$updated->reset_token}\n";
    echo "Token Created At: {$updated->reset_token_created_at}\n";
} else {
    echo "Failed to retrieve updated user from database\n";
}