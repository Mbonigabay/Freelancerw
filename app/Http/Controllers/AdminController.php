<?php

namespace App\Http\Controllers;

use App\Job;
use App\Message;
use App\User;
use Validator;
use DB;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $list_blocks = [
            [
                'title' => 'Last Logged In Users',
                'entries' => User::orderBy('last_login_at', 'desc')
                    ->take(5)
                    ->get(),
            ],
            [
                'title' => 'Users Not Logged In For 30 Days',
                'entries' => User::where('last_login_at', '<', today()->subDays(30))
                    ->orwhere('last_login_at', null)
                    ->orderBy('last_login_at', 'desc')
                    ->take(5)
                    ->get()
            ],

            [
                'title' => 'Users Banned ',
                'entries' => User::where('banned_at', '!=' , null)
                    ->take(5)
                    ->get(),
            ],
        ];


        $chart_settings = [
            'chart_title' => 'Users By Days',
            'chart_type' => 'bar',
            'report_type' => 'group_by_date',
            'model' => 'App\\User',
            'group_by_field' => 'last_login_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'last_login_at',
            'filter_days' => '30',
            'column_class' => 'col-md-12',
//            'entries_number'     => '7',
        ];
        $chart = new LaravelChart($chart_settings);

        $chart_settings = [
            'chart_title' => 'Users Registered By Days',
            'chart_type' => 'bar',
            'report_type' => 'group_by_date',
            'model' => 'App\\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_days' => '30',
            'column_class' => 'col-md-12',
//            'entries_number'     => '7',
        ];
        $chartReg = new LaravelChart($chart_settings);

        $chart_settings = [
            'chart_title' => 'Job Created By Days',
            'chart_type' => 'bar',
            'report_type' => 'group_by_date',
            'model' => 'App\\Job',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_days' => '30',
            'column_class' => 'col-md-12',
//            'entries_number'     => '7',
        ];
        $chartJob = new LaravelChart($chart_settings);

        $jobs = Job::orderBy('id', 'desc')->take(5)->get();
        $users = User::orderBy('id', 'desc')->take(5)->get();

        return view('admin.index', compact('number_blocks', 'list_blocks', 'chart', 'jobs', 'users', 'chartReg', 'chartJob'));
    }

    public function downloadReport(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $from    = Carbon::parse($startDate)
            ->startOfDay()        // 2018-09-29 00:00:00.000000
            ->toDateTimeString(); // 2018-09-29 00:00:00

        $to      = Carbon::parse($endDate)
            ->endOfDay()          // 2018-09-29 23:59:59.000000
            ->toDateTimeString(); // 2018-09-29 23:59:59

        $list_blocks = [
            [
                'title' => 'Logged In Users',
                'entries' => User::whereBetween('last_login_at', [$from, $to])
                    ->get(),
            ],

        ];

        $user_blocks = [
            [
                'title' => 'Users Created ',
                'entries' => User::whereBetween('created_at', [$from, $to])
                    ->get(),
            ],

            [
                'title' => 'Users Banned ',
                'entries' => User::whereBetween('banned_at', [$from, $to])
                    ->get(),
            ],
        ];

        $jobs_blocks = [
            [
                'title' => 'Created Jobs',
                'entries' => Job::whereBetween('created_at', [$from, $to])
                    ->get(),
            ],

        ];

        $bids_blocks = [
            [
                'title' => 'Bids',
                'entries' => DB::table('job_user')->whereBetween('created_at', [$from, $to])
                    ->get(),
            ],

        ];

        $jobs = Job::orderBy('id', 'desc')->get();
        $users = User::orderBy('id', 'desc')->get();

        $pdf = PDF::loadView('admin.downloadreport', compact('number_blocks', 'list_blocks', 'jobs', 'users', 'jobs_blocks', 'user_blocks' , 'bids_blocks', 'from', 'to'));
        return $pdf->download('Report'.Carbon::now().'.pdf');


    }

    public function downloadReportByDate(Request $request)
    {
        $searchDate = $request->input('searchbydate');
        $list_blocks = [
            [
                'title' => 'Logged In Users',
                'entries' => User::WhereDate('last_login_at', '=', $searchDate)
                    ->get(),
            ],
            [
                'title' => 'Users Created ',
                'entries' => User::WhereDate('created_at', '=', $searchDate)
                    ->get(),
            ],
        ];

        $jobs_blocks = [
            [
                'title' => 'Created Jobs',
                'entries' => Job::whereDate('created_at', '=', $searchDate)
                    ->get(),
            ],

        ];

        $bids_blocks = [
            [
                'title' => 'Bids',
                'entries' => DB::table('job_user')->whereDate('created_at', '=', $searchDate)
                    ->get(),
            ],

        ];


        $jobs = Job::orderBy('id', 'desc')->get();
        $users = User::orderBy('id', 'desc')->get();

        $pdf = PDF::loadView('admin.downloadreportbydate', compact('number_blocks', 'list_blocks', 'jobs', 'users', 'jobs_blocks', 'bids_blocks', 'searchDate'));
        return $pdf->download('Report'.Carbon::now().'.pdf');

    }

    public function banUser(Request $request, $id)
    {

        $status = $request->input('status');
        if ($status = 'block') {
            $user = User::find($id);
            $user->ban();
        }
    }
}
