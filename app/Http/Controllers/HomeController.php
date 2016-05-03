<?php

namespace App\Http\Controllers;
use App\Person;
use Input, Validator, Response, Redirect;
use App\Http\Requests;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function person()
    {
        $data['person'] = Person::all(); 
        return view('person.index', $data)->withTitle('Person');
    }

    public function edit($id)
    {
        $person = Person::find($id);
        return Response::json($person);
    }

    public function store(Request $request)
    {
        $rules     = array(
                            'first_name'   => 'required|min:3',
                            'last_name'    => 'required|min:3',
                            'address'      => 'required',
                            'email'        => 'required|email|unique:person,email'
                          );

        $validator = Validator::make(Input::all(), $rules);
            
        if($validator->fails())
        {
            return response()->json([
                'success' => false,
                'errors'   => $validator->errors()->toArray()
                ]);
        }

        $person = Person::create($request->all());

        return response()->json([
               'success'  => true,
               'data' => $person
               ]);
    }

    public function update(Request $request, $id)
    {
        $rules = array(
                       'first_name'   => 'required|min:3',
                       'last_name'    => 'required|min:3',
                       'address' => 'required',
                       'email'   => 'required|email|unique:person,email,'.$id.',id'
                      );

        $validator = Validator::make(Input::all(), $rules);
            
        if($validator->fails())
        {
            return response()->json([
                'success' => false,
                'errors'   => $validator->errors()->toArray()
                ]);
        }

        $person = Person::findOrFail($id);
        $person->update($request->all());

        return response()->json([
               'success'  => true,
               'data' => $person
               ]);
        
    }

    public function destroy($id)
    {
        Person::destroy($id);
        return response()->json([
               'success' => true,
               ]);
    }
}
