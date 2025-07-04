<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.index', [
            'notifications' => Notification::latest()->paginate(10)
        ]);
    }

    public function update(Notification $notification, Request $request)
    {
        $notification->update([
            'is_read' => true
        ]);
        
        return redirect()->route('inventories.edit', $notification->inventory_id);
    }
}
