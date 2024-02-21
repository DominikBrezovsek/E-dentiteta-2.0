<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function getUserRequestedToJoin()
    {
        $notifications = Auth::user()->unreadNotifications;

        $messageArray = [];

        foreach ($notifications as $notification) {
            $user = User::whereId($notification->data['user'])->first();
            $messageArray[] = $notification;
        }
        return $messageArray;
    }

    public function getStudentCardRequests()
    {
        $notifications = Auth::user()->unreadNotifications;
        $messageArray = [];

        foreach ($notifications as $notification) {
            $user = User::whereId($notification->data['id_user'])->first();
            $messageArray[] = $notification;
        }
        return $messageArray;
    }

    public function getNotifications()
    {
        $notifications = [];
        switch (Auth::user()->role){
            case ("OAD"):
                $notifications['join'] =  $this->getUserRequestedToJoin();
                return view('organisation_admin.profile.notifications', [
                    'notification' => $notifications
                ]);
            case ("PRF"):
                $notifications['card'] = $this->getStudentCardRequests();
                return view('professor.profile.notifications', [
                    'notification' => $notifications
                ]);
            case("SAD"):
                $notifications['join'] = $this->getUserRequestedToJoin();
                $notifications['card'] = $this->getStudentCardRequests();
                return view('professor.profile.notifications', [
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
