<?php

namespace App\Http\Controllers;
use App\Models\Record;
use App\Models\User;

use illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('homecontent');
    }

    public function statistics()
        {   
            return view('statistics');
        }

    public function getStatistics(){
        $user = Auth::user();

        $stateCounts = Record::where('user_id', $user->id)
            ->select('state', \DB::raw('count(*) as count'))
            ->groupBy('state')
            ->pluck('count', 'state');
    
        $states = ['neutral', 'valid', 'rejected'];
    
        $counts = array_fill_keys($states, 0);
    
        foreach ($states as $state) {
            if ($stateCounts->has($state)) {
                $counts[$state] = $stateCounts[$state];
            }
        }
    
        $formattedCounts = array_values($counts);
        $total = array_sum($formattedCounts);
        $data = [
            "yValues"=>$formattedCounts,
            "xValues"=>$states,
            "total"=>$total
        ];
        
        return response()->json($data);

    }
                
    
}
