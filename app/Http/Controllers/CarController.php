<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Mf;
use Illuminate\Http\Request;
use App\Models\Flight;
// use Faker\Core\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Cach 1
        $cars = Car::all();
        // $mfs = Mf::all();

        //Cach 2
        // $cars = DB::table('cars')->join('mfs', 'cars.mf_id', '=', 'mfs.id');
        return view('car-list', compact('cars'));
        // dd($cars);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $mfs = MF::all();
        return view('car-create', compact('mfs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'model' => 'required|unique:cars,model',
            'produced_on' => 'required|date',
            'mf' => 'required|exists:mfs,id',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
                // dd($name);
                $destinationPath = 'img'; // chỉ cần lưu tên thư mục, không cần public_path()
                $file->move(public_path($destinationPath), $name); // thư mục public/img
                $car->images =$name; // lưu đường dẫn tương đối
            }
            // $filePath = $file->store('public/img');
            // $car->images = str_replace('public/','',$filePath);
        }
        $car->description = $validatedData['description'];
        $car->model = $validatedData['model'];
        $car->produced_on = $validatedData['produced_on'];
        $car->images = $validatedData['image'];
        $car->mf_id = $request->input('mf');
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
        $mfs = MF::all();
        return view('show', compact('car', 'mfs'));
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
        $mfs = MF::all();
        // dd($mfs);
        return view('car-update', compact('car', 'mfs'));
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, string $id)
        {
            
            $car = Car::findOrFail($id);
            $car->model = $request->model;
            $car->description = $request->description;
            

            $validatedData = $request->validate([
                'model' => 'required|string',
                'description' => 'string',
                'mf' =>'required|exists:mfs,id',
                'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra ảnh
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $name = time() . "_" . $file->getClientOriginalName();
                    $destinationPath = 'img'; // chỉ cần lưu tên thư mục, không cần public_path()
                    $file->move(public_path($destinationPath), $name); // thư mục public/img
                    $car->images = $destinationPath . '/' . $name; // lưu đường dẫn tương đối
                }
            }

            $car->description = $validatedData['description'];
            $car->model = $validatedData['model'];
            $car->mf_id = $request->input('mf');
            $car->save();

            return redirect()->route('cars.show', $car->id)->with('success', 'Update successful');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);

        if (File::exists($car->images)) {
            File::delete($car->images);
        }
        $car->delete();
        return redirect('cars')->with('success', 'Delete product Successful!');
    }
}
