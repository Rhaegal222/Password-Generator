<?php

namespace App\Http\Controllers;

use App\Services\PasswordService;
use App\Http\Requests\GeneratePasswordRequest;

class PasswordController extends Controller
{
    protected PasswordService $passwordService;

    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    public function generate(GeneratePasswordRequest $request)
    {
        $length = $request->validated()['length'];
        $includeUppercase = $request->validated()['uppercase'] ?? false;
        $includeLowercase = $request->validated()['lowercase'] ?? false;
        $includeNumbers = $request->validated()['numbers'] ?? false;
        $includeSymbols = $request->validated()['symbols'] ?? false;
        $easyToSay = $request->validated()['easyToSay'] ?? false;
        $easyToRead = $request->validated()['easyToRead'] ?? false;

        $password = $this->passwordService->generate($length, $includeUppercase, $includeLowercase, $includeNumbers, $includeSymbols, $easyToSay, $easyToRead);

        return response($password, 200)
            ->header('Content-Type', 'text/plain');
    }
}
