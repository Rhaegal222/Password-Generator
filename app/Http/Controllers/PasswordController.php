<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Services\PasswordService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        $generatedPassword = $this->passwordService->generatePassword($length);

        return response()->json(['password' => $generatedPassword]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $password = Password::create([
            'name' => $request->name,
            'password' => $request->password,
        ]);

        return response()->json(['message' => 'Password salvata!', 'data' => $password]);
    }

    public function exportCsv()
    {
        $response = new StreamedResponse(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Name', 'Password']);

            Password::all()->each(function ($password) use ($handle) {
                fputcsv($handle, [$password->name, $password->password]);
            });

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="passwords.csv"');

        return $response;
    }
}
