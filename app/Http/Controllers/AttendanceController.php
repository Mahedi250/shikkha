<?php

namespace App\Http\Controllers;

use App\SmStudent;
use App\SmStudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use BigBlueButton\Core\Attendee;

class AttendanceController extends Controller
{
    //__attendance list for students__//

    public function AllstudentAttendancetoday()
    {
        $bc = SmStudentAttendance::get()->toArray();
        $allstudent = SmStudent::with('attendances', 'class:id,class_name')->get()->toArray();
        //dd($allstudent);
        $studentdata = array_map(function ($std) {
            $att_type = "A";

            if (count($std['attendances']) > 0) {

                $att_type = $std['attendances'][0]['attendance_type'];
            }

            return ["Name" => $std['full_name'], "class" => $std['class']['class_name'], "attendance_type" => $att_type];
        }, $allstudent);




        return $studentdata;
    }


    public function StudentAttendance(Request $request)
    {
        if ($request->ajax()) {
            $attendances = '';
            $query = DB::table('sm_student_attendances')
                ->leftJoin('sm_students', 'sm_student_attendances.student_id', 'sm_students.id')
                ->leftJoin('sm_classes', 'sm_students.class_id', 'sm_classes.id');

            if ($request->student_id) {
                $query->where('sm_student_attendances.student_id', $request->student_id);
            }

            if ($request->attendance_date) {
                $query->where('sm_student_attendances.attendance_date', $request->attendance_date);
            }

            if ($request->month) {
                $query->whereMonth('sm_student_attendances.attendance_date', $request->month);
            }

            if ($request->class_id) {
                $query->where('sm_students.class_id', $request->class_id);
            }

            $attendances = $query->select(
                'sm_student_attendances.*',
                'sm_students.full_name',
                'sm_students.roll_no',
                'sm_students.student_photo',
                'sm_classes.class_name'
            )->where('sm_student_attendances.academic_id', getAcademicId())->where('sm_student_attendances.school_id', Auth::user()->school_id)->get();

            return DataTables::of($attendances)
                ->addColumn('action', function ($row) {
                    $html = '';
                    $html .= '<div class="dropdown table-dropdown">';
                    $html .= '<a href="#" class="btn btn-sm btn-primary mt-1">';
                    $html .= '<i class="fa fa-edit"></i> ';
                    $html .= '</a>';

                    $html .= '<a href="#" class="btn btn-sm btn-danger mt-1">';
                    $html .= '<i class="fa fa-trash"></i> ';
                    $html .= '</a>';
                    $html .= '</div>';
                    return $html;
                })
                ->editColumn('student_photo', function ($row) {
                    if ($row->student_photo !== Null) {
                        return '<img src="' . url('/') . '/' . $row->student_photo . '"  height="30" width="30" >';
                    } else {
                        return '<img src="' . url('/') . '/public/uploads/student/no_photo.jpg"  height="30" width="30" >';
                    }
                })
                ->editColumn('attendance_date', function ($row) {
                    return date('d-m-Y', strtotime($row->attendance_date));
                })
                ->editColumn('attendance_type', function ($row) {
                    if ($row->attendance_type == 'P') {
                        return '<span class="badge badge-success">Present</span>';
                    } elseif ($row->attendance_type == 'L') {
                        return '<span class="badge badge-warning">Late</span>';
                    } elseif ($row->attendance_type == 'A') {
                        return '<span class="badge badge-danger">Absent</span>';
                    } elseif ($row->attendance_type == 'H') {
                        return '<span class="badge badge-info">Holiday</span>';
                    }
                })
                ->rawColumns(['action', 'attendance_date', 'attendance_type', 'student_photo'])
                ->make(true);
        }

        $classes = DB::table('sm_classes')->where('active_status', 1)->get();
        $students = DB::table('sm_students')->get();

        return view('backEnd.attendance.student.student_attendance', compact('classes', 'students'));
    }

    //__attendance print__//
    public function StudentAttendancePrint(Request $request)
    {
        $attendances = '';
        $query = DB::table('sm_student_attendances')
            ->leftJoin('sm_students', 'sm_student_attendances.student_id', 'sm_students.id')
            ->leftJoin('sm_classes', 'sm_students.class_id', 'sm_classes.id');

        if ($request->student_id) {
            $query->where('sm_student_attendances.student_id', $request->student_id);
        }

        if ($request->attendance_date) {
            $query->where('sm_student_attendances.attendance_date', $request->attendance_date);
        }

        if ($request->month) {
            $query->whereMonth('sm_student_attendances.attendance_date', $request->month);
        }

        if ($request->class_id) {
            $query->where('sm_students.class_id', $request->class_id);
        }

        $attendances = $query->select(
            'sm_student_attendances.*',
            'sm_students.full_name',
            'sm_students.roll_no',
            'sm_students.student_photo',
            'sm_classes.class_name'
        )->where('sm_student_attendances.academic_id', getAcademicId())->where('sm_student_attendances.school_id', Auth::user()->school_id)->get();


        return view('backEnd.attendance.student.attendance_print', compact('attendances'));
    }

