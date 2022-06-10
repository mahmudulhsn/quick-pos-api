<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Api\ApiController;

class AuthController extends ApiController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $input = $request->validated();
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);
        $success["token"] = $user->createToken(env("APP_NAME"))->accessToken;

        return $this->sendResponse(
            $success,
            "User has been registered successfully.",
            201,
        );
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {
            $attempt = Auth::attempt([
                "email" => $request->email,
                "password" => $request->password,
            ]);

            if ($attempt) {
                $data["user"] = Auth::user();
                $data["token"] = $data["user"]->createToken(
                    env("APP_NAME"),
                )->accessToken;

                return $this->sendResponse(
                    $data,
                    "User logged in successfully.",
                    200,
                );
            } else {
                return $this->sendError('Combination doesn\'t matched.', [
                    "error" => ["Unauthorized"],
                ]);
            }
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return $this->sendError($th->getMessage(), [
                "error" => ["Unauthorized"],
            ]);
        }
    }

    /**
     * return current logged in user
     */
    public function me()
    {
        try {
            $data["user"] = auth()->user();
            return $this->sendResponse($data, "User Information.", 200);
        } catch (\Throwable $th) {
            return $this->sendError("Unauthorized.", [
                "error" => ["Unauthorized"],
            ]);
        }
    }

    /**
     * Erases the token from database.
     */
    public function logout()
    {
        try {
            auth()
                ->user()
                ->tokens->each(function ($token) {
                    $token->delete();
                });

            cookie()->queue(cookie()->forget("refresh-token"));
            return $this->sendResponse([], "Logged Out!", 200);
        } catch (\Throwable $th) {
            return $this->sendError("Unauthorized.", [
                "error" => ["Unauthorized"],
            ]);
        }
    }
}
