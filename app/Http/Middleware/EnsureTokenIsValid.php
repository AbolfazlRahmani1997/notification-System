<?php

namespace App\Http\Middleware;

use App\Services\Interfaces\JwtServiceInterface;
use Closure;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{

    public function __construct(private JwtServiceInterface $service)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header("authorization");
        $token = $this->tokenSeparator($token);
        $result = $this->service->validationRelated($token);
        if (!$result) {
            throw new HttpClientException('Your token is invalid ', 403);
        }
        return $next($request);
    }

    private function tokenSeparator(string $token): string
    {
        return str_replace("Bearer ", '', $token);
    }
}
