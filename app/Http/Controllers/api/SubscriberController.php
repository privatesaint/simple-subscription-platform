<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriberRequest;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function subscribe(SubscriberRequest $request)
    {
        $data = $request->only(["website_id", "user_id"]);

        Subscriber::firstOrCreate(
            ["website_id" => $data["website_id"], "user_id" => $data["user_id"]]
        );

        return response()->json([
            "message" => "You have successfully subscribed to mail list",
        ]);
    }
}
