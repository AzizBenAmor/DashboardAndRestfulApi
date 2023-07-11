<?php

namespace App\Http\Controllers\API\Adherent;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetNotification()
    {
        $notification=Notification::all();
        return response()->json($notification) ;
    }

   
}
