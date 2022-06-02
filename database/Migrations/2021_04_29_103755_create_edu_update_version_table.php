<?php
use App\SmPage;
use App\InfixModuleManager;
use App\SmHeaderMenuManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Modules\MenuManage\Entities\Sidebar;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\RolePermission\Entities\InfixModuleInfo;
use Modules\RolePermission\Entities\InfixPermissionAssign;

class CreateEduUpdateVersionTable extends Migration
{
    public function up()
    {
        try{
             //menu manager table add new colum
                $name ="module_addons";
                if (!Schema::hasColumn('menu_manages', $name)) {
                    Schema::table('menu_manages', function ($table) use ($name) {
                        $table->tinyInteger('module_addons')->nullable(); 
                    });
                }

            //user table has new colum 
                $name2 ="notificationToken"; 
                if (!Schema::hasColumn('users', $name2)) {
                    Schema::table('users', function ($table) use ($name2) {
                        $table->text($name2)->default(0);
                    });
                }

            //module manager has new column
                $name3 ="is_default"; 
                if (!Schema::hasColumn('infix_module_managers', $name3)) {
                    Schema::table('infix_module_managers', function ($table) use ($name3) {
                        $table->boolean($name3)->default(0);
                    });
                }

                $name4 ="addon_url"; 
                if (!Schema::hasColumn('infix_module_managers', $name4)) {
                    Schema::table('infix_module_managers', function ($table) use ($name4) {
                        $table->string($name4)->nullable();
                    });
                }

            //reset menu manager
                DB::table('menu_manages')->delete();
                DB::table('sidebars')->delete();
                DB::table('user_menus')->delete();

            //Add Sidebar
                if (moduleStatusCheck('SaasRolePermission') == true) {
                    $all_modules = InfixModuleInfo::query();

                    if (moduleStatusCheck('Zoom')== FALSE) {
                        $all_modules->where('module_id','!=',22);
                    } 
                    if (moduleStatusCheck('ParentRegistration')== FALSE) {
                        $all_modules->where('module_id','!=',21);
                    } 
                    if (moduleStatusCheck('Jitsi')== FALSE) {
                        $all_modules->where('module_id','!=',30);
                    }
                    if (moduleStatusCheck('Lesson')== FALSE) {
                        $all_modules->where('module_id','!=',29);
                    }
                    if (moduleStatusCheck('BBB')== FALSE) {
                        $all_modules->where('module_id','!=',33);
                    } 

                    $all_modules = $all_modules->where('module_id','!=',1)
                                    ->where('active_status', 1)
                                    ->whereNotIn('name',['add','edit','delete','download','print','view','Import Student'])
                                    ->get();    
                }else{
                    $all_modules = InfixModuleInfo::query();

                    if (moduleStatusCheck('Zoom')== FALSE) {
                        $all_modules->where('module_id','!=',22);
                    } 
                    if (moduleStatusCheck('ParentRegistration')== FALSE) {
                        $all_modules->where('module_id','!=',21);
                    } 
                    if (moduleStatusCheck('Jitsi')== FALSE) {
                        $all_modules->where('module_id','!=',30);
                    }
                    if (moduleStatusCheck('Lesson')== FALSE) {
                        $all_modules->where('module_id','!=',29);
                    }
                    if (moduleStatusCheck('BBB')== FALSE) {
                        $all_modules->where('module_id','!=',33);
                    } 

                    $all_modules = $all_modules->where('module_id','!=',1)
                                ->whereNotIn('name',['add','edit','delete','download','print','view','Import Student'])
                                ->where('is_saas',0)
                                ->get();  
                }     

                if ($all_modules) {
                    foreach ($all_modules as $key=>$module) {
                        $name=strtolower(str_replace(' ','_',$module->name));
                        $name=str_replace(['_Menu','_module','_Module','_menu'],'',$name);

                        $sidebar = new Sidebar();           
                        $sidebar->name=str_replace(['Menu','menu','module','Module'],'',$module->name);
                        $sidebar->icon_class=$module->icon_class;
                        $sidebar->lan_name=$module->lang_name;
                        $sidebar->module_id =$module->module_id;
                        $sidebar->parent_id =$module->parent_id;
                        $sidebar->infix_module_id=$module->id;
                        $sidebar->route=$module->route;        
                        $sidebar->save();
                    }
                }

            //Smheadermanager table update

                DB::table('sm_header_menu_managers')->delete();
                $old = SmHeaderMenuManager::all();

                if(!is_null($old)){
                    $store = new SmHeaderMenuManager();
                    $store->id = 1;
                    $store->type = 'sPages';
                    $store->element_id = 1;
                    $store->title = 'Home';
                    $store->link = '/';
                    $store->save();

                    $store = new SmHeaderMenuManager();
                    $store->id = 2;
                    $store->type = 'sPages';
                    $store->element_id = 2;
                    $store->title = 'About';
                    $store->link = '/about';
                    $store->save();

                    $store = new SmHeaderMenuManager();
                    $store->id = 3;
                    $store->type = 'sPages';
                    $store->element_id = 3;
                    $store->title = 'Course';
                    $store->link = '/course';
                    $store->save();

                    $store = new SmHeaderMenuManager();
                    $store->id = 4;
                    $store->type = 'sPages';
                    $store->element_id = 4;
                    $store->title = 'News';
                    $store->link = '/news-page';
                    $store->save();

                    $store = new SmHeaderMenuManager();
                    $store->id = 5;
                    $store->type = 'sPages';
                    $store->element_id = 5;
                    $store->title = 'Contact';
                    $store->link = '/contact';
                    $store->save();

                    $store = new SmHeaderMenuManager();
                    $store->id = 6;
                    $store->type = 'sPages';
                    $store->element_id = 6;
                    $store->title = 'Login';
                    $store->link = '/login';
                    $store->save();
                }
               

            // Update Static Page
                 $smPage = SmPage::find(6);
                    if(!$smPage){
                        $store = new SmPage();
                        $store->id = 6;
                        $store->title = 'Login';
                        $store->slug = '/login';
                        $store->active_status = 1;
                        $store->is_dynamic = 0;
                        $store->save();
                    }

            //infix_permission_assign_table
                //for Admins
                $admins = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 79, 80, 81, 82, 83, 84, 85, 86, 533, 534, 535, 536, 87, 88, 89, 90, 91, 92, 93, 94, 95, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 132, 133, 134, 135, 160, 161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 171, 172, 173, 174, 175, 176, 177, 178, 179, 180, 181, 182, 183, 184, 185, 186, 187, 188, 189, 190, 191, 192, 193, 194, 195, 196, 197, 198, 199, 200, 201, 202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 214, 215, 216, 217, 218, 219, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 239, 240, 241, 242, 243, 244, 245, 246, 247, 248, 249, 250, 251, 252, 253, 254, 255, 256, 257, 258, 259, 260, 261, 262, 263, 264, 265, 266, 267, 268, 269, 270, 271, 272, 273, 274, 275, 276, 537, 286, 287, 288, 289, 290, 291, 292, 293, 294, 295, 296, 297, 298, 299, 300, 301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313, 314, 315, 316, 317, 318, 319, 320, 321, 322, 323, 324, 325, 326, 327, 328, 329, 330, 331, 332, 333, 334, 335, 336, 337, 338, 339, 340, 341, 342, 343, 344, 345, 346, 347, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 358, 359, 360, 361, 362, 363, 364, 365, 366, 367, 368, 369, 370, 371, 372, 373, 374, 375, 376, 377, 378, 379, 380, 381, 382, 383, 384, 385, 386, 387, 388, 389, 390, 391, 392, 394, 395, 396, 397, 538, 539, 540, 485, 486, 487, 488, 489, 490, 491,553,577,900,901,902,903,904];

                foreach ($admins as $key => $value) {
                    $exist = InfixPermissionAssign::where('module_id',$value)->first();
                if(! is_null($exist)){
                    $permission = InfixPermissionAssign::where('module_id',$value)->first();
                }
                else{
                    $permission = new InfixPermissionAssign();
                }
                    $permission->module_id = $value;
                    $permission ->module_info = InfixModuleInfo::find($value)->name;
                    $permission->role_id = 5;
                    $permission->save();   
                }

                // for teacher
                $teachers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 79, 80, 81, 82, 83, 84, 85, 86, 533, 534, 535, 536, 87, 88, 89, 90, 91, 92, 93, 94, 95, 100, 101, 102, 103, 104, 105, 106, 107, 160, 161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 171, 172, 173, 174, 175, 176, 177, 178, 179, 180, 181, 182, 183, 184, 185, 186, 187, 188, 189, 190, 191, 192, 193, 194, 195, 196, 197, 198, 199, 200, 201, 202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 214, 215, 216, 217, 218, 219, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 239, 240, 241, 242, 243, 244, 245, 246, 247, 248, 249, 250, 251, 252, 253, 254, 255, 256, 257, 258, 259, 260, 261, 262, 263, 264, 265, 266, 267, 268, 269, 270, 271, 272, 273, 274, 275, 276, 537, 286, 287, 288, 289, 290, 291, 292, 293, 294, 295, 296, 297, 298, 299, 300, 301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313, 314, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 358, 359, 360, 361, 362, 363, 364, 365, 366, 367, 368, 369, 370, 371, 372, 373, 374, 375, 277, 278, 279, 280, 281, 282, 283, 284, 285,553,802,811,815,833,834,900,901,902,903,904];

