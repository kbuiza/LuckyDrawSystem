<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Draw;
use App\Models\Person;
use DB;
use Illuminate\Support\Facades\Validator;

class DrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $winners = Draw::orderBy('id', 'DESC')->get();

        $grand_prize = 0;
        $second_prize1st = 0;
        $second_prize2nd = 0;
        $third_prize1st = 0;
        $third_prize2nd = 0;
        $third_prize3rd = 0;

        foreach($winners as $winner){
            if($winner->prize_type == "Grand Prize"){
                $grand_prize = 1;
            }
            if($winner->prize_type == "Second Prize - 1st Winner"){
                $second_prize1st = 1;
            }
            if($winner->prize_type == "Second Prize - 2nd Winner"){
                $second_prize2nd = 1;
            }
            if($winner->prize_type == "Third Prize - 1st Winner"){
                $third_prize1st = 1;
            }
            if($winner->prize_type == "Third Prize - 2nd Winner"){
                $third_prize2nd = 1;
            }
            if($winner->prize_type == "Third Prize - 3rd Winner"){
                $third_prize3rd = 1;
            }
        }
        
        return view('draws.index', ['winners' => $winners, 'grand_prize' => $grand_prize, 'second_prize1st' => $second_prize1st, 
            'second_prize2nd' => $second_prize2nd, 'third_prize1st' => $third_prize1st, 'third_prize2nd' => $third_prize2nd, 
            'third_prize3rd' => $third_prize3rd]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $w_numbers = array();

        if($request->prize_types == 'Grand Prize'){
            $winners = DB::table('persons')
                ->whereNotNull('winning_number1')
                ->whereNotNull('winning_number2')
                ->whereNotNull('winning_number3')
                ->whereNotNull('winning_number4')
                ->whereNotNull('winning_number5')
                ->where('winned', '=', '0')
                ->get();
        }
        else{

            if($request->generate == 'No'){
                // dd($request->winning_number);
                $validatedData = $request->validate([
                    'winning_number' => 'required|unique:draws,winning_number',
                    'generate' => 'required',
                ]);



                $test_user = Person::where('winning_number1', $request->winning_number)
                    ->orWhere('winning_number2', $request->winning_number)
                    ->orWhere('winning_number3', $request->winning_number)
                    ->orWhere('winning_number4', $request->winning_number)
                    ->orWhere('winning_number5', $request->winning_number)
                    ->first();

                if($test_user->winned == '0'){

                    $winner_user = Person::where('winning_number1', $request->winning_number)
                        ->orWhere('winning_number2', $request->winning_number)
                        ->orWhere('winning_number3', $request->winning_number)
                        ->orWhere('winning_number4', $request->winning_number)
                        ->orWhere('winning_number5', $request->winning_number)
                        ->first();
                }
                else{
                    return redirect()->Route('draws.index')->with(['error1' => 'User already won.' ]);
                }
              

                
            }
            else{
                $winners = DB::table('persons')
                    ->where('winned', '=', '0')
                    ->get();
            }

        }


        if(isset($winners)){
          foreach ($winners as $winner) {
              
              if($winner->winning_number1 != null){
                  $w_numbers[] = $winner->winning_number1;
              }
              if($winner->winning_number2 != null){
                  $w_numbers[] = $winner->winning_number2;
              }
              if($winner->winning_number3 != null){
                  $w_numbers[] = $winner->winning_number3;
              }
              if($winner->winning_number4 != null){
                  $w_numbers[] = $winner->winning_number4;
              }
              if($winner->winning_number5 != null){
                  $w_numbers[] = $winner->winning_number5;
              }
              
          }
          
          $radom_select = array_rand($w_numbers,1);

          $new_winner = $w_numbers[$radom_select];

          $winner_user = Person::where('winning_number1', $new_winner)
              ->orWhere('winning_number2', $new_winner)
              ->orWhere('winning_number3', $new_winner)
              ->orWhere('winning_number4', $new_winner)
              ->orWhere('winning_number5', $new_winner)
              ->first();
  
        }
        else{
            $new_winner = $request->winning_number;
        }





        $person = Person::find($winner_user->id);

        $person->winned = '1';

        $person->save();


        $draw = new Draw;

        $draw->prize_type = $request->prize_types;
        $draw->name = $winner_user->name;
        $draw->winning_number = $new_winner;

        $draw->save();

        // if(isset($winner_user)){
        //     return redirect()->Route('draws.index')
        //          ->with(['error1' => 'No more users available.' ]);
        // }
        // return redirect()->Route('draws.index')
        //      ->with(['new_winner' => $new_winner, 'name' => $winner_user->name ]);
        return response()->json(['new_winner' => $new_winner, 'name' => $winner_user->name ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
