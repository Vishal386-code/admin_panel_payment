<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingPayments = Payment::where('status', 'pending')->count();
        $completePayments = Payment::where('status', 'completed')->count();
        $failedPayments = Payment::where('status', 'failed')->count();

        $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        $rawData = Payment::selectRaw("DATE_FORMAT(created_at, '%b') as month, SUM(amount) as total")
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $chartData = [];
        foreach ($months as $month) {
            $chartData[$month] = $rawData[$month] ?? 0;
        }

        return view('admin.dashboard', compact('pendingPayments', 'completePayments', 'failedPayments', 'chartData'));
    }
}
