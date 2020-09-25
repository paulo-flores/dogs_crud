<?php

namespace App\Http\Controllers;

use App\Http\Requests\DogRequest;
use App\Models\Dog;
use Illuminate\Http\Request;

class DogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dogs = Dog::paginate(5);
       
        return view('dogs.index', ['dogs' => $dogs,'field' => '', 'value' => '']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dogs.create');
    }

    public function search(Request $request)
    {
        
        $search = $request->get('search');
        if(!$search){
            return redirect('/dogs');
        }
       
        $dogs = Dog::where('name', 'like', '%'. $search . '%')->paginate(5);
        return view('dogs.index', ['dogs' => $dogs, 'field' => 'search', 'value' => $search]);
    }


    public function orderByColumn(Request $request)
    {
        $column = $request->get('column');
        $columns = ['name', 'breed', 'age'];
        if(!in_array($column, $columns)){
            return redirect('/dogs');
        }

        $dogs =  Dog::orderBy($column, 'asc')->paginate(5);
        return view('dogs.index', ['dogs' => $dogs, 'field' => 'column', 'value' => $column]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DogRequest $request)
    {      $request->name == null;
        if(Dog::create($request->all())){
            $request->session()->flash(
                'message',
                "Dog {$request->name}, breed: {$request->breed}  age: {$request->age} inserted successfully!"
            );
            return redirect('/dogs');
        }
        $request->session()->flash(
            'error',
            "Error, try again later."
        );
        return redirect('/dogs');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dog  $dog
     * @return \Illuminate\Http\Response
     */
    public function show(Dog $dog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dog  $dog
     * @return \Illuminate\Http\Response
     */
    public function edit(Dog $dog)
    {
        return view('dogs.edit', ['dog' => $dog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dog  $dog
     * @return \Illuminate\Http\Response
     */
    public function update(DogRequest $request, Dog $dog)
    {
        if($dog->update($request->all())){
            $request->session()->flash(
                'message',
                "Dog {$request->name}, breed: {$request->breed}  age: {$request->age} updated successfully!"
            );
            return redirect('/dogs');
        }
        $request->session()->flash(
            'error',
            "Error, try again later."
        );
        return redirect('/dogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dog  $dog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Dog $dog)
    {      
        if(Dog::destroy($dog->id)){
            $request->session()->flash(
                'message',
                "Dog successfully removed!"
            );
            return redirect('/dogs');
        }
        $request->session()->flash(
            'error',
            "Error, try again later."
        );
        return redirect('/dogs');

    }

   
}
