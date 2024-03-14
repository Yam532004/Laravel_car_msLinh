<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Flight;
// use Faker\Core\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

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
        // $validatedData = $request->validate([
        //     'name' => 'bail|required|max:255',
        //     'description' => 'bail|required|max:255',
        //     'model' => 'bail|required|unique:cars,model',
        //     'produced_on' => 'bail|required|date',
        //     'image' => 'bail|required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        // ],[
        //     'image.mines'=>'Allow is image file',
        //     'image.max'=>'Images max lower than 2Mb',
        //     'name.required'=>'Name is required',
        //     'description.required'=>'Description is required',
        //     'model.required'=>'Model is required',
        //     'model.unique'=>'Model da bi trung',
        //     'produced_on.required'=>'Produced_on is required',
        //     'image.required'=>'Image is required',
        // ]);

        // $car = new Car();

       

        // // Các phần còn lại của lưu dữ liệu
        // $car->description = $validatedData['description'];
        // $car->model = $validatedData['model'];
        // $car->produced_on = $validatedData['produced_on'];
        // $car->images = $validatedData['image'];
        // $car->save();

        // return redirect('cars')->with('success', 'Add new product Successful!');


        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'model' => 'required|unique:cars,model',
            'produced_on' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('/cars/create')
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        $car = new Car();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $name = time() . "_" . $file->getClientOriginalName();
                $destinationPath = 'img'; // chỉ cần lưu tên thư mục, không cần public_path()
                $file->move(public_path($destinationPath), $name); // thư mục public/img
                $car->images = $destinationPath.'/' . $name; // lưu đường dẫn tương đối
            }
        }
        $car->description = $validatedData['description'];
        $car->model = $validatedData['model'];
        $car->produced_on = $validatedData['produced_on'];
        // $car->images = $validatedData['image'];

        $car->save();

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
        $car = Car::find($id);
        return view('car-update', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $car = Car::findOrFail($id);
        $car->model = $request->model;
        $car->description = $request->description;
        $car->produced_on = $request->produced_on;

        $validatedData = $request->validate([
            'model' => 'required|string',
            'description' => 'string',
            'produced_on' => 'date',
            'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra ảnh
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $name = time() . "_" . $file->getClientOriginalName();
                $destinationPath = 'img'; // chỉ cần lưu tên thư mục, không cần public_path()
                $file->move(public_path($destinationPath), $name); // thư mục public/img
                $car->images = $destinationPath.'/' . $name; // lưu đường dẫn tương đối
            }
        }

        $car->description = $validatedData['description'];
        $car->model = $validatedData['model'];
        $car->produced_on = $validatedData['produced_on'];

        $car->save();

        return redirect()->route('cars.show', $car->id)->with('success', 'Update successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);
        
        if (File::exists($car->images)){
            File::delete($car->images);
        }
        $car->delete();
        return redirect('cars')->with('success', 'Delete product Successful!');
    }
}
