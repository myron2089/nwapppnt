<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //


    /*
    * Get page view for notifications
    */

    public function getNotificationView(){

    	return view('backend.admin.notifications.admin-notification');
    }


}
