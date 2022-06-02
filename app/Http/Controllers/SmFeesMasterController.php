<?php



namespace App\Http\Controllers;



use App\User;

use App\SmClass;

use App\SmParent;

use App\SmStudent;

use App\tableList;

use App\YearCheck;

use App\SmFeesType;

use App\SmBaseSetup;

use App\SmFeesGroup;

use App\SmFeesAssign;

use App\SmFeesMaster;

use App\ApiBaseMethod;

use App\SmFeesPayment;

use App\SmNotification;

use App\SmStudentGroup;

use App\SmStudentCategory;

use Illuminate\Http\Request;

use App\SmFeesAssignDiscount;

use Illuminate\Support\Facades\DB;

use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Notification;

use App\Notifications\FeesAssignNotification;
use DataTables;
use Illuminate\Support\Facades\Crypt;


class SmFeesMasterController extends Controller



{

    public function __construct()

    {

        $this->middleware('PM');

        // User::checkAuth();

    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $masters=DB::table('sm_fees_masters')->get();
            return DataTables::of($masters)
                    ->addIndexColumn()
                    ->editColumn('active_status',function($row) {
                        if ($row->active_status== 1) {
                            return '<span class="badge badge-success">Active</span>';
                        }else{
                            return '<span class="badge badge-danger">Inactive</span>';
                        }
                        
                    })
                    ->addColumn('action', function($row){
                        $actionbtn='<a href="#" class="btn btn-primary btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="fa fa-edit"></i></a>
                        <a href="'.route('delete.master_fees',[\Crypt::encrypt($row->id)]).'" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash"></i>
                        </a>';

                       return $actionbtn;   

                    })
                    ->rawColumns(['action','active_status'])
                    ->make(true);       
        }
        // '.route('childcategory.delete',[$row->id]).'

        return view('backEnd.feesCollection.fees_master');

        // try {

        //     // $fees_groups = SmFeesGroup::where('school_id', Auth::user()->school_id)->where('academic_id', getAcademicId())->get();

        //     // $fees_masters = SmFeesMaster::where('school_id', Auth::user()->school_id)->where('academic_id', getAcademicId())->get();

        //     // $already_assigned = [];

        //     // foreach ($fees_masters as $fees_master) {

        //     //     $already_assigned[] = $fees_master->fees_type_id;

        //     // }

        //     // $fees_masters = $fees_masters->groupBy('fees_group_id');

        //     // $fees_types = SmFeesType::where('school_id', Auth::user()->school_id)->where('academic_id', getAcademicId())->get();

        //     $fees_masters = SmFeesMaster::where('school_id', Auth::user()->school_id)->where('academic_id', getAcademicId())->get();



        //     // if (ApiBaseMethod::checkUrl($request->fullUrl())) {

        //     //     $data = [];

        //     //     $data['fees_groups'] = $fees_groups->toArray();

        //     //     $data['fees_types'] = $fees_types->toArray();

        //     //     $data['fees_masters'] = $fees_masters->toArray();



        //     //     return ApiBaseMethod::sendResponse($data, null);

        //     // }

        //     return view('backEnd.feesCollection.fees_master', compact('fees_masters'));

        // } catch (\Exception $e) {

        //     Toastr::error('Operation Failed', 'Failed');

        //     return redirect()->back();