    //__Teacher attendance__//
    public function TeacherAttendance(Request $request)
    {
        if ($request->ajax()) {
            $attendances = '';
            $query = DB::table('sm_staff_attendences')
                ->leftJoin('sm_staffs', 'sm_staff_attendences.staff_id', 'sm_staffs.id');

            if ($request->staff_id) {
                $query->where('sm_staff_attendences.staff_id', $request->staff_id);
            }

            if ($request->attendence_date) {
                $query->where('sm_staff_attendences.attendence_date', $request->attendence_date);
            }

            if ($request->attendence_type) {
                $query->where('sm_staff_attendences.attendence_type', $request->attendence_type);
            }

            if ($request->month) {
                $query->whereMonth('sm_staff_attendences.attendence_date', $request->month);
            }


            $attendances = $query->select(
                'sm_staff_attendences.*',
                'sm_staffs.full_name',
                'sm_staffs.email',
                'sm_staffs.mobile'
            )->where('sm_staff_attendences.academic_id', getAcademicId())->where('sm_staff_attendences.school_id', Auth::user()->school_id)->orderBy('sm_staff_attendences.attendence_date', 'ASC')->get();

            return DataTables::of($attendances)
                ->addColumn('action', function ($row) {
                    $html = '';
                    $html .= '<div class="dropdown table-dropdown">';
                    $html .= '<a href="#" class="btn btn-sm btn-primary mt-1">';
                    $html .= '<i class="fa fa-edit"></i> ';
                    $html .= '</a>';

                    $html .= '<a href="#" class="btn btn-sm btn-danger mt-1">';
                    $html .= '<i class="fa fa-trash"></i> ';
                    $html .= '</a>';
                    $html .= '</div>';
                    return $html;
                })

                ->editColumn('attendence_date', function ($row) {
                    return date('d-m-Y', strtotime($row->attendence_date));
                })
                ->editColumn('attendence_type', function ($row) {
                    if ($row->attendence_type == 'P') {
                        return '<span class="badge badge-success">Present</span>';
                    } elseif ($row->attendence_type == 'L') {
                        return '<span class="badge badge-warning">Late</span>';
                    } elseif ($row->attendence_type == 'A') {
                        return '<span class="badge badge-danger">Absent</span>';
                    } elseif ($row->attendence_type == 'H') {
                        return '<span class="badge badge-info">Holiday</span>';
                    }
                })
                ->rawColumns(['action', 'attendence_date', 'attendence_type'])
                ->make(true);
        }

        $staffs = DB::table('sm_staffs')->get();

        return view('backEnd.attendance.teacher.teacher_attendance', compact('staffs'));
    }

    //__teacher staff attendance print__//
    public function TeacherAttendancePrint(Request $request)
    {
        $attendances = '';
        $query = DB::table('sm_staff_attendences')
            ->leftJoin('sm_staffs', 'sm_staff_attendences.staff_id', 'sm_staffs.id');

        if ($request->staff_id) {
            $query->where('sm_staff_attendences.staff_id', $request->staff_id);
        }

        if ($request->attendence_date) {
            $query->where('sm_staff_attendences.attendence_date', $request->attendence_date);
        }

        if ($request->attendence_type) {
            $query->where('sm_staff_attendences.attendence_type', $request->attendence_type);
        }

        if ($request->month) {
            $query->whereMonth('sm_staff_attendences.attendence_date', $request->month);
        }


        $attendances = $query->select(
            'sm_staff_attendences.*',
            'sm_staffs.full_name',
            'sm_staffs.email',
            'sm_staffs.mobile',
            'sm_staffs.date_of_joining',
        )->where('sm_staff_attendences.academic_id', getAcademicId())->where('sm_staff_attendences.school_id', Auth::user()->school_id)->orderBy('sm_staff_attendences.attendence_date', 'ASC')->get();

        return view('backEnd.attendance.teacher.attendance_print', compact('attendances'));
    }
}
