<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage;
use Google\Cloud\Storage\StorageObject;

class CatalogController extends Controller
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

    public function index()
    {
        $catalogs = $this->database->getReference('catalogs')->getValue();

        if ($catalogs === null) {
            $catalogs = [];
        }

        return view('management', ['catalogs' => $catalogs]);
    }


    public function createCatalog(Request $request)
    {
        $request->validate([
            'catalogName' => 'required|string|max:255',
            'catalogDescription' => 'required|string',
            'catalogImage' => 'required|image|mimes:jpg,jpeg,png|max:204800',
            'catalogPDF' => 'required|mimes:pdf|max:204800',
        ]);

        $imageFile = $request->file('catalogImage');

        if (!$imageFile->isValid()) {
            return redirect()->back()->with('error', 'Image upload failed. Please try again.');
        }

        $imageFileName = 'images/' . uniqid() . '.' . $imageFile->getClientOriginalExtension();

        $imageFileContent = file_get_contents($imageFile->getRealPath());

        $this->bucket->upload($imageFileContent, [
            'name' => $imageFileName,
            'predefinedAcl' => 'publicRead',
        ]);

        $bucketName = $this->bucket->name();
        $imageUrl = 'https://firebasestorage.googleapis.com/v0/b/' . $bucketName . '/o/' . urlencode($imageFileName) . '?alt=media';

        $pdfFile = $request->file('catalogPDF');

        if (!$pdfFile->isValid()) {
            return redirect()->back()->with('error', 'PDF upload failed. Please try again.');
        }

        $pdfFileName = 'pdfs/' . uniqid() . '.' . $pdfFile->getClientOriginalExtension();

        $pdfFileContent = file_get_contents($pdfFile->getRealPath());

        $this->bucket->upload($pdfFileContent, [
            'name' => $pdfFileName,
            'predefinedAcl' => 'publicRead',
        ]);

        $pdfUrl = 'https://firebasestorage.googleapis.com/v0/b/' . $bucketName . '/o/' . urlencode($pdfFileName) . '?alt=media';

        $data = [
            'name' => $request->catalogName,
            'description' => $request->catalogDescription,
            'image' => $imageUrl,
            'pdf' => $pdfUrl,
            'created_at' => now()->format('Y-m-d h:i A'),
        ];

        $this->database->getReference('catalogs')->push($data);

        $logData = [
            'activity' => 'Added',
            'item_name' => $request->catalogName,
            'date_time' => now()->format('Y-m-d h:i A'),
            'description' => 'Added ' . $request->catalogName . ' to the catalog',
        ];

        $this->database->getReference('logs')->push($logData);

        return redirect()->route('catalogs.index')->with('success', 'Catalog created successfully!');
    }

    public function updateCatalog(Request $request)
    {
        $request->validate([
            'catalogId' => 'required|string',
            'catalogName' => 'required|string|max:255',
            'catalogDescription' => 'required|string',
            'catalogImage' => 'nullable|image|mimes:jpg,jpeg,png|max:204800',
            'catalogPDF' => 'nullable|mimes:pdf|max:204800',
        ]);

        $catalogId = $request->catalogId;

        $data = [
            'name' => $request->catalogName,
            'description' => $request->catalogDescription,
        ];

        if ($request->hasFile('catalogImage')) {
            $imageFile = $request->file('catalogImage');

            if ($imageFile->isValid()) {
                $imageFileName = 'images/' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFileContent = file_get_contents($imageFile->getRealPath());

                $this->bucket->upload($imageFileContent, [
                    'name' => $imageFileName,
                    'predefinedAcl' => 'publicRead',
                ]);

                $bucketName = $this->bucket->name();
                $imageUrl = 'https://firebasestorage.googleapis.com/v0/b/' . $bucketName . '/o/' . urlencode($imageFileName) . '?alt=media';

                $data['image'] = $imageUrl;
            }
        }

        if ($request->hasFile('catalogPDF')) {
            $pdfFile = $request->file('catalogPDF');

            if ($pdfFile->isValid()) {
                $pdfFileName = 'pdfs/' . uniqid() . '.' . $pdfFile->getClientOriginalExtension();
                $pdfFileContent = file_get_contents($pdfFile->getRealPath());

                $this->bucket->upload($pdfFileContent, [
                    'name' => $pdfFileName,
                    'predefinedAcl' => 'publicRead',
                ]);

                $bucketName = $this->bucket->name();
                $pdfUrl = 'https://firebasestorage.googleapis.com/v0/b/' . $bucketName . '/o/' . urlencode($pdfFileName) . '?alt=media';

                $data['pdf'] = $pdfUrl;
            }
        }

        $this->database->getReference('catalogs/' . $catalogId)->update($data);

        $logData = [
            'activity' => 'Edited',
            'item_name' => $request->catalogName,
            'date_time' => now()->format('Y-m-d h:i A'),
            'description' => 'Edited ' . ' details from ' . $request->catalogName,
        ];

        $this->database->getReference('logs')->push($logData);

        return redirect()->route('catalogs.index')->with('success', 'Catalog updated successfully!');
    }

    public function deleteCatalog($id)
    {
        $catalogReference = $this->database->getReference('catalogs/' . $id);
        $catalogData = $catalogReference->getValue();
    
        if ($catalogData) {
            $catalogReference->remove();
    
            $logData = [
                'activity' => 'Deleted',
                'item_name' => $catalogData['name'],
                'date_time' => now()->format('Y-m-d h:i A'),
                'description' => 'Deleted ' . $catalogData['name'] . ' from the catalog',
            ];
    
            $this->database->getReference('logs')->push($logData);
    
            return redirect()->back()->with('success', 'Catalog deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Catalog not found!');
        }
    }
    

    public function showCatalogs()
    {
        $catalogs = $this->database->getReference('catalogs')->getValue();

        if ($catalogs === null) {
            $catalogs = [];
        }

        return view('homepage', ['catalogs' => $catalogs]);
    }

    public function showActivity(Request $request)
    {
        $logs = $this->database->getReference('logs')->getValue();
    
        if ($logs === null) {
            $logs = [];
        } else {
            usort($logs, function ($a, $b) {
                return strtotime($b['date_time']) - strtotime($a['date_time']);
            });
        }
    
        $logCount = count($logs);
        $perPage = 8;
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $paginatedLogs = array_slice($logs, $offset, $perPage);
    
        $catalogs = $this->database->getReference('catalogs')->getValue();
        $catalogCount = $catalogs === null ? 0 : count($catalogs);
    
        return view('dashboard', [
            'logs' => $paginatedLogs,
            'logCount' => $logCount,
            'catalogCount' => $catalogCount,
            'currentPage' => $currentPage,
            'lastPage' => ceil($logCount / $perPage),
        ]);
    }
    
    
    



}

