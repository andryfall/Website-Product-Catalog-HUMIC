<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Factory;

class AuthController extends Controller
{
    protected $database;

    protected $storage;

    protected $bucket;

    public function __construct()
{
    $firebase = (new Factory)
        ->withServiceAccount([
            'type' => env('FIREBASE_TYPE'),
            'project_id' => env('FIREBASE_PROJECT_ID'),
            'private_key_id' => env('FIREBASE_PRIVATE_KEY_ID'),
            'private_key' => str_replace("\\n", "\n", env('FIREBASE_PRIVATE_KEY')),
            'client_email' => env('FIREBASE_CLIENT_EMAIL'),
            'client_id' => env('FIREBASE_CLIENT_ID'),
            'auth_uri' => env('FIREBASE_AUTH_URI'),
            'token_uri' => env('FIREBASE_TOKEN_URI'),
            'auth_provider_x509_cert_url' => env('FIREBASE_AUTH_PROVIDER_X509_CERT_URL'),
            'client_x509_cert_url' => env('FIREBASE_CLIENT_X509_CERT_URL')
        ])
        ->withDatabaseUri('https://hkiproductcataloghumic-944d5-default-rtdb.firebaseio.com/');

    $this->database = $firebase->createDatabase();
    $this->storage = $firebase->createStorage();
    $this->bucket = $this->storage->getBucket();
}

    public function showLoginForm()
    {
        $adminData = $this->database->getReference('admin')->getValue();
        if (!$adminData) {
            $this->createAdmin();
        }
        return view('Login');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $adminData = $this->database->getReference('admin')->getValue();

        if ($adminData && $adminData['email'] === $request->email && Hash::check($request->password, $adminData['password'])) {
            Session::put('admin', [
                'first_name' => $adminData['first_name'],
                'last_name' => $adminData['last_name'],
                'email' => $adminData['email'],
                'profile_image' => $adminData['profile_image']
            ]);

            return redirect()->route('catalogs.activity');

        }

        return redirect()->back()->withErrors(['Invalid credentials.']);
    }

    public function logout()
    {
        Session::forget('admin');
        return redirect('/login');
    }

    public function createAdmin()
    {
        $this->database->getReference('admin')->set([
            'email' => 'default@admin.com',
            'password' => bcrypt('password'),
            'first_name' => 'Default',
            'last_name' => 'admin',
            'profile_image' => ''
        ]);
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $file = $request->file('profile_image');
        
        $imageFileName = 'admin/' . uniqid() . '.' . $file->getClientOriginalExtension();

        $imageFileContent = file_get_contents($file->getRealPath());

        $this->bucket->upload($imageFileContent, [
            'name' => $imageFileName,
            'predefinedAcl' => 'publicRead',
        ]);

        $bucketName = $this->bucket->name();
        $imageUrl = 'https://firebasestorage.googleapis.com/v0/b/' . $bucketName . '/o/' . urlencode($imageFileName) . '?alt=media';

        $this->database->getReference('admin/profile_image')->set($imageUrl);

        Session::put('admin.profile_image', $imageUrl);

        return back()->with('success', 'Profile picture updated successfully.');
    }
    
    public function updateAdmin(Request $request)
    {
        $request->validate([
            'firstNameAdmin' => 'required|string',
            'lastNameAdmin' => 'required|string',
            'emailAdmin' => 'required|email'
        ]);
    
        $data = [
            'first_name' => $request->firstNameAdmin,
            'last_name' => $request->lastNameAdmin,
            'email' => $request->emailAdmin,
        ];
        
        $this->database->getReference('admin')->update($data);
    
        Session::put('admin', [
            'first_name' => $request->firstNameAdmin,
            'last_name' => $request->lastNameAdmin,
            'email' => $request->emailAdmin,
            'profile_image' => Session::get('admin.profile_image')
        ]);
    
        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        $adminData = $this->database->getReference('admin')->getValue();

        if (!Hash::check($request->current_password, $adminData['password'])) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $this->database->getReference('admin/password')->set(Hash::make($request->new_password));

        return back()->with('success', 'Password updated successfully.');
    }

    

}
