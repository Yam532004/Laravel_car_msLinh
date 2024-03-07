<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Flight;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('car-list  
        ', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('car-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'bail|required',
            'description' => 'bail|required',
            'model' => 'bail|required',
            'produced_on' => 'bail|required',
            'image' => 'bail|required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ],[
            'name.required'=>'Name is required',
            'description.required'=>'Description is required',
            'model.required'=>'Model is required',
            'produced_on.required'=>'Produced_on is required',
            'image.required'=>'Image is required',
        ]);

        $car = new Car();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $name = time() . "_" . $file->getClientOriginalName();
                $destinationPath = public_path('img');
                $file->move($destinationPath, $name);
                $car->images = $name;
            }
        }

        // Các phần còn lại của lưu dữ liệu
        $car->description = $validatedData['description'];
        $car->model = $validatedData['model'];
        $car->produced_on = $validatedData['produced_on'];
        $car->images = $validatedData['image'];
        $car->save();

        // return back()->with('success', "Add new product Succesful!");
        return redirect('cars')->with('success', 'Add new product Successful!');
    }



    /**
     * Display the specified resource.
     */
    // Chi tiet xe 
    public function show(string $id)
    {
        $car = Car::find($id);
        return view('show', compact('car'));
    }

    // public function show (Request $request){
    //     $carId = $request->input('id');
    //     $car = Car::find($carId);
    //     return view('car-detail', compact('car'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}