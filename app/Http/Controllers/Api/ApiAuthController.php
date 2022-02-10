<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $validator = Validator($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|string'
    //     ]);
    //     if (!$validator->fails()) {
    //         $user = User::where('email', $request->email)->first();
    //         if (Hash::check($request->password, $user->password)) {
    //             $this->revokePreviousTokens($user->id);
    //             $token = $user->createToken('user_api');
    //             $user->setAttribute('token', $token->accessToken);
    //             return response()->json(['message' => 'logged is successfully', 'data' => $user], Response::HTTP_OK);
    //         } else {
    //             return response()->json(['message' => 'wrong password'], Response::HTTP_BAD_REQUEST);
    //         }
    //     } else {
    //         return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
    //     }
    // }
    // public function login(Request $request)
    // {
    //     $validator = Validator($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|string'
    //     ]);
    //     if (!$validator->fails()) {
    //         $user = User::where('email', $request->email)->first();
    //         if (Hash::check($request->password, $user->password)) {
    //             if (!$this->checkForActiveTokens($user->id)) {
    //                 // $this->revokePreviousTokens($user->id);
    //                 $token = $user->createToken('user_api');
    //                 $user->setAttribute('token', $token->accessToken);
    //                 return response()->json(['message' => 'logged is successfully', 'data' => $user], Response::HTTP_OK);
    //             } else {
    //                 return response()->json(['message' => 'not multi devices'], Response::HTTP_BAD_REQUEST);
    //             }
    //         } else {
    //             return response()->json(['message' => 'wrong password'], Response::HTTP_BAD_REQUEST);
    //         }
    //     } else {
    //         return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
    //     }
    // }
    // public function login(Request $request)
    // {
    //     $validator = Validator($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|string'
    //     ]);
    //     if (!$validator->fails()) {
    //         $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
    //             'grant_type' => 'password',
    //             'client_id' => '2',
    //             'client_secret' => '94v7agqSKGUDrh7sTr8j3Pq5mBw5naJyhhEprT0V',
    //             'username' => $request->get('email'),
    //             'password' => $request->get('password'),
    //             'scope' => '*'
    //         ]);
    //         // $user = User::where('email', $request->email)->first();
    //         // $user->setAttribute('token', $response->json()['access_token']);
    //         // $user->setAttribute('token_type', $response->json()['token_type']);
    //         // $user->setAttribute('refresh_token', $response->json()['refresh_token']);
    //         return $response->json();
    //         // return response()->json(['message' => 'logged is successfully', 'data' => $user], Response::HTTP_OK);
    //     } else {
    //         return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
    //     }
    // }
    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);
        if (!$validator->fails()) {
            try {
                $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
                    'grant_type' => 'password',
                    'client_id' => '3',
                    'client_secret' => 'DuyNYyC8KBmnqlKBhBNmHfWMiu4qXTDqgoNIL129',
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '*'
                ]);
                $user = User::where('email', $request->email)->first();
                $user->setAttribute('access_token', $response->json()['access_token']);
                $user->setAttribute('token_type', $response->json()['token_type']);
                $user->setAttribute('refresh_token', $response->json()['refresh_token']);
                return response()->json(['message' => 'logged sussessfully', 'data' => $user], Response::HTTP_OK);
            } catch (Exception $e) {
                $message = "";
                if ($response->json()['error'] == 'invalid_grant') {
                    $message = "wrong cred, password or username is faild";
                } else {
                    $message = "login faild";
                }
                return response()->json(['status' => false, 'message' => $message], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    private function revokePreviousTokens($userId)
    {
        DB::table('oauth_access_tokens')->where('user_id', $userId)
            ->update([
                'revoked' => true
            ]);
    }
    private function checkForActiveTokens($userId)
    {
        return DB::table('oauth_access_tokens')->where('user_id', $userId)
            ->where('revoked', false)->exists();
    }
    // public function logout(){
    //     auth('api')->user();
    // }
    public function logout()
    {
        $token = auth('api')->user()->token();
        $isRevoked = $token->revoke();
        return response()->json([
            'status' => $isRevoked,
            'message' => $isRevoked ? 'logout is succefully' : 'faild successfully'
        ], $isRevoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
    public function forgetPasword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if (!$validator->fails()) {
            $code = random_int(1000, 9999);
            $user = User::where('email', $request->get('email'))->first();
            $user->verification_code = Hash::make($code);
            $user->save();
            return response()->json(['message' => 'success created code', 'code' => $code], Response::HTTP_OK);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function reset_password(Request $request)
    {
        $validator = Validator($request->all(), [
            'code' => 'required|numeric|digits:4',
            'password' => 'required|string|confirmed',
            'email' => 'required|email|exists:users'
        ]);
        if (!$validator->fails()) {
            $user = User::where('email', $request->email)->first();
            if (Hash::check($request->code, $user->verification_code)) {
                $user->password = Hash::make($request->password);
                $isSaved = $user->save();
                return response()->json(
                    ['message' => $isSaved ? 'sucess change password' : 'faild change'],
                    $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}
