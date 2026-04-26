<?php

namespace App\Http\Controllers;

use App\DTO\PasswordOptions;
use App\Http\Requests\GeneratePasswordRequest;
use App\Services\PasswordService;
use Illuminate\Http\Response;

class PasswordController extends Controller
{
    public function __construct(private readonly PasswordService $passwordService) {}

    public function generate(GeneratePasswordRequest $request): Response
    {
        $result = $this->passwordService->generate(
            PasswordOptions::fromRequest($request)
        );

        return $result->success
            ? response($result->data, 200)->header('Content-Type', 'text/plain')
            : response($result->error, 422)->header('Content-Type', 'text/plain');
    }
}
