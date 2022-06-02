<?php 
namespace App\Providers;
use App\SmStaff;
use App\SmStyle;
use App\SmParent;
use App\SmSchool;
use App\SmStudent;
use App\SmLanguage;
use App\SmsTemplate;
use App\SmCustomLink;
use App\SmDateFormat;
use App\SmAcademicYear;
use App\SmNotification;
use App\SmGeneralSettings;
use App\SmSocialMediaIcon;
use App\SmHeaderMenuManager;
use App\SmFrontendPersmission;
use Laravel\Passport\Passport;
use Spatie\Valuestore\Valuestore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
// use App\Providers\TelescopeServiceProvider;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use Modules\MenuManage\Entities\Sidebar;
use Modules\MenuManage\Entities\UserMenu;
use Modules\MenuManage\Entities\MenuManage;
use Modules\RolePermission\Entities\InfixRole;
use Modules\RolePermission\Entities\InfixPermissionAssign;
use Modules\ParentRegistration\Entities\SmRegistrationSetting;
use Modules\RolePermission\Entities\InfixModuleStudentParentInfo;


class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        try{
            Builder::defaultStringLength(191);
            view()->composer('backEnd.parentPanel.parent_dashboard', function ($view) {
                $data =[
                    'childrens' => SmParent::myChildrens(),
                ];
                $view->with($data);

            });


            view()->composer('backEnd.partials.parents_sidebar', function ($view) {

                $user=Auth::user();
                $parent_sidebar=UserMenu::where('active_status', 1)
                                        ->where('parent_id','!=',0)
                                        ->groupBy('parent_id')
                                        ->where('user_id',$user->id)
                                        ->where('role_id',$user->role_id)
                                        ->orderBy('id', 'ASC')
                                        ->get();
                if(count($parent_sidebar)>0){
                    $parent_sidebar=$parent_sidebar;

                    $data =[
                        'parent_sidebar' =>$parent_sidebar,
                        'childrens' => SmParent::myChildrens(),
                     ];
            
                 $view->with($data);
                }else{

                    $parent_pre_assigns=InfixModuleStudentParentInfo::query();
                    
                        if (moduleStatusCheck('Jitsi')== FALSE) {
                            $parent_pre_assigns->where('module_id','!=',2030);
                        }

                        if (moduleStatusCheck('Zoom')== FALSE) {
                            $parent_pre_assigns->where('module_id','!=',2022);
                        }

                        if (moduleStatusCheck('BBB')== FALSE) {
                            $parent_pre_assigns->where('module_id','!=',2033);
                        } 
                        
                    $parent_pre_assigns = $parent_pre_assigns->where('school_id',Auth::user()->school_id)                                                                    
                                                                        ->where('user_type',2)  
                                                                        ->groupBy('module_id')            
                                                                        ->get();

                    $parent_pre_assigns=$parent_pre_assigns;
                        $data =[
                            'parent_pre_assigns' =>$parent_pre_assigns,
                            'childrens' => SmParent::myChildrens(),
                        ];
            
                      $view->with($data);
                }
               

            });

            view()->composer('backEnd.partials.student_sidebar', function ($view) {

                    $user=Auth::user();
                    $student_sidebar=UserMenu::where('active_status', 1)->where('parent_id','!=',0)
                                                ->groupBy('parent_id')
                                                ->where('user_id',$user->id)
                                                ->where('role_id',$user->role_id)
                                                ->orderBy('id', 'ASC')
                                                ->get();
                    if(count($student_sidebar)>0){
                        $student_sidebar     = $student_sidebar;
                     $data =[
                        'student_sidebar'    => $student_sidebar,
                    ];
                    
                    $view->with($data);
                    }else{
                        $student_pre_assigns=InfixModuleStudentParentInfo::query();

                        if (moduleStatusCheck('Jitsi')== FALSE) {
                            $student_pre_assigns->where('module_id','!=',2030);
                        }

                        if (moduleStatusCheck('Zoom')== FALSE) {
                            $student_pre_assigns->where('module_id','!=',2022);
                        }

                        if (moduleStatusCheck('BBB')== FALSE) {
                            $student_pre_assigns->where('module_id','!=',2033);
                        } 
                        $student_pre_assigns = $student_pre_assigns->where('school_id',Auth::user()->school_id)                                                                                                 
                                                                        ->where('user_type',1)  
                                                                        ->groupBy('module_id')            
                                                                        ->get();
                        $student_pre_assigns     = $student_pre_assigns;
                      $data =[
                        'student_pre_assigns'    => $student_pre_assigns,
                                 ];
                    
                    $view->with($data);
                    }
                

            });


