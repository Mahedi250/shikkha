<?php

namespace App\Http\Controllers;

use App\Role;

use App\User;

use App\SmClass;

use App\SmStaff;

use App\SmSection;

use App\SmStudent;

use App\YearCheck;

use App\ApiBaseMethod;

use App\SmContentType;

use App\SmClassSection;

use App\SmNotification;

use App\SmAssignSubject;

use App\SmGeneralSettings;

use Illuminate\Http\Request;

use App\SmTeacherUploadContent;

use Illuminate\Support\Facades\DB;

use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Notification;

use Modules\RolePermission\Entities\InfixRole;

use App\Notifications\StudyMeterialCreatedNotification;



class SmTeacherController extends Controller

{

    public function __construct()

    {

        $this->middleware('PM');

        // User::checkAuth();

    }



    public function uploadContentList(Request $request)

    {

        try {

            $contentTypes = SmContentType::where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();

            if (teacherAccess()) {

                $uploadContents = SmTeacherUploadContent::where(function ($q) {

                    $q->where('created_by', Auth::user()->id)->orWhere('available_for_admin', 1);
                })

                    ->where('academic_id', getAcademicId())

                    ->where('school_id', Auth::user()->school_id)

                    ->get();
            } else {

                $uploadContents = SmTeacherUploadContent::where('academic_id', getAcademicId())

                    ->where('school_id', Auth::user()->school_id)

                    ->get();
            }



            if (teacherAccess()) {

                $teacher_info = SmStaff::where('user_id', Auth::user()->id)->first();

                $classes = SmAssignSubject::where('teacher_id', $teacher_info->id)->join('sm_classes', 'sm_classes.id', 'sm_assign_subjects.class_id')

                    ->where('sm_assign_subjects.academic_id', getAcademicId())

                    ->where('sm_assign_subjects.active_status', 1)

                    ->where('sm_assign_subjects.school_id', Auth::user()->school_id)

                    ->select('sm_classes.id', 'class_name')

                    ->groupBy('sm_classes.id')

                    ->get();
            } else {

                $classes = SmClass::where('active_status', 1)

                    ->where('academic_id', getAcademicId())

                    ->where('school_id', Auth::user()->school_id)

                    ->get();
            }

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                $data = [];

                $data['contentTypes'] = $contentTypes->toArray();

                $data['uploadContents'] = $uploadContents->toArray();

                $data['classes'] = $classes->toArray();

                return ApiBaseMethod::sendResponse($data, 'Content uploaded successfully.');
            }

            return view('backEnd.teacher.uploadContentList', compact('contentTypes', 'classes', 'uploadContents'));
        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
    }

    public function uploadContentEdit($id)

    {

        $editData = SmTeacherUploadContent::where('school_id', Auth::user()->school_id)

            ->where('academic_id', getAcademicId())

            ->where('id', $id)

            ->first();



        if (Auth::user()->role_id != 1 && $editData->created_by != Auth::user()->id) {

            Toastr::error('This Content added by other. you cannot Modify', 'Failed');

            return redirect()->back();
        }

        $sections = SmSection::where('active_status', 1)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();

        $contentTypes = SmContentType::where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();



        if (teacherAccess()) {

            $uploadContents = SmTeacherUploadContent::where(function ($q) {

                $q->where('created_by', Auth::user()->id)->orWhere('available_for_admin', 1);
            })->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();
        } else {

            $uploadContents = SmTeacherUploadContent::where('academic_id', getAcademicId())

                ->where('school_id', Auth::user()->school_id)

                ->get();
        }



        if (teacherAccess()) {

            $teacher_info = SmStaff::where('user_id', Auth::user()->id)->first();

            $classes = SmAssignSubject::where('teacher_id', $teacher_info->id)->join('sm_classes', 'sm_classes.id', 'sm_assign_subjects.class_id')

                ->where('sm_assign_subjects.academic_id', getAcademicId())

                ->where('sm_assign_subjects.active_status', 1)

                ->where('sm_assign_subjects.school_id', Auth::user()->school_id)

                ->select('sm_classes.id', 'class_name')

                ->groupBy('sm_classes.id')

                ->get();
        } else {

            $classes = SmClass::where('active_status', 1)

                ->where('academic_id', getAcademicId())

                ->where('school_id', Auth::user()->school_id)

                ->get();
        }

        return view('backEnd.teacher.uploadContentList', compact('editData', 'contentTypes', 'classes', 'sections', 'uploadContents'));
    }



