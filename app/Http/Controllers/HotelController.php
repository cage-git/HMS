<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Hotel;
use Illuminate\Support\Facades\Validator;
use Auth,DB;

class HotelController extends Controller
{
    function addHotel(){
        return view('backend/hotel/add-hotel');
    }
    function allHotel(){
        return view('backend/hotel/all-hotel');

    }
    public function saveHotel(Request $request){  
        $data           = $request->all();
        $business_id    = Auth::user()->business_id;
        $addHotel       = Hotel::create([
        'business_id'   =>$business_id,
        'name'          =>$data['hotel_name'],
        'location_id'   =>$data['location_id'],
        'landmark'      =>$data['landmark'],
        'zipcode'       =>$data['zipcode'],
        'address'       =>$data['address'],
        'status'        =>$data['status'],

        ]);
       return view('backend/hotel/all-hotel');
    }
    public function allHotelData(Request $request)
    {
        $columns = [
            'id',
            'name',
            'location_id',
            'landmark',
            'zipcode',
            'address',
            'status',
        ];

        $query = Hotel::select($columns);

        // Filtering
        if ($request->filled('search.value')) {
            $query->where(function ($q) use ($columns, $request) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $request->input('search.value') . '%');
                }
            });
        }

        // Sorting
        if ($request->filled('order.0.column') && $request->filled('order.0.dir')) {
            $query->orderBy($columns[$request->input('order.0.column')], $request->input('order.0.dir'));
        }

        // Pagination
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $data = $query->offset($start)->limit($length)->get();

        $jsonData = [
            'data' => $data,
            'recordsTotal' => Hotel::count(),
            'recordsFiltered' => $query->count(),
        ];

        return response()->json($jsonData);
    }

    public function editHotel(Request $request, $id){
         $data['data_row']=Hotel::whereId($request->id)->first();        
          return response()->json($data);
    }
     public function updateHotelData(Request $request, $id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        $hotel->update($request->all());
        return redirect()->route('all-hotels');
    }
    public function deactivateHotel(Request $request, $id){
         $hotel = Hotel::find($id);
         // echo "<pre>";print_r($hotel['status']);die("test");
         if($hotel['status']===1){
           $hotel->update(['status' => 0]);
         }
         
          return response()->json(['message' => 'Hotel updated successfully']);
    }
}