        // }

    }



    public function store(Request $request)

    {

        $request->validate([

            // 'fees_type' => "required",

            'fees_name' => "required",
            'date' => "required",
            'amount' => "required|integer|min:0"

        ]);

        try {

            $fees_type = SmFeesType::find($request->fees_type);

            $combination = SmFeesMaster::where('fees_group_id', $request->fees_group)->where('fees_type_id', $request->fees_type)->count();



            if ($combination == 0) {

                $fees_master = new SmFeesMaster();

                // $fees_master->fees_group_id = $fees_type->fees_group_id;
                // $fees_master->fees_type_id = $request->fees_type;
                $fees_master->fees_group_id = 0;
                $fees_master->fees_type_id = 1;

                $fees_master->fees_name = $request->fees_name;
                $fees_master->date = date('Y-m-d', strtotime($request->date));
                $fees_master->school_id = Auth::user()->school_id;
                $fees_master->academic_id = getAcademicId();
                $fees_master->amount = $request->amount;



                $result = $fees_master->save();

                if ($result) {

                    Toastr::success('Operation successful', 'Success');

                    return redirect()->back();

                } else {

                    Toastr::error('Operation Failed', 'Failed');

                    return redirect()->back();

                }

            } elseif ($combination == 1) {

                Toastr::error('Already fees assigned', 'Failed');

                return redirect()->back();

            } else {

                Toastr::error('Operation Failed', 'Failed');

                return redirect()->back();

            }

        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();

        }

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {



        try {

            if (checkAdmin()) {

                $fees_master = SmFeesMaster::find($id);

            }else{

                $fees_master = SmFeesMaster::where('id',$id)->where('school_id',Auth::user()->school_id)->first();

            }

            $fees_groups = SmFeesGroup::where('school_id', Auth::user()->school_id)->where('academic_id', getAcademicId())->get();

            $fees_types = SmFeesType::where('school_id', Auth::user()->school_id)->where('academic_id', getAcademicId())->get();

            $fees_masters = SmFeesMaster::where('school_id', Auth::user()->school_id)->where('academic_id', getAcademicId())->get();



            $already_assigned = [];

            foreach ($fees_masters as $master) {

                if ($fees_master->fees_type_id != $master->fees_type_id) {

                    $already_assigned[] = $master->fees_type_id;

                }

            }



            $fees_masters = $fees_masters->groupBy('fees_group_id');

            return view('backEnd.feesCollection.fees_master', compact('fees_groups', 'fees_types', 'fees_master', 'fees_masters', 'already_assigned'));

        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();

        }

    }



    public function update(Request $request, $id)

    {



        $request->validate([

            'fees_name' => "required",

            'amount' => "required"

        ]);



        try {

            $fees_type = SmFeesType::find($request->fees_type);

            if (checkAdmin()) {

                $fees_master = SmFeesMaster::find($request->id);

            }else{

                $fees_master = SmFeesMaster::where('id',$request->id)->where('school_id',Auth::user()->school_id)->first();

            }

            //$fees_master->fees_type_id = $request->fees_type;
            $fees_master->fees_name = $request->fees_name;

            $fees_master->date = date('Y-m-d', strtotime($request->date));

            $fees_master->amount = $request->amount;

            $fees_master->fees_group_id = $fees_type->fees_group_id;

            $result = $fees_master->save();

            if ($result) {

                Toastr::success('Operation successful', 'Success');

                return redirect('fees-master');

            } else {

                Toastr::error('Operation Failed', 'Failed');

                return redirect()->back();

            }

        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();

        }

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {



        try {

            if (checkAdmin()) {

                $fees_master = SmFeesMaster::destroy($id);

            }else{

                $fees_master = SmFeesMaster::where('id',$id)->where('school_id',Auth::user()->school_id)->delete();

            }

            if ($fees_master) {

                Toastr::success('Operation successful', 'Success');

                return redirect('fees-master');

            } else {

                Toastr::error('Operation Failed', 'Failed');

                return redirect()->back();

            }

        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();

        }

    }



    public function deleteSingle(Request $request)

    {

        try {

            $id_key = 'fees_master_id';

            $tables = tableList::getTableList($id_key, $request->id);

            try {

                if ($tables == null) {

                    $check_fees_assign = SmFeesAssign::where('fees_master_id', $request->id)

                        ->join('sm_students','sm_students.id','=','sm_fees_assigns.student_id')->first();

                    if ($check_fees_assign != null) {

                        $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';

                        Toastr::error($msg, 'Failed');

                        return redirect()->back();

                    }

                    if (checkAdmin()) {

                        $delete_query = SmFeesMaster::destroy($request->id);

                    }else{

                        $delete_query = SmFeesMaster::where('id',$request->id)->where('school_id',Auth::user()->school_id)->delete();

                    }

                    if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                        if ($delete_query) {

                            return ApiBaseMethod::sendResponse(null, 'Fees Master has been deleted successfully');

                        } else {

                            return ApiBaseMethod::sendError('Something went wrong, please try again.');

                        }

                    } else {

                        if ($delete_query) {

                            Toastr::success('Operation successful', 'Success');

                            return redirect()->back();

                        } else {

                            Toastr::error('Operation Failed', 'Failed');

                            return redirect()->back();

                        }

                    }

                } else {

                    $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';

                    Toastr::error($msg, 'Failed');

                    return redirect()->back();

                }

            } catch (\Illuminate\Database\QueryException $e) {

                $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';

                Toastr::error('This item already used', 'Failed');

                return redirect()->back();

            } catch (\Exception $e) {

                Toastr::error('Operation Failed', 'Failed');

                return redirect()->back();

            }

        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();

        }

    }



    public function deleteGroup(Request $request)

    {

        try {

            $id_key = 'fees_group_id';

            $tables = tableList::getTableList($id_key, $request->id);

            try {

                $assigned_master_id=[];

                $fees_group_master=SmFeesAssign::get();

                foreach ($fees_group_master as $key => $value) {

                    $assigned_master_id[]=$value->fees_master_id;

                }

                $feesmasters = SmFeesMaster::where('fees_group_id',$request->id)->get();

                foreach ($feesmasters as $feesmaster) {

                    if (!in_array($feesmaster->id, $assigned_master_id)) {

                        if (checkAdmin()) {

                            $delete_query = SmFeesMaster::destroy($feesmaster->id);

                        }else{

                            $delete_query = SmFeesMaster::where('id',$feesmaster->id)->where('school_id',Auth::user()->school_id)->delete();

                        }

                    }else{

                        $msg = 'This data already used in : ' . $tables . ' Please remove those data first';

                        Toastr::error($msg, 'Failed');

                        return redirect()->back();

                    }



                }

                if ($delete_query) {

                    Toastr::success('Operation successful', 'Success');

                    return redirect()->back();

                } else {

                    Toastr::error('Operation Failed', 'Failed');

                    return redirect()->back();

                }

            } catch (\Illuminate\Database\QueryException $e) {

                $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';

                Toastr::error('This item already used', 'Failed');

                return redirect()->back();

            }

        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();

        }

    }



    public function feesAssign(Request $request, $id)

    {



        try {

            $fees_group_id = $id;

            $classes = SmClass::where('active_status', 1)->where('school_id', Auth::user()->school_id)->where('academic_id', getAcademicId())->get();

            $groups = SmStudentGroup::where('active_status', '=', '1')->where('school_id', Auth::user()->school_id)->get();

            $categories = SmStudentCategory::where('school_id', Auth::user()->school_id)->where('academic_id', getAcademicId())->get();



            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                $data = [];

                $data['classes'] = $classes->toArray();

                $data['categories'] = $categories->toArray();

                $data['groups'] = $groups->toArray();

                $data['fees_group_id'] = $fees_group_id;

                return ApiBaseMethod::sendResponse($data, null);

            }

            return view('backEnd.feesCollection.fees_assign', compact('classes', 'categories', 'groups', 'fees_group_id'));

        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();

        }

    }

    public function feesAssignSearch(Request $request)

    {

        $input = $request->all();

        $validator = Validator::make($input, [

            'class' => "required"

        ]);



        if ($validator->fails()) {

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());

            }

            return redirect()->back()

                ->withErrors($validator)

                ->withInput();

        }



        try {

            $section_id=0;

            $classes = DB::table('sm_classes')->where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();

            $groups = DB::table('sm_student_groups')->where('active_status', '=', '1')->where('school_id', Auth::user()->school_id)->get();

            $categories = DB::table('sm_student_categories')->where('school_id', Auth::user()->school_id)->get();

            $fees_group_id = $request->fees_group_id;



            $students = SmStudent::query();

            $students->where('active_status', 1);

            if ($request->class != "") {

                $students->where('class_id', $request->class);

            }

            if ($request->section != "") {

                $students->where('section_id', $request->section);

                $section_id=$request->section;

            }

            if ($request->category != "") {

                $students->where('student_category_id', $request->category);

            }

            if ($request->group != "") {

                $students->where('student_group_id', $request->group);

            }



            $students = $students->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();



            $fees_masters = SmFeesMaster::where('fees_group_id', $request->fees_group_id)->where('school_id', Auth::user()->school_id)->get();



            $pre_assigned = [];

            foreach ($students as $student) {

                foreach ($fees_masters as $fees_master) {

                    $assigned_student = SmFeesAssign::select('student_id')->where('student_id', $student->id)->where('fees_master_id', $fees_master->id)->first();



                    if ($assigned_student != "") {

                        if (!in_array($assigned_student->student_id, $pre_assigned)) {

                            $pre_assigned[] = $assigned_student->student_id;

                        }

                    }

                }

            }

            if ($pre_assigned !=null) {

                $assigned_value=1;

            } else {

                $assigned_value=0;

            }

            $class_id = $request->class;

            $category_id = $request->category;

            $group_id = $request->group;



            $fees_assign_groups = SmFeesMaster::where('fees_group_id', $request->fees_group_id)->where('school_id', Auth::user()->school_id)->get();



            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                $data = [];

                $data['classes'] = $classes->toArray();

                $data['categories'] = $categories->toArray();

                $data['groups'] = $groups->toArray();

                $data['students'] = $students->toArray();

                $data['fees_assign_groups'] = $fees_assign_groups->toArray();

                $data['fees_group_id'] = $fees_group_id;

                $data['pre_assigned'] = $pre_assigned;

                $data['class_id'] = $class_id;

                $data['category_id'] = $category_id;

                $data['group_id'] = $group_id;

                return ApiBaseMethod::sendResponse($data, null);

            }

            return view('backEnd.feesCollection.fees_assign', compact('classes', 'categories', 'groups', 'students', 'fees_assign_groups', 'fees_group_id', 'pre_assigned', 'class_id', 'category_id', 'group_id','assigned_value','section_id'));

        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();

        }

    }

    public function feesAssignStore(Request $request)

    {

    //    return $request;

        try {

            $fees_masters = SmFeesMaster::where('fees_group_id', $request->fees_group_id)

                ->where('school_id', Auth::user()->school_id)

                ->get();

            if ($request->checked_ids != "") {

                foreach ($request->students as $student) {

                    foreach ($fees_masters as $fees_master) {

                        $payment_info=SmFeesPayment::where('active_status',1)->where('fees_type_id',$fees_master->fees_type_id)->where('student_id',$student)->first();

                        if ($payment_info==null) {

                            $assign_fees = SmFeesAssign::where('fees_master_id', $fees_master->id)->where('student_id', $student)->delete();

                        }

                    }

                }

            }

            if (!isset($request->checked_ids)) {

                foreach ($request->students as $student) {

                    foreach ($fees_masters as $fees_master) {

                        $payment_info=SmFeesPayment::where('active_status',1)->where('fees_type_id',$fees_master->fees_type_id)->where('student_id',$student)->first();

                        if ($payment_info==null) {

                            $assign_fees = SmFeesAssign::where('fees_master_id', $fees_master->id)->where('student_id', $student)->delete();

                        }

                    }

                }

            }

            // return $request;

            if ($request->checked_ids != "") {

                foreach ($request->checked_ids as $student) {

                    foreach ($fees_masters as $fees_master) {

                        $assign_fees = SmFeesAssign::where('fees_master_id', $fees_master->id)->where('student_id', $student)->first();



                        if ( $assign_fees) {

                            continue;

                        }

                        $assign_fees = new SmFeesAssign();

                        $assign_fees->student_id = $student;

                        $assign_fees->fees_amount = $fees_master->amount;

                        $assign_fees->fees_master_id = $fees_master->id;

                        $assign_fees->school_id = Auth::user()->school_id;

                        $assign_fees->academic_id = getAcademicId();

                        $assign_fees->save();





                        //Yearly Discount assign



                        $check_yearly_discount=SmFeesAssignDiscount::where('fees_group_id',$request->fees_group_id)->where('student_id',$student)->first();



                        if ($check_yearly_discount) {

                            if ($assign_fees->fees_amount>$check_yearly_discount->applied_amount) {

                            

                                $payable_fees=$assign_fees->fees_amount-$check_yearly_discount->applied_amount;



                                $assign_fees->applied_discount=$check_yearly_discount->applied_amount;

                                $assign_fees->fees_discount_id = $check_yearly_discount->fees_discount_id;

                                $assign_fees->fees_amount = $payable_fees;

                                $assign_fees->save();

                            }

                           

                        }

                    }

                    $students_info = SmStudent::find($student);

                    $notification = new SmNotification;

                    $notification->user_id = $students_info->user_id;

                    $notification->role_id = 2;

                    $notification->date = date('Y-m-d');

                    $notification->message = 'New fees Assigned';

                    $notification->school_id = Auth::user()->school_id;

                    $notification->academic_id = getAcademicId();

                    $notification->save();

                    

                    $user=User::find($student->user_id);

                    Notification::send($user, new FeesAssignNotification($assign_fees));

    

                    $parent = SmParent::find($students_info->parent_id);

                    $notification2 = new SmNotification;

                    $notification2->user_id = $parent->user_id;

                    $notification2->role_id = 3;

                    $notification2->date = date('Y-m-d');

                    $notification2->message = 'New fees Assigned For ' . $students_info->full_name;

                    $notification2->school_id = Auth::user()->school_id;

                    $notification2->academic_id = getAcademicId();

                    $notification2->save();



                    $user=User::find($parent->user_id);

                    Notification::send($user, new FeesAssignNotification($assign_fees));

                }

            }



            $html = "";

            return response()->json([$html]);

        } catch (\Exception $e) {

            return response()->json("", 404);

        }

    }

    public function feesAssignStoreOld(Request $request)

    {

        try {

            $fees_masters = SmFeesMaster::where('fees_group_id', $request->fees_group_id)

                ->where('school_id', Auth::user()->school_id)

                ->get();



            if ($request->checked_ids != "") {

                foreach ($request->checked_ids as $student) {

                    foreach ($fees_masters as $fees_master) {

                        $assign_fees = SmFeesAssign::where('fees_master_id', $fees_master->id)->delete();

                    }

                }

            }    



            if ($request->checked_ids != "") {

                foreach ($request->checked_ids as $student) {

                    foreach ($fees_masters as $fees_master) {

                        $assign_fees = SmFeesAssign::where('fees_master_id', $fees_master->id)->where('student_id', $student)->first();



                        if ( $assign_fees) {

                            continue;

                        }

                        $assign_fees = new SmFeesAssign();

                        $assign_fees->student_id = $student;

                        $assign_fees->fees_amount = $fees_master->amount;

                        $assign_fees->fees_master_id = $fees_master->id;

                        $assign_fees->school_id = Auth::user()->school_id;

                        $assign_fees->academic_id = getAcademicId();

                        $assign_fees->save();





                        //Yearly Discount assign



                        $check_yearly_discount=SmFeesAssignDiscount::where('fees_group_id',$request->fees_group_id)->where('student_id',$student)->first();



                        if ($check_yearly_discount) {

                            if ($assign_fees->fees_amount>$check_yearly_discount->applied_amount) {

                            

                                $payable_fees=$assign_fees->fees_amount-$check_yearly_discount->applied_amount;



                                $assign_fees->applied_discount=$check_yearly_discount->applied_amount;

                                $assign_fees->fees_discount_id = $check_yearly_discount->fees_discount_id;

                                $assign_fees->fees_amount = $payable_fees;

                                $assign_fees->save();

                            }

                           

                        }

                    }

                }

            }



            foreach ($request->students as $student) {

                $students_info = SmStudent::find($student);

                $notification = new SmNotification;

                $notification->user_id = $students_info->user_id;

                $notification->role_id = 2;

                $notification->date = date('Y-m-d');

                $notification->message = 'New fees Assigned';

                $notification->school_id = Auth::user()->school_id;

                $notification->academic_id = getAcademicId();

                $notification->save();



                $parent = SmParent::find($students_info->parent_id);

                $notification2 = new SmNotification;

                $notification2->user_id = $parent->user_id;

                $notification2->role_id = 3;

                $notification2->date = date('Y-m-d');

                $notification2->message = 'New fees Assigned For ' . $students_info->full_name;

                $notification2->school_id = Auth::user()->school_id;

                $notification2->academic_id = getAcademicId();

                $notification2->save();

            }

            $html = "";

            return response()->json([$html]);

        } catch (\Exception $e) {

            return response()->json("", 404);

        }

    }


    //__store fees master__//
    public function storeFeesMaster(Request $request)
    {
        $request->validate([
            'fees_name' => 'required',
            'amount' => 'required'
        ]);

        $data=array();
        $data['fees_name']=$request->fees_name;
        $data['amount']=$request->amount;
        $data['date']=$request->date;
        $data['active_status']=$request->active_status;
        $data['school_id']=Auth::user()->school_id;
        $data['academic_id']=getAcademicId();
        $data['created_by']=Auth::id();
        $payment=DB::table('sm_fees_masters')->insert($data);
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    //__delete master fees__//
    public function DeleteMasterFees($id)
    {
       $id=Crypt::decrypt($id);
       DB::table('sm_fees_masters')->where('id',$id)->delete(); 
       Toastr::success('Operation successful', 'Success');
       return redirect()->back();
    }

    //__edit master fees__//
    public function EditMasterFees($id)
    {
        $data=DB::table('sm_fees_masters')->where('id',$id)->first(); 
        return view('backEnd.feesCollection.edit_master_fees',compact('data'));
    }

    //__update fees master__//
    public function updateFeesMaster(Request $request)
    {
        $request->validate([
            'fees_name' => 'required',
            'amount' => 'required'
        ]);

        $data=array();
        $data['fees_name']=$request->fees_name;
        $data['amount']=$request->amount;
        $data['date']=$request->date;
        $data['active_status']=$request->active_status;
        $data['school_id']=Auth::user()->school_id;
        $data['academic_id']=getAcademicId();
        $data['updated_by']=Auth::id();
        $payment=DB::table('sm_fees_masters')->where('id',$request->id)->update($data);
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

}