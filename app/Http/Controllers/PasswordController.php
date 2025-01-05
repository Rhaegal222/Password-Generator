<?php

namespace App\Http\Controllers;

use App\Services\PasswordService;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    protected $passwordService;

    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    public function generate(Request $request)
    {
        $length = $request->input('length', 12);
        $includeSymbols = $request->input('includeSymbols', true);

        $password = $this->passwordService->generate($length, $includeSymbols);

        return response($password, 200)
            ->header('Content-Type', 'text/plain');
    }
}
