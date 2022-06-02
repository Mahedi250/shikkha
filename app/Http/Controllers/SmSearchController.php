<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class SmSearchController extends Controller
{
  public function __construct()
	{
        $this->middleware('PM');
        // User::checkAuth();
	}
  function search(Request $r){

        try{
          if($r->ajax())
          {
           $output = '';
           $query = $r->get('search');
           if($query != '')
           {
             //search by student roll
              
              
                
                $data = DB::table('sm_students')
                ->where('caste', 'like', '%'.$query.'%')
                ->orWhere('mobile', 'like', '%'.$query.'%')
                ->join('sm_parents','sm_students.parent_id','=','sm_parents.id')
                ->leftjoin('sm_fees_assigns','sm_fees_assigns.student_id','=','sm_students.id')
                ->join('sm_sections','sm_sections.id','=','sm_students.section_id')
                ->join('sm_classes','sm_classes.id','=','sm_students.class_id')
                ->select('sm_students.id as id','sm_students.first_name','sm_parents.guardians_name as gurdian_name','sm_parents.guardians_mobile as gurdian_mobile',DB::raw('SUM(sm_fees_assigns.fees_amount) as due'),'sm_students.roll_no','sm_sections.section_name','sm_classes.class_name')
                ->get();
                // dd($data);
                return response()->json($data, 201);


              
      

              if (Auth::user()->role_id == 1) {
                $data = DB::table('sm_module_links')
                ->where('name', 'like', '%'.$query.'%')
                ->where('route', '!=', '')
                ->orderBy('id', 'desc')
                ->get();
                //dd($data );
                return response()->json($data, 200);
              }
              else {
                $data = DB::table('sm_module_links')
                ->join('sm_role_permissions', 'sm_module_links.id', '=', 'sm_role_permissions.module_link_id')
                ->select('sm_module_links.id','sm_module_links.name as name','sm_module_links.route', 'sm_role_permissions.role_id as role_id', 'sm_role_permissions.active_status as active_status')
                ->where('name', 'like', '%'.$query.'%')
                ->where('route', '!=', '')
                ->where('role_id', @Auth::user()->role_id)
                ->orderBy('id', 'desc')
                ->get();
                return response()->json($data, 200);
              }
          }
          else {
              return response()->json(['not found'=>'Not Found'], 404);

            }

          }
        }catch (\Exception $e) {
           Toastr::error('Operation Failed', 'Failed');
           return redirect()->back();
        }
    }

}

