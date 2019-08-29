<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacation;

class CalendarController extends Controller
{
    public function index()
    {
        return view('site.start');
    }

    public function store(Request $request)
    {

        $vacationDay = new Vacation();

        $vacationDay->name = $request->input('name');
        $vacationDay->vacation_day = $request->input('vacationDay');

        if ($vacationDay->save()) {
            return response()->json($vacationDay);
        }
    }

    public function show()
    {
        $allDays = [];
        $monthDays = [];

        for ($i=1; $i<13; $i++) {
            $daysOfMonth = Vacation::whereMonth('vacation_day', $i)
                ->select('name', 'vacation_day')->get()->toArray();

            if ($daysOfMonth) {
                $allDays[$i] = $daysOfMonth;
            } else {
                $allDays[$i] = '';
            }
        }

        //dd($allDays);

        foreach($allDays as $month => $days ) {

            if (!$days) {
                $monthDays[$month] = '';
                continue;
            }
            $monthDays[$month] = '';
            foreach ($days as $day) {
                //array_push($monthDays[$month], substr($day['vacation_day'],8,10));
                //блин, с 2-мерн массивом неудобно во вью :( - делаю массив строк.
                $monthDays[$month] .= substr($day['vacation_day'],8,10).',' ;
            }
            $monthDays[$month] = substr($monthDays[$month], 0, -1);
        }

        //dd($allDays, $monthDays);

        if(count($monthDays)) {
            return response()->json($monthDays);
        }

        return response()->json(['error' => 'Not found any vacation days']);

    }

    public function goodDays()
    {
        $goodDays = count(Vacation::all());

        if($goodDays) {
            return response()->json($goodDays);
        }

        return response()->json(0);
    }
}
