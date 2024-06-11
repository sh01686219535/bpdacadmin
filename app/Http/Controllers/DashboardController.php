<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\UserEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data = array();
        $data['active_menu'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
        $events = Event::all()->count();
        $user = User::all()->count();
        $pendingUser = User::where('status','pending')->count();
        $approvedUser = User::where('status','approved')->count();
        $upcomingEvents = Event::where('start_date', '>', Carbon::now())->count();
        $previewEvents = Event::where('start_date', '<', Carbon::now())->count();
        // $totalRevenue = UserEvent::sum('total_Amount');
        $currentDate = now(); // Get the current date and time

// Sum the 'total_Amount' for upcoming events
        $totalRevenue = UserEvent::join('events', 'user_events.event_id', '=', 'events.id')
        ->where('events.start_date', '>', $currentDate)
        ->sum('user_events.total_Amount');
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Calculate the monthly sum
        $monthlyIncome = UserEvent::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('total_Amount');

        return view('backend.dashboard.dashboard',compact('data','events','user','pendingUser','approvedUser','upcomingEvents','previewEvents','totalRevenue','monthlyIncome'));
    }
}