    public function uploadContentView(Request $request, $id)

    {



        try {

            if (checkAdmin()) {

                $ContentDetails = SmTeacherUploadContent::find($id);
            } else {

                $ContentDetails = SmTeacherUploadContent::where('id', $id)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->first();
            }



            return view('backEnd.teacher.uploadContentDetails', compact('ContentDetails'));
        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
    }



    public function saveUploadContent(Request $request)

    {
        //dd("hello");

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');



        $maxFileSize = SmGeneralSettings::first('file_size')->file_size;



        if (isset($request->available_for)) {

            foreach ($request->available_for as $value) {

                if ($value == 'student') {

                    if (!isset($request->all_classes)) {

                        $request->validate([

                            'content_title' => "required|max:200",

                            'content_type' => "required",

                            'upload_date' => "required",

                            'content_file' => "required|mimes:pdf,doc,docx,jpg,jpeg,png,mp4,mp3,txt",

                            'class' => "required",

                            'section' => "required",

                        ]);
                    } else {

                        $request->validate([

                            'content_title' => "required|max:200",

                            'content_type' => "required",

                            'upload_date' => "required",

                            'content_file' => "required|mimes:pdf,doc,docx,jpg,jpeg,png,mp4,mp3,txt",

                        ]);
                    }
                }
            }
        } else {

            $request->validate(

                [

                    'content_title' => "required:max:200",

                    'content_type' => "required",

                    'available_for' => 'required|array',

                    'upload_date' => "required",

                    'content_file' => "required|mimes:pdf,doc,docx,jpg,jpeg,png,mp4,mp3",

                ],

                [

                    'available_for.required' => 'At least one checkbox required!',

                ]

            );
        }

        try {

            $fileName = "";

            $imagemimes = ['image/png'];

            $videomimes = ['video/mp4'];

            $audiomimes = ['audio/mp3'];



            $maxFileSize = SmGeneralSettings::first('file_size')->file_size;

            $file = $request->file('content_file');

            $fileSize =  filesize($file);

            $fileSizeKb = ($fileSize / 1000000);

            if ($fileSizeKb >= $maxFileSize) {

                if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                    return ApiBaseMethod::sendError(' Mb is set in system', 'Failed');
                }

                Toastr::error('Max upload file size ' . $maxFileSize . ' Mb is set in system', 'Failed');

                return redirect()->back();
            }









            if (($request->file('content_file') != "")  && (in_array($file->getMimeType(), $videomimes))) {

                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

                $file->move('public/uploads/upload_contents/', $fileName);

                $fileName = 'public/uploads/upload_contents/' . $fileName;
            } elseif ($file != "") {

                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

                $file->move('public/uploads/upload_contents/', $fileName);

                $fileName = 'public/uploads/upload_contents/' . $fileName;
            }



            $y = '2012';

            $m = '2012';

            $d = '2012';



            if ($request->section == "all") {

                $sections = SmClassSection::where('class_id', $request->class)

                    ->where('school_id', Auth::user()->school_id)->get();

                foreach ($sections as $section) {

                    $uploadContents = new SmTeacherUploadContent();

                    $uploadContents->content_title = $request->content_title;

                    $uploadContents->content_type = $request->content_type;

                    $uploadContents->school_id = Auth::user()->school_id;

                    $uploadContents->academic_id = getAcademicId();

                    $uploadContents->class = $request->class;

                    $uploadContents->section = $section->section_id;

                    $uploadContents->upload_date = date('Y-m-d', strtotime($request->upload_date));

                    $uploadContents->description = $request->description;

                    $uploadContents->source_url = $request->source_url;

                    $uploadContents->upload_file = $fileName;

                    $uploadContents->created_by = Auth()->user()->id;

                    $results = $uploadContents->save();
                }
            } else {

                $uploadContents = new SmTeacherUploadContent();

                $uploadContents->content_title = $request->content_title;

                $uploadContents->content_type = $request->content_type;

                $uploadContents->school_id = Auth::user()->school_id;

                $uploadContents->academic_id = getAcademicId();



                foreach ($request->available_for as $value) {

                    if ($value == 'admin') {

                        $uploadContents->available_for_admin = 1;
                    }



                    if ($value == 'student') {

                        if (isset($request->all_classes)) {

                            $uploadContents->available_for_all_classes = 1;
                        } else {

                            $uploadContents->class = $request->class;

                            $uploadContents->section = $request->section;
                        }
                    }
                }



                $uploadContents->upload_date = date('Y-m-d', strtotime($request->upload_date));

                $uploadContents->description = $request->description;

                $uploadContents->source_url = $request->source_url;

                $uploadContents->upload_file = $fileName;

                $uploadContents->created_by = Auth()->user()->id;

                $results = $uploadContents->save();
            }







            if ($request->content_type == 'as') {

                $purpose = 'assignment';
            } elseif ($request->content_type == 'st') {

                $purpose = 'Study Material';
            } elseif ($request->content_type == 'sy') {

                $purpose = 'Syllabus';
            } elseif ($request->content_type == 'ot') {

                $purpose = 'Others Download';
            }



            // foreach ($request->available_for as $value) {

            //     if ($value == 'admin') {

            //         $roles = InfixRole::where('id', '=', 1) /* ->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 9) */->where(function ($q) {

            //             $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            //         })->get();

            //         foreach ($roles as $role) {

            //             $staffs = SmStaff::where('role_id', $role->id)->where('school_id', Auth::user()->school_id)->get();

            //             foreach ($staffs as $staff) {

            //                 $notification = new SmNotification;

            //                 $notification->user_id = $staff->user_id;

            //                 $notification->role_id = $role->id;

            //                 $notification->school_id = Auth::user()->school_id;

            //                 $notification->academic_id = getAcademicId();

            //                 if ($request->content_type == 'as') {

            //                     $notification->url = 'assignment-list';
            //                 } elseif ($request->content_type == 'st') {

            //                     $notification->url = 'study-metarial-list';
            //                 } elseif ($request->content_type == 'sy') {

            //                     $notification->url = 'syllabus-list';
            //                 } elseif ($request->content_type == 'ot') {

            //                     $notification->url = 'other-download-list';
            //                 }

            //                 $notification->date = date('Y-m-d');

            //                 $notification->message = $purpose . ' Uploaded';

            //                 $notification->save();



            //                 $user = User::find($notification->user_id);

            //                 Notification::send($user, new StudyMeterialCreatedNotification($notification));
            //             }
            //         }
            //     }

            //     if ($value == 'student') {

            //         if (isset($request->all_classes)) {



            //             $students = SmStudent::select('id', 'user_id')->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();

            //             foreach ($students as $student) {

            //                 $notification = new SmNotification;

            //                 $notification->user_id = $student->user_id;

            //                 $notification->role_id = 2;

            //                 $notification->school_id = Auth::user()->school_id;

            //                 $notification->academic_id = getAcademicId();

            //                 if ($request->content_type == 'as') {

            //                     $notification->url = 'student-assignment';
            //                 } elseif ($request->content_type == 'st') {

            //                     $notification->url = 'student-study-material';
            //                 } elseif ($request->content_type == 'sy') {

            //                     $notification->url = 'student-syllabus';
            //                 } elseif ($request->content_type == 'ot') {

            //                     $notification->url = 'student-others-download';
            //                 }

            //                 $notification->date = date('Y-m-d');

            //                 $notification->message = $purpose . ' Uploaded';

            //                 $notification->save();



            //                 $user = User::find($notification->user_id);

            //                 Notification::send($user, new StudyMeterialCreatedNotification($notification));
            //             }
            //         } elseif ((!is_null($request->class)) &&   ($request->section == 'all')) {



            //             $students = SmStudent::select('id', 'user_id')->where('class_id', $request->class)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();

            //             foreach ($students as $student) {

            //                 $notification = new SmNotification;

            //                 $notification->user_id = $student->user_id;

            //                 $notification->role_id = 2;

            //                 $notification->school_id = Auth::user()->school_id;

            //                 $notification->academic_id = getAcademicId();

            //                 if ($request->content_type == 'as') {

            //                     $notification->url = 'student-assignment';
            //                 } elseif ($request->content_type == 'st') {

            //                     $notification->url = 'student-study-material';
            //                 } elseif ($request->content_type == 'sy') {

            //                     $notification->url = 'student-syllabus';
            //                 } elseif ($request->content_type == 'ot') {

            //                     $notification->url = 'student-others-download';
            //                 }

            //                 $notification->date = date('Y-m-d');

            //                 $notification->message = $purpose . ' Uploaded';

            //                 $notification->save();



            //                 $user = User::find($notification->user_id);

            //                 Notification::send($user, new StudyMeterialCreatedNotification($notification));
            //             }
            //         } else {



            //             $students = SmStudent::select('id')->where('class_id', $request->class)->where('section_id', $request->section)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();

            //             foreach ($students as $student) {

            //                 $notification = new SmNotification;

            //                 $notification->user_id = $student->user_id;

            //                 $notification->role_id = 2;

            //                 if ($request->content_type == 'as') {

            //                     $notification->url = 'student-assignment';
            //                 } elseif ($request->content_type == 'st') {

            //                     $notification->url = 'student-study-material';
            //                 } elseif ($request->content_type == 'sy') {

            //                     $notification->url = 'student-syllabus';
            //                 } elseif ($request->content_type == 'ot') {

            //                     $notification->url = 'student-others-download';
            //                 }

            //                 $notification->date = date('Y-m-d');

            //                 $notification->message = $purpose . ' Uploaded';

            //                 $notification->school_id = Auth::user()->school_id;

            //                 $notification->academic_id = getAcademicId();

            //                 $notification->save();



            //                 $user = User::find($notification->user_id);

            //                 Notification::send($user, new StudyMeterialCreatedNotification($notification));
            //             }
            //         }
            //     }
            // }



            if ($results) {
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                    return ApiBaseMethod::sendError('Operation successful', 'Success');
                }


                Toastr::success('Operation successful', 'Success');

                return redirect()->back();
            } else {
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                    return ApiBaseMethod::sendError('not saved succecfully', 'failed');
                }

                Toastr::error('Operation Failed', 'Failed');

                return redirect()->back();
            }
        } catch (\Exception $e) {


            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                return ApiBaseMethod::sendError($e->getMessage(), 'failed');
            }
            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
    }

    public function updateUploadContent(Request $request)

    {



        DB::statement('SET FOREIGN_KEY_CHECKS=0;');



        $maxFileSize = SmGeneralSettings::first('file_size')->file_size;



        if (isset($request->available_for)) {

            foreach ($request->available_for as $value) {

                if ($value == 'student') {

                    if (!isset($request->all_classes)) {

                        $request->validate([

                            'content_title' => "required|max:200",

                            'content_type' => "required",

                            'upload_date' => "required",

                            'content_file' => "sometimes|required|mimes:pdf,doc,docx,jpg,jpeg,png,mp4,mp3,txt",

                            'class' => "required",

                            'section' => "required",

                        ]);
                    } else {

                        $request->validate([

                            'content_title' => "required|max:200",

                            'content_type' => "required",

                            'upload_date' => "required",

                            'content_file' => "sometimes|required|mimes:pdf,doc,docx,jpg,jpeg,png,mp4,mp3,txt",

                        ]);
                    }
                }
            }
        } else {

            $request->validate(

                [

                    'content_title' => "required:max:200",

                    'content_type' => "required",

                    'available_for' => 'required|array',

                    'upload_date' => "required",

                    'content_file' => "sometimes|required|mimes:pdf,doc,docx,jpg,jpeg,png,mp4,mp3",

                ],

                [

                    'available_for.required' => 'At least one checkbox required!',

                ]

            );
        }

        try {

            $fileName = "";

            $imagemimes = ['image/png'];

            $videomimes = ['video/mp4'];

            $audiomimes = ['audio/mp3'];



            $maxFileSize = SmGeneralSettings::first('file_size')->file_size;

            $file = $request->file('content_file');

            $fileSize =  filesize($file);

            $fileSizeKb = ($fileSize / 1000000);

            if ($fileSizeKb >= $maxFileSize) {

                Toastr::error('Max upload file size ' . $maxFileSize . ' Mb is set in system', 'Failed');

                return redirect()->back();
            }









            if (($request->file('content_file') != "")  && (in_array($file->getMimeType(), $videomimes))) {

                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

                $file->move('public/uploads/upload_contents/', $fileName);

                $fileName = 'public/uploads/upload_contents/' . $fileName;
            } elseif ($file != "") {

                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

                $file->move('public/uploads/upload_contents/', $fileName);

                $fileName = 'public/uploads/upload_contents/' . $fileName;
            }



            $y = '2012';

            $m = '2012';

            $d = '2012';

            $uploadContents = SmTeacherUploadContent::where('id', $request->id)->first();

            $uploadContents->content_title = $request->content_title;

            $uploadContents->content_type = $request->content_type;

            $uploadContents->school_id = Auth::user()->school_id;

            $uploadContents->academic_id = getAcademicId();



            if (in_array('admin', $request->available_for)) {

                $uploadContents->available_for_admin = 1;
            } else {

                $uploadContents->available_for_admin = null;
            }



            if (in_array('student', $request->available_for)) {

                if (isset($request->all_classes)) {

                    $uploadContents->available_for_all_classes = 1;

                    $remove_cls_sec = SmTeacherUploadContent::where('id', $request->id)->first();

                    $remove_cls_sec->class = null;

                    $remove_cls_sec->section = null;

                    $remove_cls_sec->save();
                } else {

                    $remove_all_cls = SmTeacherUploadContent::where('id', $request->id)->first();

                    $remove_all_cls->available_for_all_classes = null;

                    $remove_all_cls->save();



                    $uploadContents->class = $request->class;

                    $uploadContents->section = $request->section;
                }
            } else {

                $uploadContents->class = null;

                $uploadContents->section = null;

                $uploadContents->available_for_all_classes = null;
            }



            // foreach ($request->available_for as $value) {

            //     if ($value == 'admin') {



            //         $uploadContents->available_for_admin = 1;



            //     }else{

            //         $uploadContents->available_for_admin = null;

            //     }



            //     if ($value == 'student') {

            //         if (isset($request->all_classes)) {

            //             $uploadContents->available_for_all_classes = 1;

            //             $remove_cls_sec = SmTeacherUploadContent::where('id',$request->id)->first();

            //             $remove_cls_sec->class = null;

            //             $remove_cls_sec->section = null;

            //             $remove_cls_sec->save();



            //         } else {

            //             $remove_all_cls = SmTeacherUploadContent::where('id',$request->id)->first();

            //             $remove_all_cls->available_for_all_classes = null;

            //             $remove_all_cls->save();



            //             $uploadContents->class = $request->class;

            //             $uploadContents->section = $request->section;

            //         }

            //     }else {

            //         $uploadContents->class = null;

            //         $uploadContents->section = null;

            //         $uploadContents->available_for_all_classes = null;

            //     }

            // }



            $uploadContents->upload_date = date('Y-m-d', strtotime($request->upload_date));

            $uploadContents->description = $request->description;

            $uploadContents->source_url = $request->source_url;

            if ($request->file('content_file') != "") {

                $uploadContents->upload_file = $fileName;
            }



            $uploadContents->created_by = Auth()->user()->id;

            // $uploadContents->created_at = '2012-11-26 13:04:39';

            $results = $uploadContents->save();

            // return  $results;



            if ($request->content_type == 'as') {

                $purpose = 'assignment';
            } elseif ($request->content_type == 'st') {

                $purpose = 'Study Material';
            } elseif ($request->content_type == 'sy') {

                $purpose = 'Syllabus';
            } elseif ($request->content_type == 'ot') {

                $purpose = 'Others Download';
            }



            foreach ($request->available_for as $value) {

                if ($value == 'admin') {

                    $roles = InfixRole::where('id', '=', 1) /* ->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 9) */->where(function ($q) {

                        $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
                    })->get();

                    foreach ($roles as $role) {

                        $staffs = SmStaff::where('role_id', $role->id)->where('school_id', Auth::user()->school_id)->get();

                        foreach ($staffs as $staff) {

                            $notification = new SmNotification;

                            $notification->user_id = $staff->user_id;

                            $notification->role_id = $role->id;

                            $notification->school_id = Auth::user()->school_id;

                            $notification->academic_id = getAcademicId();

                            if ($request->content_type == 'as') {

                                $notification->url = 'assignment-list';
                            } elseif ($request->content_type == 'st') {

                                $notification->url = 'study-metarial-list';
                            } elseif ($request->content_type == 'sy') {

                                $notification->url = 'syllabus-list';
                            } elseif ($request->content_type == 'ot') {

                                $notification->url = 'other-download-list';
                            }

                            $notification->date = date('Y-m-d');

                            $notification->message = $purpose . ' updated';

                            $notification->save();



                            $user = User::find($notification->user_id);

                            Notification::send($user, new StudyMeterialCreatedNotification($notification));
                        }
                    }
                }

                if ($value == 'student') {

                    if (isset($request->all_classes)) {

                        $students = SmStudent::select('id', 'user_id')->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();

                        foreach ($students as $student) {

                            $notification = new SmNotification;

                            $notification->user_id = $student->id;

                            $notification->role_id = 2;

                            $notification->school_id = Auth::user()->school_id;

                            $notification->academic_id = getAcademicId();

                            if ($request->content_type == 'as') {

                                $notification->url = 'student-assignment';
                            } elseif ($request->content_type == 'st') {

                                $notification->url = 'student-study-material';
                            } elseif ($request->content_type == 'sy') {

                                $notification->url = 'student-syllabus';
                            } elseif ($request->content_type == 'ot') {

                                $notification->url = 'student-others-download';
                            }

                            $notification->date = date('Y-m-d');

                            $notification->message = $purpose . ' updated';

                            $notification->save();



                            $user = User::find($notification->user_id);

                            Notification::send($user, new StudyMeterialCreatedNotification($notification));
                        }
                    } else {

                        $students = SmStudent::select('id')->where('class_id', $request->class)->where('section_id', $request->section)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();

                        foreach ($students as $student) {

                            $notification = new SmNotification;

                            $notification->user_id = $student->id;

                            $notification->role_id = 2;

                            if ($request->content_type == 'as') {

                                $notification->url = 'student-assignment';
                            } elseif ($request->content_type == 'st') {

                                $notification->url = 'student-study-material';
                            } elseif ($request->content_type == 'sy') {

                                $notification->url = 'student-syllabus';
                            } elseif ($request->content_type == 'ot') {

                                $notification->url = 'student-others-download';
                            }

                            $notification->date = date('Y-m-d');

                            $notification->message = $purpose . ' updated';

                            $notification->school_id = Auth::user()->school_id;

                            $notification->academic_id = getAcademicId();

                            $notification->save();



                            $user = User::find($notification->user_id);

                            Notification::send($user, new StudyMeterialCreatedNotification($notification));
                        }
                    }
                }
            }



            if ($results) {

                Toastr::success('Update Operation successful', 'Success');

                return redirect()->route('upload-content');
            } else {

                Toastr::error('Operation Failed', 'Failed');

                return redirect()->back();
            }
        } catch (\Exception $e) {



            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
    }



    public function assignmentList(Request $request)

    {



        try {

            $user = Auth()->user();



            if (!teacherAccess()) {

                SmNotification::where('user_id', $user->id)->where('role_id', 1)->update(['is_read' => 1]);
            }



            if (!teacherAccess()) {



                $uploadContents = SmTeacherUploadContent::where('content_type', 'as')->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();
            } else {



                $uploadContents = SmTeacherUploadContent::where(function ($q) {

                    $q->where('created_by', Auth::user()->id)->orWhere('available_for_admin', 1);
                })->where('content_type', 'as')->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();
            }



            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                return ApiBaseMethod::sendResponse($uploadContents->toArray(), 'null');
            }



            return view('backEnd.teacher.assignmentList', compact('uploadContents'));
        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
    }



    public function studyMetarialList(Request $request)

    {

        try {

            if (teacherAccess()) {

                $uploadContents = SmTeacherUploadContent::where(function ($q) {

                    $q->where('created_by', Auth::user()->id)->orWhere('available_for_admin', 1);
                })->where('content_type', 'st')->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();
            } else {

                $uploadContents = SmTeacherUploadContent::where('content_type', 'st')

                    ->where('academic_id', getAcademicId())

                    ->where('school_id', Auth::user()->school_id)

                    ->get();
            }



            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                return ApiBaseMethod::sendResponse($uploadContents->toArray(), 'null');
            }

            return view('backEnd.teacher.studyMetarialList', compact('uploadContents'));
        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
    }



    public function syllabusList(Request $request)

    {

        try {

            if (teacherAccess()) {

                $uploadContents = SmTeacherUploadContent::where(function ($q) {

                    $q->where('created_by', Auth::user()->id)->orWhere('available_for_admin', 1);
                })->where('content_type', 'sy')->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();
            } else {

                $uploadContents = SmTeacherUploadContent::where('content_type', 'sy')

                    ->where('academic_id', getAcademicId())

                    ->where('school_id', Auth::user()->school_id)

                    ->get();
            }



            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                return ApiBaseMethod::sendResponse($uploadContents->toArray(), 'null');
            }

            return view('backEnd.teacher.syllabusList', compact('uploadContents'));
        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
    }



    public function otherDownloadList(Request $request)

    {



        try {

            if (teacherAccess()) {

                $uploadContents = SmTeacherUploadContent::where(function ($q) {

                    $q->where('created_by', Auth::user()->id)->orWhere('available_for_admin', 1);
                })->where('content_type', 'ot')->Where('created_by', Auth::user()->id)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();
            } else {

                $uploadContents = SmTeacherUploadContent::where('content_type', 'ot')

                    ->where('academic_id', getAcademicId())

                    ->where('school_id', Auth::user()->school_id)

                    ->get();
            }



            if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                return ApiBaseMethod::sendResponse($uploadContents->toArray(), 'null');
            }

            return view('backEnd.teacher.otherDownloadList', compact('uploadContents'));
        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
    }



    public function deleteUploadContent(Request $request)

    {

        try {

            $id =  $request->id;

            if (checkAdmin()) {

                $uploadContent = SmTeacherUploadContent::find($id);
            } else {

                $uploadContent = SmTeacherUploadContent::where('id', $id)->where('school_id', Auth::user()->school_id)->first();
            }





            if (checkAdmin() || $uploadContent->created_by == Auth::user()->id) {

                if ($uploadContent->upload_file != "") {

                    unlink($uploadContent->upload_file);
                }

                $result = $uploadContent->delete();



                if (ApiBaseMethod::checkUrl($request->fullUrl())) {

                    if ($result) {

                        return ApiBaseMethod::sendResponse(null, 'Content has been deleted successfully.');
                    } else {

                        return ApiBaseMethod::sendError('Something went wrong, please try again.');
                    }
                } else {

                    if ($result) {

                        Toastr::success('Operation successful', 'Success');

                        return redirect()->back();
                    } else {

                        Toastr::error('Operation Failed', 'Failed');

                        return redirect()->back();
                    }
                }
            } else {

                Toastr::error('This Content is added by other. You Cannot DELETE', 'Failed');

                return redirect()->back();
            }
        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');

            return redirect()->back();
        }
    }
}
