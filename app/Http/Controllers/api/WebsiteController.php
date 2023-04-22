<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Http\Requests\WebsiteRequest;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Website::latest()->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WebsiteRequest $request)
    {
        $data = $request->only(["name", "description"]);

        $website = Website::create($data);

        return response()->json([
            "message" => "Website created successfully",
            "data" => $website
        ]);
    }
}
