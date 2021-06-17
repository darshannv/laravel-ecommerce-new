<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{

    //------------ Division ----------------
    public function divisionView(){

        $divisions = ShipDivision::orderBy('id', 'DESC')->get();
        return view('backend.ship.division.view_division', compact('divisions'));
    }



    public function divisionStore(Request $request){
        $validateData = $request->validate([

            'division_name' => 'required',
           
            ]);

   
        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => now(),
        ]);

        $notification = array(

            'message' => 'Division Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function divisionEdit($id){
        $divisions = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit_division', compact('divisions'));
    }

    public function divisionUpdate(Request $request){

        $validateData = $request->validate([

            'division_name' => 'required',
           
            ]);

            $div_id = $request->id;
        ShipDivision::findOrFail($div_id)->update([
            'division_name' => $request->division_name,
            'updated_at' => now(),
        ]);

        $notification = array(

            'message' => 'Division Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.division')->with($notification);
    }

    public function divisionDelete($id){
        ShipDivision::findOrFail($id)->delete();
        $notification = array(

            'message' => 'Division Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

    }





    //------------- District -----------------
    public function districtView(){

        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::with('division')->orderBy('id', 'DESC')->get();
        return view('backend.ship.district.view_district', compact('divisions', 'districts'));
    }

    public function districtStore(Request $request){

        $validateData = $request->validate([

            'division_id' => 'required',
            'district_name' => 'required',
           
            ],[
                'division_id.required' => 'Division name is required',
            ]);

   
        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => now(),
        ]);

        $notification = array(

            'message' => 'District Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function districtEdit($id){

        $divisions = ShipDivision::orderBy('id', 'ASC')->get();
        $districts = ShipDistrict::with('division')->findOrFail($id);
        return view('backend.ship.district.edit_district', compact('divisions', 'districts'));
    }

    public function districtUpdate(Request $request){

        $validateData = $request->validate([

            'division_id' => 'required',
            'district_name' => 'required',
           
            ],[
                'division_id.required' => 'Division name is required',
            ]);

            $dist_id = $request->id;
        ShipDistrict::findOrFail($dist_id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'updated_at' => now(),
        ]);

        $notification = array(

            'message' => 'District Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.district')->with($notification);
    }

    public function districtDelete($id){
        ShipDistrict::findOrFail($id)->delete();
        $notification = array(

            'message' => 'District Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }









    //---------------- State -------------------------
    public function stateView(){

        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $states = ShipState::with('division', 'district')->orderBy('id', 'DESC')->get();
        return view('backend.ship.state.view_state', compact('divisions', 'districts', 'states'));
    }

    //----------------- Ajax call --------------------
    public function getDistrict($division_id){
        $shipDist = ShipDistrict::where('division_id', $division_id)->orderBy('district_name','ASC')->get();

        return json_encode($shipDist);
 
    }

    public function stateStore(Request $request){

        $validateData = $request->validate([

            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
           
            ],[
                'division_id.required' => 'Division name is required',
                'district_id.required' => 'District name is required',
            ]);

   
        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => now(),
        ]);

        $notification = array(

            'message' => 'State Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function stateEdit($id){

        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $states = ShipState::with('division', 'district')->findOrFail($id);
        return view('backend.ship.state.edit_state', compact('divisions', 'districts', 'states'));
    }

    public function stateUpdate(Request $request){


        $validateData = $request->validate([

            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
           
            ],[
                'division_id.required' => 'Division name is required',
                'district_id.required' => 'District name is required',
            ]);
            $state_id = $request->id;
   
        ShipState::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'updated_at' => now(),
        ]);

        $notification = array(

            'message' => 'State Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.state')->with($notification);
    }


    public function stateDelete($id){

        ShipState::findOrFail($id)->delete();
        $notification = array(

            'message' => 'State Deleted Successfully',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
}
