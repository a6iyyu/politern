<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Admin extends Controller
{
    public function index(Request $request)
    {
        try {
            // To be announced...            
        } catch (Exception $exception) {
            Log::error('Terjadi kesalahan: ', ['errors' => $exception->getMessage()]);
        }
    }
}