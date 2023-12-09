<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Session;
use App\Models\Inquiry;
use Carbon\Carbon;

class AdminInquiryController extends Controller
{
    public function getInquiries($filter = 'all') {
        $carbon = new Carbon();
        $today = $carbon->now()->format("Y-m-d");
        $today_count = Inquiry::where('created_at', 'like', '%'.$today.'%')->count();
        $last_week_count = Inquiry::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->count();
        $inquiries = [];

        if ($filter == "all") {
            $inquiries = Inquiry::orderBy('created_at', 'desc')->get();
        } else if ($filter == "today") {
            $inquiries = Inquiry::where('created_at', 'like', '%'.$today.'%')
                            ->orderBy('created_at', 'desc')
                            ->get();
        } else if ($filter == "last-week") {
            $inquiries = Inquiry::whereBetween('created_at', [$carbon->now()->subWeek()->startOfWeek(), $carbon->now()->subWeek()->endOfWeek()])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('admin.inquiries', [
            'inquiries'       => $inquiries, 
            'today_count'     => $today_count,
            'last_week_count' => $last_week_count
        ]);
    }

}