                foreach ($teachers as $key => $value) {
                    $exist = InfixPermissionAssign::where('module_id',$value)->first();
                    if(! is_null($exist)){
                        $permission = InfixPermissionAssign::where('module_id',$value)->first();
                    }
                    else{
                        $permission = new InfixPermissionAssign();
                    }
                    $permission->module_id = $value;
                    $permission ->module_info = InfixModuleInfo::find($value)->name;
                    $permission->role_id = 4;
                    $permission->save();
                }

                // for receiptionists
                $receiptionists = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 64, 65, 66, 67, 83, 84, 85, 86, 160, 161, 162, 163, 164, 188, 193, 194, 195, 376, 377, 378, 379, 380,553, 900,901,902,903,904];
                foreach ($receiptionists as $key => $value) {
                    $exist = InfixPermissionAssign::where('module_id',$value)->first();
                    if(! is_null($exist)){
                        $permission = InfixPermissionAssign::where('module_id',$value)->first();
                    }
                    else{
                        $permission = new InfixPermissionAssign();
                    }

                    $permission->module_id = $value;
                    $permission ->module_info = InfixModuleInfo::find($value)->name;
                    $permission->role_id = 7;
                    $permission->save();
                }

                // for librarians
                $librarians = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 61, 64, 65, 66, 67, 83, 84, 85, 86, 160, 161, 162, 163, 164, 188, 193, 194, 195, 298, 299, 300, 301, 302, 303, 304, 305, 306, 307, 308, 309, 310, 311, 312, 313, 314, 376, 377, 378, 379, 380,553,900,901,902,903,904];
                foreach ($librarians as $key => $value) {
                    $exist = InfixPermissionAssign::where('module_id',$value)->first();
                if(! is_null($exist)){
                    $permission = InfixPermissionAssign::where('module_id',$value)->first();
                }
                else{
                    $permission = new InfixPermissionAssign();
                }
                    $permission->module_id = $value;
                    $permission ->module_info = InfixModuleInfo::find($value)->name;
                    $permission->role_id = 8;
                    $permission->save();
                }

                // for drivers
                $drivers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 188, 193, 194, 19,553,900,901,902,903,904];
                foreach ($drivers as $key => $value) {
                    $exist = InfixPermissionAssign::where('module_id',$value)->first();
                    if(! is_null($exist)){
                        $permission = InfixPermissionAssign::where('module_id',$value)->first();
                    }
                    else{
                        $permission = new InfixPermissionAssign();
                    }
                    $permission->module_id = $value;
                    $permission ->module_info = InfixModuleInfo::find($value)->name;
                    $permission->role_id = 9;
                    $permission->save();
                }

                // for accountants
                $accountants = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 64, 65, 66, 67, 68, 69, 70, 83, 84, 85, 86, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 132, 133, 134, 135, 160, 161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 171, 172, 173, 174, 175, 176, 177, 178, 179, 188, 193, 194, 195, 376, 377, 378, 379, 380, 381, 382, 383,553,900,901,902,903,904];

                foreach ($accountants as $key => $value) {
                    $exist = InfixPermissionAssign::where('module_id',$value)->first();
                    if(! is_null($exist)){
                        $permission = InfixPermissionAssign::where('module_id',$value)->first();
                    }
                    else{
                        $permission = new InfixPermissionAssign();
                    }
                    $permission->module_id = $value;
                    $permission ->module_info = InfixModuleInfo::find($value)->name;
                    $permission->role_id = 6;
                    $permission->save();
                }

                // student
                for ($j = 1; $j <= 55; $j++) {
                    $exist = InfixPermissionAssign::where('module_id',$value)->first();
                    if(! is_null($exist)){
                        $permission = InfixPermissionAssign::where('module_id',$value)->first();
                    }
                    else{
                        $permission = new InfixPermissionAssign();
                    }
                    $permission->module_id = $j;
                    $permission ->module_info = InfixModuleInfo::find($value)->name;
                    $permission->role_id = 2;
                    $permission->save();
                }

                //  Student for Chat Module
                $students = [900,901,902,903,904];
                foreach ($students as $key => $value) {
                    $exist = InfixPermissionAssign::where('module_id',$value)->first();
                    if(! is_null($exist)){
                        $permission = InfixPermissionAssign::where('module_id',$value)->first();
                    }
                    else{
                        $permission = new InfixPermissionAssign();
                    }
                    $permission->module_id = $value;
                    $permission ->module_info = InfixModuleInfo::find($value)->name;
                    $permission->role_id = 2;
                    $permission->save();
                }

                $students = [800,810,815];
                    foreach ($students as $key => $value) {
                    $exist = InfixPermissionAssign::where('module_id',$value)->first();
                    if(! is_null($exist)){
                        $permission = InfixPermissionAssign::where('module_id',$value)->first();
                    }
                    else{
                        $permission = new InfixPermissionAssign();
                    }
                    $permission->module_id = $value;
                    $permission ->module_info = @InfixModuleInfo::find($value)->name;
                    $permission->role_id = 2;
                    $permission->save();
                }

                // parent
                for ($j = 56; $j <= 99; $j++) {
                    $exist = InfixPermissionAssign::where('module_id',$value)->first();
                    if(! is_null($exist)){
                        $permission = InfixPermissionAssign::where('module_id',$value)->first();
                    }
                    else{
                        $permission = new InfixPermissionAssign();
                    }
                    $permission->module_id = $j;
                    $permission ->module_info = @InfixModuleInfo::find($value)->name;
                    $permission->role_id = 3;
                    $permission->save();
                }

                // Parent for Chat Module
                $parents = [910,911,912,913,914];
                foreach ($parents as $key => $value) {
                    $exist = InfixPermissionAssign::where('module_id',$value)->first();
                    if(! is_null($exist)){
                        $permission = InfixPermissionAssign::where('module_id',$value)->first();
                    }
                    else{
                        $permission = new InfixPermissionAssign();
                    }
                    $permission->module_id = $value;
                    $permission ->module_info = @InfixModuleInfo::find($value)->name;
                    $permission->role_id = 3;
                    $permission->save();
                }

            // update module_student_parent_info table
                DB::table('infix_module_student_parent_infos')->delete();

                $sql = "INSERT INTO `infix_module_student_parent_infos` (`id`, `module_id`, `parent_id`, `type`, `user_type`, `name`, `route`, `lang_name`, `icon_class`, `active_status`, `created_by`, `updated_by`, `school_id`, `created_at`, `updated_at`) VALUES
                
                -- student Dashboard
                (1, 1, 0, '1', 1, 'Dashboard Menu','student-dashboard','dashboard','flaticon-resume', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (2, 1, 1, '3', 1, 'Subject','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (3, 1, 1, '3', 1, 'Notice','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (4, 1, 1, '3', 1, 'Exam','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (5, 1, 1, '3', 1, 'Online Exam','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (6, 1, 1, '3', 1, 'Teachers','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (7, 1, 1, '3', 1, 'Issued books','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (8, 1, 1, '3', 1, 'Pending homeworks','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (9, 1, 1, '3', 1, 'attendance in current month','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (10, 1, 1, '3', 1, 'Calendar','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- student Profile
                (11, 2, 0, '1', 1, 'My Profile','student-profile','my_profile','flaticon-resume', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (12, 2, 11, '2', 1, 'Profile','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (13, 2, 11, '2', 1, 'Fees','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (14, 2, 11, '2', 1, 'Exam','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (15, 2, 11, '2', 1, 'Document','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (16, 2, 15, '3', 1, 'Upload','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (17, 2, 15, '3', 1, 'download','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (18, 2, 15, '3', 1, 'delete','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (19, 2, 11, '2', 1, 'Timeline','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Fees
                (20, 3, 0, '1', 1, 'Fees','','fees','flaticon-wallet', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (21, 3, 20, '2', 1, 'Pay Fees','student-fees','pay_fees','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Class Routine
                (22, 4, 0, '1', 1, 'Class Routine','student-class-routine','class_routine','flaticon-calendar-1', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Homework List
                (23, 5, 0, '1', 1, 'Homework List','student-homework','home_work','flaticon-book', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (24, 5, 23, '2', 1, 'View','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (25, 5, 23, '2', 1, 'Add Content','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Download Center
                (26, 6, 0, '1', 1, 'Download Center','','download_center','flaticon-data-storage', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (27, 6, 26, '2', 1, 'Assignment','student-assignment','assignment','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (28, 6, 27, '3', 1, 'Download','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                -- (29, 6, 26, '2', 1, 'Study Material','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                -- (30, 6, 29, '3', 1, 'Download','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (31, 6, 26, '2', 1, 'Syllabus','student-syllabus','syllabus','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (32, 6, 31, '3', 1, 'Download','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (33, 6, 26, '2', 1, 'Other Downloads','student-others-download','other_download','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (34, 6, 33, '3', 1, 'Download','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Attendance
                (35, 7, 0, '1', 1, 'Attendance','student-my-attendance','attendance','flaticon-authentication', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Examination
                (36, 8, 0, '1', 1, 'Examination','','examinations','flaticon-test', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (37, 8, 36, '2', 1, 'Result','student-result','result','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (38, 8, 36, '2', 1, 'Exam Schedule','student-exam-schedule','exam_schedule','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Leave
                (39, 9, 0, '1', 1, 'Leave','','leave','flaticon-slumber', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (40, 9, 39, '2', 1, 'Apply Leave','student-apply-leave','apply_leave','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (41, 9, 40, '3', 1, 'Save','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (42, 9, 40, '3', 1, 'Edit','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (44, 9, 39, '2', 1, 'Pending Leave','student-pending-leave','pending_leave_request','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Online Exam
                (45, 10, 0, '1', 1, 'Online Exam','','online_exam','flaticon-test-1', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (46, 10, 45, '2', 1, 'Active Exams','student-online-exam','active_exams','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (47, 10, 45, '2', 1, 'View Results','student_view_result','view_result','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Notice Board
                (48, 11, 0, '1', 1, 'Notice Board','student-noticeboard','notice_board','flaticon-poster', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Subject
                (49, 12, 0, '1', 1, 'Subject','student-subject','subjects','flaticon-reading-1', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Teachers List
                (50, 13, 0, '1', 1, 'Teachers List','student-teacher','student_teacher','flaticon-professor', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Library
                (51, 14, 0, '1', 1, 'Library','','library','flaticon-book-1', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (52, 14, 51, '2', 1, 'Book List','student-library','book_list','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (53, 14, 51, '2', 1, 'Book Issued','student-book-issue','book_issue','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Transport
                (54, 15, 0, '1', 1, 'Transport','student-transport','student_transport','flaticon-bus', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Dormitory
                (55, 16, 0, '1', 1, 'Dormitory','student-dormitory','dormitory','flaticon-hotel', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                
                -- lesson
                (800, 29, 0, '1', 1,'Lesson','','lesson','flaticon-calendar-1', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (810, 29, 800, '1', 1,'Lesson Plan','lesson/student/lessonPlan','lesson_plan','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (815, 29, 800, '1', 1,'Lesson Plan Overview','lesson/student/lessonPlan-overview','lesson_plan_overview','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                
                -- bbb
                (850, 2033, 0, '1', 1,'BigBlueButton','','bbb','flaticon-reading', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (851, 2033, 850, '2', 1,'Virtual Class','bbb/virtual-class','virtual_class','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),   
                (855, 2033, 851, '3', 1,'Start Class','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- zoom
                (554, 2022, 0, '1', 1,'Zoom','','zoom','flaticon-reading', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (555, 2022, 554, '2', 1,'Virtual Class','zoom/virtual-class','virtual_class','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),    
                (559, 2022, 555, '3', 1,'Start Class','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                
                -- jitsi
                (816, 2030, 0, '1', 1,'Jitsi','','jitsi','flaticon-reading', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (817, 2030, 816, '2', 1,'Virtual Class','jitsi/virtual-class','virtual_class','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),  
                (821, 2030, 817, '3', 1,'Start Class','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Chat
                (900, 31, 0, '1', 1,'Chat','','chat','flaticon-test',1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (901, 31, 900, '2', 1,'Chat Box','chat/open','chat_box','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (902, 31, 901, '3', 1,'New Chat','','','',1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (903, 31, 900, '2', 1,'Invitation','chat/invitation/index','invitation','',1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (904, 31, 900, '2', 1,'Blocked User','chat/users/blocked','blocked_user','',1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Dashboard
                (56, 1, 0, '1', 2, 'Dashboard Menu','parent-dashboard','dashboard','flaticon-resume', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (57, 1, 56, '3', 2, 'Subject','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (58, 1, 56, '3', 2, 'Notice','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (59, 1, 56, '3', 2, 'Exam','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (60, 1, 56, '3', 2, 'Online Exam','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (61, 1, 56, '3', 2, 'Teachers','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (62, 1, 56, '3', 2, 'Issued books','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (63, 1, 56, '3', 2, 'Pending homeworks','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (64, 1, 56, '3', 2, 'attendance in current month','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (65, 1, 56, '3', 2, 'Calendar','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Profile
                (66, 2, 0, '1', 2, 'My Children','my-children','my_children','flaticon-reading', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (67, 2, 66, '2', 2, 'Profile','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (68, 2, 66, '2', 2, 'Fees','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (69, 2, 66, '2', 2, 'Exam','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (70, 2, 66, '2', 2, 'Timeline','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Fees
                (71, 3, 0, '1', 2, 'Fees','parent-fees','fees','flaticon-wallet', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Class Routine
                (72, 4, 0, '1', 2, 'Class Routine','parent-class-routine','class_routine','flaticon-calendar-1', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent HomeWork
                (73, 5, 0, '1', 2, 'HomeWork ','parent-homework','home_work','flaticon-book', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (74, 5, 73, '3', 2, 'View','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Attendance
                (75, 6, 0, '1', 2, 'Attendance ','parent-attendance','attendance','flaticon-authentication', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Exam
                (76, 7, 0, '1', 2, 'Exam ','','exam','flaticon-test', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (77, 7, 76, '2', 2, 'Exam Result','parent-online-examination-result/{id}','online_exam_result','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (78, 7, 76, '2', 2, 'Exam Schedule','parent-examination-schedule','exam_schedule','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (79, 7, 76, '2', 2, 'Online Exam','parent-online-examination/{id}','online_exam','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Leave
                (80, 8, 0, '1', 2, 'Leave','parent-leave','leave','flaticon-test', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (81, 8, 80, '2', 2, 'Apply Leave','parent-apply-leave','apply_leave','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (82, 8, 81, '3', 2, 'Save','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (83, 8, 81, '3', 2, 'Edit','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (84, 8, 80, '2', 2, 'Pending Leave','parent-pending-leave','pending_leave_request','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Notice Board
                (85, 9, 0, '1', 2, 'Notice Board','parent-noticeboard','notice_board','flaticon-poster', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Subject
                (86, 10, 0, '1', 2, 'Subject','parent-subjects','subject','flaticon-reading-1', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Teachers List
                (87, 11, 0, '1', 2, 'Teachers List','parent-teacher-list','teacher_list','flaticon-professor', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Library
                (88, 12, 0, '1', 2, 'Library','','library','flaticon-book-1', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (89, 12, 88, '2', 2, 'Book List','parent-library','book_list','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (90, 12, 88, '2', 2, 'Book Issued','parent-book-issue','book_issue','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Transport
                (91, 13, 0, '1', 2, 'Transport','parent-transport','transport','flaticon-bus', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Dormitory
                (92, 14, 0, '1', 2, 'Dormitory','parent-dormitory','dormitory_list','flaticon-hotel', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Student Leave Missing
                (93, 9, 40, '3', 1, 'View','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (94, 9, 40, '3', 1, 'Delete','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- Parent Leave Missing
                (95, 8, 81, '3', 2, 'View','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (96, 8, 81, '3', 2, 'Delete','','','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- parent lesson
                (97, 29, 0, '1', 2,'Lesson','','lesson','flaticon-calendar-1', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (98, 29, 97, '1', 2,'Lesson Plan','lesson/parent/lessonPlan','lesson_plan','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (99, 29, 97, '1', 2,'Lesson Plan Overview','parent/lessonPlan-overview','lesson_plan_overview','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
        
                -- parent zoom
                (100, 2022, 0, '1',2,'Zoom','','zoom','flaticon-reading', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (101, 2022, 100, '2', 2,'Virtual Class','zoom/virtual-class','virtual_class','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),    
                (103, 2022, 100, '2', 2,'Virtual Meeting','zoom/meetings','virtual_meeting','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),

                -- parent bbb
                (105, 2033, 0, '1', 2,'BigBlueButton','','bbb','flaticon-reading', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (106, 2033, 105, '2', 2,'Virtual Class','bbb/virtual-class','virtual_class','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (107, 2033, 105, '2', 2,'Virtual Meeting','bbb/meetings','virtual_meeting','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
            
                -- parent jitsi
                (108, 2030, 0, '1', 2,'Jitsi','','jitsi','flaticon-reading', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (109, 2030, 108, '2', 2,'Virtual Class','jitsi/virtual-class','virtual_class','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (110, 2030, 108, '2', 2,'Virtual Meeting','jitsi/meetings','virtual_meeting','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),       
            
                -- Chat
                (910, 31, 0, '1', 2,'Chat','','chat','flaticon-test',1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (911, 31, 910, '2', 2,'Chat box','chat/open','chat_box','', 1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (912, 31, 911, '3', 2,'New Chat','','','',1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (913, 31, 910, '2', 2,'Invitation','chat/invitation/index','invitation','',1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22'),
                (914, 31, 910, '2', 2,'Blocked User','chat/users/blocked','blocked_user','',1, 1, 1, 1, '2019-07-25 02:21:21', '2019-07-25 04:24:22')
                ";
                DB::insert($sql);

            // infix_module_infos Update
                $update= InfixModuleInfo::find(542);
                $update->icon_class="flaticon-reading";
                $update->save();

                $update= InfixModuleInfo::find(543);
                $update->route="parentregistration.student-list";
                $update->save();

                $update= InfixModuleInfo::find(547);
                $update->route="parentregistration/settings";
                $update->save();

                $update= InfixModuleInfo::find(817);
                $update->route="jitsi.virtual-class";
                $update->save();

        
            //infix_module_manager_table Update
                DB::table('infix_module_managers')->delete();

                // RolePermission
                $dataPath = 'Modules/RolePermission/RolePermission.json';
                $name = 'RolePermission';
                $strJsonFileContents = file_get_contents($dataPath);
                $array = json_decode($strJsonFileContents, true);

                $version = $array[$name]['versions'][0];
                $url = $array[$name]['url'][0];
                $notes = $array[$name]['notes'][0];

                $s = new InfixModuleManager();
                $s->name = $name;
                $s->email = 'support@spondonit.com';
                $s->notes = $notes;
                $s->version = $version;
                $s->update_url = $url;
                $s->is_default = 1;
                $s->purchase_code = time();
                $s->installed_domain = url('/');
                $s->activated_date = date('Y-m-d');
                $s->save();

                //MenuManage
                $dataPath = 'Modules/MenuManage/MenuManage.json';
                $name = 'MenuManage';
                $strJsonFileContents = file_get_contents($dataPath);
                $array = json_decode($strJsonFileContents, true);

                $version = $array[$name]['versions'][0];
                $url = $array[$name]['url'][0];
                $notes = $array[$name]['notes'][0];

                $s = new InfixModuleManager();
                $s->name = $name;
                $s->is_default = 1;
                $s->email = 'support@spondonit.com';
                $s->notes = $notes;
                $s->version = $version;
                $s->update_url = $url;
                $s->purchase_code = time();
                $s->installed_domain = url('/');
                $s->activated_date = date('Y-m-d');
                $s->save();


                // Lesson Planner
                $dataPath = 'Modules/Lesson/Lesson.json';
                $name = 'Lesson';
                $strJsonFileContents = file_get_contents($dataPath);
                $array = json_decode($strJsonFileContents, true);

                $version = $array[$name]['versions'][0];
                $url = $array[$name]['url'][0];
                $notes = $array[$name]['notes'][0];

                $s = new InfixModuleManager();
                $s->name = $name;
                $s->email = 'support@spondonit.com';
                $s->notes = $notes;
                $s->is_default = 1;
                $s->version = $version;
                $s->update_url = $url;
                $s->purchase_code = time();
                $s->installed_domain = url('/');
                $s->activated_date = date('Y-m-d');
                $s->save();


                // Chat
                $dataPath = 'Modules/Chat/Chat.json';
                $name = 'Chat';
                $strJsonFileContents = file_get_contents($dataPath);
                $array = json_decode($strJsonFileContents, true);

                $version = $array[$name]['versions'][0];
                $url = $array[$name]['url'][0];
                $notes = $array[$name]['notes'][0];

                $s = new InfixModuleManager();
                $s->name = $name;
                $s->email = 'support@spondonit.com';
                $s->notes = $notes;
                $s->version = $version;
                $s->update_url = $url;
                $s->is_default = 1;
                $s->purchase_code = time();
                $s->installed_domain = url('/');
                $s->activated_date = date('Y-m-d');
                $s->save();


                // TemplateSettings
                $dataPath = 'Modules/TemplateSettings/TemplateSettings.json';
                $name = 'TemplateSettings';
                $strJsonFileContents = file_get_contents($dataPath);
                $array = json_decode($strJsonFileContents, true);

                $version = $array[$name]['versions'][0];
                $url = $array[$name]['url'][0];
                $notes = $array[$name]['notes'][0];

                $s = new InfixModuleManager();
                $s->name = $name;
                $s->email = 'support@spondonit.com';
                $s->notes = $notes;
                $s->version = $version;
                $s->update_url = $url;
                $s->is_default = 1;
                $s->purchase_code = time();
                $s->installed_domain = url('/');
                $s->activated_date = date('Y-m-d');
                $s->save();

                // Zoom
                $name = 'Zoom';
                $s = new InfixModuleManager();
                $s->name = $name;
                $s->email = 'support@spondonit.com';
                $s->notes = "This is Zoom module for live virtual class and meeting in this system at a time. Thanks for using.";
                $s->version = "1.0";
                $s->update_url = "https://spondonit.com/contact";
                $s->is_default = 0;
                $s->addon_url = "https://codecanyon.net/item/infixedu-zoom-live-class/27623128?s_rank=12";
                $s->installed_domain = url('/');
                $s->activated_date = date('Y-m-d');
                $s->save();

                // ParentRegistration
                $name = 'ParentRegistration';
                $s = new InfixModuleManager();
                $s->name = $name;
                $s->email = 'support@spondonit.com';
                $s->notes = "This is Parent Registration module for Registration. Thanks for using.";
                $s->version = "1.0";
                $s->update_url = "https://spondonit.com/contact";
                $s->is_default = 0;
                $s->addon_url = "https://codecanyon.net/item/parent-registration-or-student-registration-module-for-infixedu/27762693?s_rank=10";
                $s->installed_domain = url('/');
                $s->activated_date = date('Y-m-d');
                $s->save();

                // RazorPay
                $dataPath = 'Modules/RazorPay/RazorPay.json';
                $name = 'RazorPay';

                $s = new InfixModuleManager();
                $s->name = $name;
                $s->email = 'support@spondonit.com';
                $s->notes = "This is Razor Pay module for Online payemnt. Thanks for using.";
                $s->version = "1.0";
                $s->update_url = "https://spondonit.com/contact";
                $s->is_default = 0;
                $s->addon_url = "https://codecanyon.net/item/razorpay-payment-gateway-for-infixedu/27721206?s_rank=11";
                $s->installed_domain = url('/');
                $s->activated_date = date('Y-m-d');
                $s->save();

                // BigBlueButton
                $name = 'BBB';
                $s = new InfixModuleManager();
                $s->name = $name;
                $s->email = 'support@spondonit.com';
                $s->notes = "This is BigBlueButton module for live virtual class and meeting in this system at a time. Thanks for using.";
                $s->version = "1.0";
                $s->update_url = "https://spondonit.com/contact";
                $s->is_default = 0;
                $s->addon_url = "mailto:support@spondonit.com";
                $s->installed_domain = url('/');
                $s->activated_date = date('Y-m-d');
                $s->save();

                // Jitsi
                $name = 'Jitsi';
                $s = new InfixModuleManager();
                $s->name = $name;
                $s->email = 'support@spondonit.com';
                $s->notes = "This is Jitsi module for live virtual class and meeting in this system at a time. Thanks for using.";
                $s->version = "1.0";
                $s->update_url = "https://spondonit.com/contact";
                $s->is_default = 0;
                $s->addon_url = "mailto:support@spondonit.com";
                $s->installed_domain = url('/');
                $s->activated_date = date('Y-m-d');
                $s->save();

        }catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    
    public function down()
    {
        Schema::dropIfExists('update_version');
    }
}
