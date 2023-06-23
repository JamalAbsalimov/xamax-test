<?php

namespace App\Http\Controllers;

use App\Service\Auth\Jwt;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lcobucci\JWT\Token\InvalidTokenStructure;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse|null
     */
    public function __invoke(Request $request)
    {
        $rawToken = $request->header('Authorization');
        //Вынести потом в middleware
        try {
            Jwt::verifyToken($rawToken);

        } catch (InvalidTokenStructure $exception) {
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage()
            ])->setStatusCode(401);

        }
    }
}
