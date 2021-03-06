<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;



class AuthController extends Controller
{

 public function login(Request $request)
 {
  $credentials = request(['email', 'password']);
            if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }

            // return $this->respondWithToken($token);
            return response()->json(['data'=>auth()->user()]);
        }

 /**
 * Get the authenticated User
 *
 * @return \Illuminate\Http\JsonResponse
 */
 public function me()
 {
  return response()->json($this->guard()->user());
 }

 /**
 * Log the user out (Invalidate the token)
 *
 * @return \Illuminate\Http\JsonResponse
 */
 public function logout()
 {
  $this->guard()->logout();

  return response()->json(['message' => 'Successfully logged out']);
 }

 /**
 * Refresh a token.
 *
 * @return \Illuminate\Http\JsonResponse
 */
 public function refresh()
 {
  return $this->respondWithToken($this->guard('api')->refresh());
 }

 /**
 * Get the token array structure.
 *
 * @param string $token
 *
 * @return \Illuminate\Http\JsonResponse
 */
 protected function respondWithToken($token)
 {
  return response()->json([
  'access_token' => $token,
  'token_type' => 'bearer',
  'expires_in' => $this->guard('api')->factory()->getTTL() * 60
  ]);
 }

 /**
 * Get the guard to be used during authentication.
 *
 * @return \Illuminate\Contracts\Auth\Guard
 */
 public function guard()
 {
  return Auth::guard('api');
 }
}

?>