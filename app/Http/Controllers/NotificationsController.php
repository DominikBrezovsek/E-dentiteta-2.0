<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function getUserNotifications()
    {
        $notifications = Auth::user()->unreadNotifications;

        $messageArray = [];

        foreach ($notifications as $notification) {
            $messageArray[] = $notification;
        }
        return $messageArray;
    }

    public function getNotifications()
    {
        $notifications = [];
        switch (Auth::user()->role){
            case ("OAD"):
                $notifications[] =  $this->getUserNotifications();
                return view('organisation_admin.profile.notifications', [
                    'notification' => $notifications
                ]);
            case ("PRF"):
                $notifications[] = $this->getUserNotifications();
                return view('professor.profile.notifications', [
                    'notification' => $notifications
                ]);
            case("SAD"):
                $notifications[] = $this->getUserNotifications();
                return view('systemAdmin.profile.notifications', [
                    'notification' => $notifications
                ]);

        }

    }

    public function markAsRead($notification)
    {
        \DB::table('notifications')->where('id', '=', $notification)->update(['read_at' => Carbon::now()]);
        return back()->with('message', 'Označeno kot prebreano');
    }
}
