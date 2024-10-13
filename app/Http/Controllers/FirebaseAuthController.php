<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Illuminate\Support\Facades\Session;

class FirebaseAuthController extends Controller
{
    protected $auth;

    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }

    public function verifyToken(Request $request)
    {
        $idToken = $request->input('token');

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken);
            $uid = $verifiedIdToken->claims()->get('sub');

            $user = $this->auth->getUser($uid);

            // Check if user has admin role via custom claims
            $claims = $verifiedIdToken->claims()->all();
            if (isset($claims['admin']) && $claims['admin'] === true) {
                // Set session variables
                Session::put('firebase_uid', $uid);
                Session::put('admin', true);
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Not authorized as admin'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Invalid token'], 401);
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }

    public function setAdmin(Request $request)
    {
        $uid = $request->input('uid');

        try {
            $this->auth->setCustomUserClaims($uid, ['admin' => true]);
            return response()->json(['status' => 'success', 'message' => 'User is now an admin']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Unable to set admin role'], 500);
        }
    }
}
