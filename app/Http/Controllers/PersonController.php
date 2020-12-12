<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Person;
class PersonController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function getAll()
    {
        return Person::orderBy('name', 'asc')->get();         
    }

    public function index()
    {
        $people = $this->getAll();
        return view('person', compact('people'));
    }
        
    public function create(Request $request)
    {        
        $validator = Validator::make($request->all(),[ 
            'name' => 'required|regex:/^[a-z A-Z]+$/u|max:255|unique:people'
        ]);
        if ($validator->fails()) 
        {
            $people = $this->getAll();
            $errors = $validator->messages();
            return view('person', compact('people', 'errors'));
        }

        $name = $request->get('name');
        $person = new Person;
        $person->name = $name;
        $person->save();
        $people = $this->getAll();
        $message = 'Person added successfully...!';
        
        return view('person', compact('people', 'message'));
        
    }
}
