<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Salles;
use App\User;
use App\Equipements;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $today = Carbon::today();
        $now = Carbon::now();
        
        $rooms = Salles::count();
        $users = User::count();
        $equipments = Equipements::count();
        $reservationsToday = Reservation::whereDate('date_reservation', $today->toDateString())->count();
        
            $upcoming = Reservation::whereDate('date_reservation', $today->toDateString())
        ->where('start_time', '>', $now->toTimeString())
        ->orderBy('start_time', 'asc')
        ->with('user')
        ->with('salle')
        ->get();

        // Example: Grouping users by role for the pie chart
        $usersByRole = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->get();

        // Format data for Google Charts (Pie Chart)
        $chartData = [['Role', 'Count']];
        foreach ($usersByRole as $roleData) {
            $chartData[] = [$roleData->role, $roleData->count];
        }

        // Example: Grouping reservations by date for the line chart
        $reservationsByDay = Reservation::select(
                DB::raw('DATE(date_reservation) as date'),
                DB::raw('count(*) as count')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Format data for Google Charts (Line Chart)
        $lineChartData = [['Date', 'Reservations']];
        foreach ($reservationsByDay as $dayData) {
            $lineChartData[] = [Carbon::parse($dayData->date)->format('Y-m-d'), $dayData->count];
        }

        return view('welcome', compact('rooms', 'equipments', 'users', 'reservationsToday', 'upcoming', 'chartData', 'lineChartData'));
    }
}
