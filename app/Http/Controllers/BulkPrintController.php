<?php

namespace App\Http\Controllers;

use App\SmClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BulkPrintController extends Controller
{
    //

    public function feeVoucherPrint(){
        try {
            $classes = SmClass::where('active_status', 1)
                    ->where('school_id', Auth::user()->school_id)
                    ->where('academic_id', getAcademicId())
                    ->get();
            return view('backEnd.feesCollection.monthly_collection_report',compact('classes'));
        } catch (\Exception $e) {
           
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function feeVoucherPrintSearch(Request $request){
            
    }
}
