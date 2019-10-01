<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Charts;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
                    ->get();
        $chart12 = Charts::database($post, 'bar', 'highcharts')
              ->title("Monthly new Post")
              ->elementLabel("Total Post")
              ->dimensions(500, 300)
              ->responsive(true)
              ->groupByMonth(date('Y'), true);  

        //only chart                
        $chart = Charts::database($post, 'bar', 'highcharts')
                  ->title("Monthly new Post")
                  ->elementLabel("Total Post")
                  ->dimensions(500, 300)
                  ->responsive(true)
                  ->groupByMonth(date('Y'), true);

        //pai chart          
        $pie  =  Charts::create('pie', 'highcharts')
                    ->title('Pai chart')
                    ->labels(['First', 'Second', 'Third'])
                    ->values([5,10,20])
                    ->dimensions(500,300)
                    ->responsive(false);

        //line chart            
        $line = Charts::create('line', 'highcharts')
            ->title('Line chart')
            ->elementLabel('Line label')
            ->labels(['First', 'Second', 'Third'])
            ->values([5,10,20])
            ->dimensions(490,300)
            ->responsive(false);

        //donut chart    
        $doungchart = Charts::create('donut', 'highcharts')
                    ->title('Doughnut chart')
                    ->labels(['First', 'Second', 'Third'])
                    ->values([5,10,20])
                    ->dimensions(500,300)
                    ->responsive(false);
        //percentage            
        $percentage = Charts::create('percentage', 'justgage')
                    ->title('Percentage chart')
                    ->elementLabel('Percentage label')
                    ->values([65,0,100])
                    ->responsive(false)
                    ->height(300)
                    ->width(490);                              
        // $chart12 = Charts::database($post, 'bar', 'highcharts')
        //           ->title("Monthly new Post")
        //           ->elementLabel("Total Post")
        //           ->dimensions(500, 500)
        //           ->responsive(true)
        //           ->groupByMonth(date('Y'), true);          
                  // dd($chart12);
                  // $chart12->values
                  //$chart12->labels
        // $chart = Charts::create('bar', 'highcharts')
        //       ->title('Monthly new Post')
        //       ->elementLabel('Total Post')
        //       ->labels($chart12->labels)
        //       ->values([0,0,0,5,10,15,20,25,30,35])
        //       ->dimensions(1000,500)
        //       ->responsive(false);      
        return view('admin',compact('chart','pie','line','doungchart','percentage'));
    }
}
