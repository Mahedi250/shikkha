<?php

namespace App\Helpers;

use App\User;
use App\SmStaffAttendence;
use Exception;
use Illuminate\Support\Facades\Http;

class Attendance
{
    public static  function storeAttendance()
    {
        $url = trim("https://api-inovace360.com/api/v1/logs/");
        $token = env('ATTENDANCE_API_TOKEN');
        info("This is running from storeAttendance");
        try {
            $response = Http::get($url, ['start' => Date('y-m-d'), 'end' => Date('y-m-d'), 'api_token' => $token, 'per_page' => 100]);
            $attendances = json_decode($response, $associative = true);
            if (!array_key_exists('data', $attendances)) {
                throw new Exception('data Not Found');
            }
            $data = $attendances['data'];

            if (count($data) == 0) {
                throw new Exception('data Not Found');
            }
            $user_data = array_map(function ($item) {
                $test = User::where('username', $item['person_identifier'])->first();

                $role_id = $test ? $test->role_id : 0;
                return [
                    "username" => $item['person_identifier'],
                    "type" => $item['type'],
                    "date" => $item['sync_time'],
                    "role_id" => $role_id,
                ];
            }, $data);
            $ids = [];
            ///0 to 12 index username
            //dd($user_data);
            //define student data
            $student_ids = [];
            $teacher_ids = [];
            foreach ($user_data as  $value) {
                if ($value['role_id'] === 2) {
                    //if user is student
                    $first = User::with(['student'])->where('username', $value['username'])->first();
                    if (!$first) {
                        continue;
                    }
                    $id = $first->student->id;
                    $school_id = $first->student->class_id;
                    $section_id = $first->student->section_id;
                    $student_ids[] = ["student_id" => $id, "date" => $value['date'], "school_id" => $school_id, "section_id" => $section_id];
                } else {
                    //if user is teacher

                    $first = User::with(['staff'])->where('username', $value['username'])->first();
                    if (!$first) {
                        continue;
                    }

                    $id = $first->staff->id;
                    $school_id = $first->staff->school_id;

                    $teacher_ids[] = ["staff_id" => $id, "date" => $value['date'], "school_id" => $school_id,];
                }
            }
            //dd($teacher_ids, $student_ids);



            /*featching form machine and modified data */




            /*insert teacher data*/



            if (count($teacher_ids)) {

                foreach ($teacher_ids as $value) {
                    $istoday = SmStaffAttendence::where('staff_id', $value['staff_id'])->where('attendence_type', Date('y-m-d'))->first();

                    if (!$istoday) {
                        $time = date("H:i:s", strtotime($value['date']));
                        $att = new \App\SmStaffAttendence();
                        $att->attendence_type = "P";
                        $att->notes = "Entry time -" . $time;
                        $att->staff_id = $value['staff_id'];
                        $att->attendence_date = $value['date'];
                        //$att->school_id = $value['school_id'];
                        $att->save();
                    }
                }
            }

            /*end insert teacher data*/

            /*insert teacher student*/


            if (count($student_ids)) {


                foreach ($student_ids as $value) {
                    $istoday = \App\SmStudentAttendance::where('student_id', $value['student_id'])->whereDate('attendance_date', Date('y-m-d'))->first();

                    if (!$istoday) {
                        $time = date("H:i:s", strtotime($value['date']));
                        $att = new  \App\SmStudentAttendance();
                        $att->attendance_type = "P";
                        $att->notes = "Entry time -" . $time;
                        $att->student_id = $value['student_id'];
                        $att->attendance_date = $value['date'];
                        $att->school_id = $value['school_id'];
                        $att->save();
                    }
                }
            }
            /*insert teacher data end */






            info("Data inserted successfully");
            return ["status" => 1, "message" => "Data fetched"];
        } catch (\Exception $e) {

            return ["status" => 0, "message" => $e->getMessage()];
        }
    }
}