              view()->composer('backEnd.partials.sidebar', function ($view) {
                    $user=Auth::user();               
                    $menus=UserMenu::with('menuName','childMenuName')
                                        ->where('active_status', 1)
                                        ->groupBy('parent_id')
                                        ->where('user_id',$user->id)
                                        ->where('role_id',$user->role_id)
                                        ->orderBy('id', 'ASC')
                                        ->get();

                $check_sidebar=Sidebar::first();

                    if(!empty($check_sidebar)){
                            if(count($menus)>0){
                                        $data =[
                                            'sidebars' => $menus,                 
                                        ];
                            }elseif(Auth::user()->role_id==1){
                                        $super_admin = Auth::user()->role_id;
                                        $data =[
                                                'super_admin' => $super_admin,                 
                                            ];                 
                            }else{
                                    $assign_modules = InfixPermissionAssign::where('school_id',Auth::user()->school_id)
                                                                            ->where('module_id','!=',1)
                                                                            ->where('role_id',$user->role_id)
                                                                            ->where('role_id','!=',[2,3])
                                                                            ->get();
                                    $data =[
                                        'assign_menu' => $assign_modules,                 
                                    ];
                                }
        
                    }elseif(Auth::user()->role_id==1){
                        $super_admin = Auth::user()->role_id;
                        $data =[
                                'super_admin' => $super_admin,                 
                            ];
                      }else{
                        $pre_assign_modules = InfixPermissionAssign::where('school_id',Auth::user()->school_id)
                                                                ->where('module_id','!=',1)
                                                                ->where('role_id',$user->role_id)
                                                                ->where('role_id','!=',[2,3])
                                                                ->get();
                        $data =[
                            'pre_assign_menu' => $pre_assign_modules,                 
                        ];
                        }
                        $view->with($data);
                    
                });


            view()->composer('backEnd.partials.menu', function ($view) {
                $notifications = DB::table('notifications')->where('notifiable_id', auth()->id())
                    ->where('read_at', null)
                    ->get();

                foreach ($notifications as $notification){
                    $notification->data = json_decode($notification->data);
                }

                $view->with(['notifications_for_chat' => $notifications]);
            });

            view()->composer('backEnd.master', function ($view) {
                if (Schema::hasTable('sm_general_settings')) {
                    $data =[
                        'notifications' => SmNotification::notifications(),
                    ];
                    $view->with($data);
                }
            });



            view()->composer('frontEnd.home.front_master', function ($view) {
                if (Schema::hasTable('sm_general_settings')) {
                    $data =[
                        'social_permission' => SmFrontendPersmission::where('name','Social Icons')->where('parent_id', 1)->where('is_published', 1)->first(),
                        'menus' => SmHeaderMenuManager::where('parent_id',NULL)->orderBy('position')->get(),
                        'custom_link' => SmCustomLink::find(1),
                        'social_icons' => SmSocialMediaIcon::where('status', 1)->get(),
                    ];
                    $view->with($data);
                }
            });
        }
        catch(\Exception $e){
            return false;
        }
    }

    public function register()
    {
        $this->app->singleton('dashboard_bg', function () {
            $dashboard_background = DB::table('sm_background_settings')->where([['is_default', 1], ['title', 'Dashboard Background']])->first();
            return $dashboard_background;
        });

        $this->app->singleton('school_info', function () {
            $school_info = Auth::check() ? SmGeneralSettings::where('school_id', Auth::user()->school_id)->first() :
                DB::table('sm_general_settings')->where('school_id', 1)->first();
            return $school_info;
        });

        $this->app->singleton('permission', function () {
            $infixRole = InfixRole::find(Auth::user()->role_id);

            $module_links = [];
            if ($infixRole->is_saas == 1) {
                $permissions = InfixPermissionAssign::where('role_id', Auth::user()->role_id)->get(['id', 'module_id']);
            }
            if ($infixRole->is_saas == 0) {
                $permissions = InfixPermissionAssign::where('role_id', Auth::user()->role_id)->where('school_id', Auth::user()->school_id)->get(['id', 'module_id']);
            }
            foreach ($permissions as $permission) {
                $module_links[] = $permission->module_id;
            }
            //All user permission module id save in session
            $permission = $module_links;
            return $permission;
        });

        $this->app->singleton('general_settings', function() {
            return Valuestore::make((base_path().'/general_settings.json'));;
        });

    }
}