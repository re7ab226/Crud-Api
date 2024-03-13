<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;




class PropertiesControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proprties=Properties::all();
        
        return response()->json($proprties);
    }

  
 


public function store(Request $request){

    // dd($request->all());
            $this->validate($request, [
                'title' => 'required|string',
                'slug' => 'required|string',
                'price' => 'required|numeric',
                'featured' => 'required|string',
                'purpose' => ['required', Rule::in(['buy', 'rent'])],
                'category_id' => 'required|int',
                'image' => 'nullable|image|mimes:jpg,png,jpeg',
                'bedroom' => 'required|int',
                'bathroom' => 'required|int',
                'detailed_address' => 'required|string',
                'Area' => 'required|string',
                'Year_building' => 'required|numeric',
                'Finishing_type' => 'required|string',
                'License_RealEstate' => 'required|string',
                'Payment_method' => ['required', Rule::in(['installment', 'cash'])],
                'location_id' => 'required|int',
                'agent_id' => 'required|int',
                'description' => 'required|string',
                'video' => 'nullable|mimes:mp4,mov,avi|max:10240',
                'floor_plan' => 'required|string',
                'location_latitude' => 'required|string',
                'location_longitude' => 'required|string',
            ] );


         
            $imageName = null;


                if ($request->hasFile('realestat_img')) {
                  
                    $img = $request->file('realestat_img');
                    if ($img->isValid()) {
                        $extension = $img->getClientOriginalExtension();
                        $imageName = "realestat_img" . uniqid() . ".$extension";
                        $img->move(public_path('uploads/realestat_img'), $imageName);
                    } else {
                        // Handle invalid file (optional)
                        return response()->json(['error' => 'Invalid image file'], 400);
                    }
                }
                $videoName = null;

                if ($request->hasFile('realestat_video')) {
                    $video = $request->file('realestat_video');
                    
                    if ($video->isValid()) {
                        $extension = $video->getClientOriginalExtension();
                        $videoName = "realestat_video" . uniqid() . ".$extension";
                        $video->move(public_path('uploads/realestat_video'), $videoName);
                    } else {
                        // Handle invalid file (optional)
                        return response()->json(['error' => 'Invalid video file'], 400);
                    }
                }
 

                $Properties = Properties::create([
                    'title' => $request->input('title'),
                    'slug' => $request->input('slug'),
                    'price' => $request->input('price'),
                    'featured' => $request->input('featured'),
                    'purpose' => $request->input('purpose'),
                    'category_id' => $request->input('category_id'),
                    'image' => 'uploads/realestat_img/' . $imageName,
                    'bedroom' => $request->input('bedroom'),
                    'bathroom' => $request->input('bathroom'),
                    'detailed_address' => $request->input('detailed_address'),
                    'Area' => $request->input('Area'),
                    'Year_building' => $request->input('Year_building'),
                    'Finishing_type' => $request->input('Finishing_type'),
                    'License_RealEstate' => $request->input('License_RealEstate'),
                    'Payment_method' => $request->input('Payment_method'),
                    'location_id' => $request->input('location_id'),
                    'agent_id' => $request->input('agent_id'),
                    'description' => $request->input('description'),
                    'video' => 'uploads/realestat_video/' . $videoName,
                    'floor_plan' => $request->input('floor_plan'),
                    'location_latitude' => $request->input('location_latitude'),
                    'location_longitude' => $request->input('location_longitude'),
                ]);
          

            return response()->json(['msg'=>'proprties added successfully',"status"=>200]);

            } 
       




    public function show(string $id)
    {
        $property = Properties::find($id);

        if (!$property) {
            return response()->json(['error' => 'Property not found'], 404);
        }

        return response()->json(['property' => $property]);
    
    }

/*update*/


public function update(Request $request, string $id)

{
    $property = Properties::find($id);

    if (!$property) {
        return Response::json(['error' => 'Property not found'], 404);
    }
    

    $validator = Validator::make($request->all(), [
        'title' => 'string',
        'slug' => 'string',
        'price' => 'numeric',
        'featured' => 'string',
        'purpose' => [ Rule::in(['buy', 'rent'])],//enum
        'category_id' => 'int',
        'image' => 'nullable|image|mimes:jpg,png,jpeg',
        'bedroom' => 'int',
        'bathroom' => 'int',
        'detailed_address' => 'string',
        'Area' => 'string',
        'Year_building' => 'numeric',
        'Finishing_type' => 'string',
        'License_RealEstate' => 'string',
        'Payment_method' => [ Rule::in(['installment', 'cash'])],
        'location_id' =>'int',
        'agent_id' => 'int',
        'description' => 'string',
        'video' => 'nullable|mimes:mp4,mov,avi|max:10240',
        'floor_plan' => 'string',
        'location_latitude' => 'string',
        'location_longitude' => 'string',
    ]); 


 
    if ($validator->fails()) {
       return Response::json(['error' => $validator->errors()], 400);


    }  
  

  
    $property->update([
        'title' => $request->input('title')? $request->input('title') : $property->title,
        'slug' => $request->input('slug')? $request->input('slug') : $property->slug,
        'price' => $request->input('price')? $request->input('price') : $property->price,
        'featured' => $request->has('featured') ? $request->input('featured') : $property->featured,
        'purpose' => $request->has('purpose') ? $request->input('purpose') : $property->purpose,
        'category_id' => $request->input('category_id')? $request->input('category_id') : $property->category_id,
        'image' => 'uploads/realestat_img/' . ('$imageName')? $request->input('image') : $property->image,
        'bedroom' => $request->has('bedroom') ? $request->input('bedroom') : $property->bedroom,
        'bathroom' => $request->input('bathroom') ? $request->input('bathroom') : $property->bathroom,
        'detailed_address' => $request->input('detailed_address')? $request->input('detailed_address') : $property->detailed_address,
        'Area' => $request->input('Area')? $request->input('Area') : $property->Area,
        'Year_building' => $request->input('Year_building')? $request->input('Year_building') : $property->Year_building,
        'Finishing_type' => $request->input('Finishing_type')? $request->input('Finishing_type') : $property->Finishing_type,
        'License_RealEstate' => $request->input('License_RealEstate')? $request->input('License_RealEstate') : $property->License_RealEstate,
        'Payment_method' => $request->input('Payment_method')? $request->input('Payment_method') : $property->Payment_method,
        'location_id' => $request->input('location_id')? $request->input('location_id') : $property->location_id,
        'agent_id' => $request->input('agent_id')? $request->input('agent_id') : $property->agent_id,
        'description' => $request->input('description')? $request->input('description') : $property->description,
        'video' => 'uploads/realestat_video/' .(' $videoName'),
        'floor_plan' => $request->input('floor_plan')? $request->input('floor_plan') : $property->floor_plan,
        'location_latitude' => $request->input('location_latitude')? $request->input('location_latitude') : $property->location_latitude,
        'location_longitude' => $request->input('location_longitude')? $request->input('location_longitude') : $property->location_longitude,
   
]);

       // $request->save();

    return response()->json(['message' => 'Property updated successfully', 'data' => $property], 200);
}















    public function destroy(string $id)
    {
        $property =Properties::find($id);

        // Check if the property exists
        if (!$property) {
            return Response::json(['message' => 'Property not found'], 404);
        }

        // Delete the property
        $property->delete();

        return Response::json(['message' => 'Property deleted successfully'], 200);
    
    }
}
