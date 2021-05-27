<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Auth;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Person::orderBy('id', 'DESC')->get();
        $u = Person::where('name', Auth()->user()->name)->first();
        return view('users.index', ['users' => $users, 'u' => $u ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // 'name' => 'required',
            'winning_number1' => 'required|unique:persons',
            'winning_number2' => 'unique:persons',
            'winning_number3' => 'unique:persons',
            'winning_number4' => 'unique:persons',
            'winning_number5' => 'unique:persons',
        ]);
        $w1 = Person::where('winning_number1', $request->winning_number1)
            ->orWhere('winning_number2', $request->winning_number1)
            ->orWhere('winning_number3', $request->winning_number1)
            ->orWhere('winning_number4', $request->winning_number1)
            ->orWhere('winning_number5', $request->winning_number1)
            ->first();

        $w2 = Person::where('winning_number1', $request->winning_number2)
            ->orWhere('winning_number2', $request->winning_number2)
            ->orWhere('winning_number3', $request->winning_number2)
            ->orWhere('winning_number4', $request->winning_number2)
            ->orWhere('winning_number5', $request->winning_number2)
            ->first();

        $w3 = Person::where('winning_number1', $request->winning_number3)
            ->orWhere('winning_number2', $request->winning_number3)
            ->orWhere('winning_number3', $request->winning_number3)
            ->orWhere('winning_number4', $request->winning_number3)
            ->orWhere('winning_number5', $request->winning_number3)
            ->first();

        $w4 = Person::where('winning_number1', $request->winning_number4)
            ->orWhere('winning_number2', $request->winning_number4)
            ->orWhere('winning_number3', $request->winning_number4)
            ->orWhere('winning_number4', $request->winning_number4)
            ->orWhere('winning_number5', $request->winning_number4)
            ->first();

        $w5 = Person::where('winning_number1', $request->winning_number5)
            ->orWhere('winning_number2', $request->winning_number5)
            ->orWhere('winning_number3', $request->winning_number5)
            ->orWhere('winning_number4', $request->winning_number5)
            ->orWhere('winning_number5', $request->winning_number5)
            ->first();

        if(isset($w1)){

           return view('users.create', ['error1' => 'Winning number 1 is already been taken.']);

        }
        elseif(isset($w2)){
           
            return view('users.create', ['error1' => 'Winning number 2 is already been taken.']);
        }
        elseif(isset($w3)){
           
            return view('users.create', ['error1' => 'Winning number 3 is already been taken.']);
        }
        elseif(isset($w4)){
           
            return view('users.create', ['error1' => 'Winning number 4 is already been taken.']);
        }
        elseif(isset($w5)){
           
            return view('users.create', ['error1' => 'Winning number 5 is already been taken.']);
        }

        $users = new Person([
            'name' => Auth()->user()->name,
            'winning_number1' => $request->get('winning_number1'),
            'winning_number2' => $request->get('winning_number2'),
            'winning_number3' => $request->get('winning_number3'),
            'winning_number4' => $request->get('winning_number4'),
            'winning_number5' => $request->get('winning_number5')
        ]);

        $users->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
