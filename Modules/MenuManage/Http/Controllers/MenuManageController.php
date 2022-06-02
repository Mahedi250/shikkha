<?php

namespace Modules\MenuManage\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Modules\MenuManage\Entities\Sidebar;
use Modules\MenuManage\Entities\UserMenu;
use Modules\MenuManage\Entities\MenuManage;
use Modules\RolePermission\Entities\InfixRole;
use Modules\RolePermission\Entities\InfixModuleInfo;
use Modules\RolePermission\Entities\InfixPermissionAssign;
use Modules\RolePermission\Entities\InfixModuleStudentParentInfo;


class MenuManageController extends Controller
{
   
    public function index()
    {
        $id = Auth::user()->role_id;
        $role = InfixRole::where('is_saas',0)->where('id',$id)->first();
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
                    // if(Auth::user()->role_id==1){
                    //     $all_modules->where('id','!=',193);
                    // }

        $all_modules =  $all_modules->where('module_id','!=',1)->where('is_saas',0)->where('active_status', 1)->get();
        
        $all_modules = $all_modules->groupBy('module_id');
        
     //new install module
        
        $menu_manage_module_id=MenuManage::where('active_status', 1)
                                        ->where('user_id',Auth::user()->id)
                                        ->where('role_id',Auth::user()->role_id)
                                        ->groupBy('module_id')
                                        ->orderBy('module_id', 'ASC')
                                        ->get('module_id');

       $infixModule=InfixModuleInfo::whereIn('id',$menu_manage_module_id)->groupby('module_id')->get(['module_id','id']);  
            
       $allInstallModule=InfixModuleInfo::query();
              if (moduleStatusCheck('Zoom')== FALSE) {
                  $allInstallModule->where('module_id','!=',22);
                } 
                if (moduleStatusCheck('ParentRegistration')== FALSE) {
                    $allInstallModule->where('module_id','!=',21);
                } 

                if (moduleStatusCheck('Jitsi')== FALSE) {
                    $allInstallModule->where('module_id','!=',30);
                }

                if (moduleStatusCheck('Lesson')== FALSE) {
                    $allInstallModule->where('module_id','!=',29);
                }

                if (moduleStatusCheck('BBB')== FALSE) {
             
                   $allInstallModule->where('module_id','!=',33);
                } 

                // if (moduleStatusCheck('Saas')== FALSE) {
                //     $allInstallModule->where('module_id','!=',24);
                // } 

           $allInstallModule=$allInstallModule->where('module_id','!=',1)->where('is_saas',0)->groupby('module_id')->get(['module_id','id']);

           $all_install_module=[]; 

            foreach($allInstallModule as $module_id){
                $all_install_module[]=$module_id->module_id;
           }

           $previous_module=[];

            foreach($infixModule as $module_id){
                $previous_module[]=$module_id->module_id;
           }

           
           $newIntalls=array_diff($all_install_module,$previous_module);
     
           
     //end new install module

      
        $all_menus=MenuManage::where('active_status', 1)
                            ->where('user_id',Auth::user()->id)
                            ->where('role_id',Auth::user()->role_id)
                            ->groupBy('parent_id')
                            ->orderBy('id', 'ASC')
                            ->get();

        
              

        $menus=count($all_menus);
        if($menus !=0){
            if(!is_null($newIntalls)){
                if(Auth::user()->role_id==1){
                      $newModules=InfixModuleInfo::whereIn('module_id',$newIntalls)->groupby('module_id')->where('active_status', 1)->get();

                    }else{
                        $pre_assing_module=MenuManage::where('active_status', 1)->where('user_id',Auth::user()->id)->where('role_id',Auth::user()->role_id)->groupBy('module_addons')->get('module_addons');
                        $check=InfixPermissionAssign::where('role_id',Auth::user()->role_id)->get('module_id');  
                        $moduel_id=InfixModuleInfo::whereIn('id',$check)->groupby('module_id')->where('module_id','!=',1)->where('is_saas',0)->where('active_status', 1)->get('module_id');
                        $newModules=InfixModuleInfo::whereNotIn('module_id',$pre_assing_module)->whereIn('module_id',$moduel_id)->groupby('module_id')->where('active_status', 1)->get();
                    
                    }
                }else{
                    $newModules=null;
                }
           } else{
               $newModules=null;
           }

        //    $newModules=null;
        $all_user_menus=UserMenu::where('active_status', 1)
                                ->where('user_id',Auth::user()->id)
                                ->where('role_id',Auth::user()->role_id)
                                ->orderBy('id', 'ASC')
                                ->get();

        if(count($all_user_menus)>0){

            $user_parent_assigned = [];
             foreach ($all_user_menus as $assign_module)
               {
                 $user_parent_assigned[] = $assign_module->parent_id;
               }

            $user_child_assigned = [];
              foreach ($all_user_menus as $assign_module)
                {
                  $user_child_assigned[] = $assign_module->module_id;
                }
                   
          }else{

            if($menus>0){     

                $user_assign_modules = MenuManage::where('user_id',Auth::user()->id)
                                                    ->where('role_id',Auth::user()->role_id)
                                                    ->orderBy('id', 'ASC')
                                                    ->get();

                $user_parent_assigned = [];
                    foreach ($user_assign_modules as $assign_module) {
                        $user_parent_assigned[] = $assign_module->parent_id;
                    }

                    $user_child_assigned = [];
                    foreach ($user_assign_modules as $assign_module) {
                        $user_child_assigned[] = $assign_module->child_id;
                    }
                }else{
                    $user_parent_assigned =null;
                    $user_child_assigned =null;

                }
         }
      
        $check_sidebar=Sidebar::first();
        $assign_modules = InfixPermissionAssign::where('school_id',Auth::user()->school_id)
                                                ->where('role_id', $id)                                            
                                                ->get();
        $already_assigned = [];
        foreach ($assign_modules as $assign_module) {
            $already_assigned[] = $assign_module->module_id;
        }
      
        if(Auth::user()->role_id==2 || Auth::user()->role_id==3){

            if(Auth::user()->role_id==2){
                $user_type=1;
            }elseif(Auth::user()->role_id==3){
                $user_type=2;
            }

            $module_ids=[2030,2022,2033];
            $check_exits=MenuManage::where('user_id', Auth::user()->id)
            ->where('role_id',Auth::user()->role_id)
            ->whereIn('module_addons',$module_ids)
            ->get('module_addons');
            if(is_null($check_exits)){
                $newModules=$check_exits;
            }else{
                $newModules=null;
            }

            $student_parent_menu=InfixModuleStudentParentInfo::query();
            if (moduleStatusCheck('Jitsi')== FALSE) {
                $student_parent_menu->where('module_id','!=',2030);
            }

            if (moduleStatusCheck('Zoom')== FALSE) {
                $student_parent_menu->where('module_id','!=',2022);
            }

            if (moduleStatusCheck('BBB')== FALSE) {
                $student_parent_menu->where('module_id','!=',2033);
            } 
            $student_parent_menu=$student_parent_menu->where('active_status',1)
                                                                ->groupby('module_id')
                                                                ->where('user_type',$user_type)
                                                                ->get();
          
        return view('menumanage::student_parent_sidebar',compact('check_sidebar','already_assigned','newModules','student_parent_menu','all_menus','user_parent_assigned','user_child_assigned','menus'));

        }
        return view('menumanage::index',compact('check_sidebar','newModules','all_modules','assign_modules','already_assigned','menus','user_parent_assigned','user_child_assigned','all_menus'));
    }


  
    public function store(Request $request)
    {
        try {
    
            $user= Auth::user();             
            MenuManage::where('user_id',$user->id)->where('role_id',$user->role_id)->delete();
            if ($request->all_menus) {     
            foreach ($request->all_menus as $key=>$module) {    
                
                $assign = new MenuManage();
                $assign->module_id = $module;
                if($user->role_id==2 || $user->role_id==3) {
                    $assign->parent_id = InfixModuleStudentParentInfo::where('module_id',$module)->where('parent_id',0)->first()->module_id ?? InfixModuleStudentParentInfo::where('id',$module)->first()->module_id;
                }else{
                    $assign->parent_id = InfixModuleInfo::find($module)->parent_id;
                }

                if($user->role_id==2 || $user->role_id==3) {
                    $assign->module_addons=InfixModuleStudentParentInfo::where('module_id',$module)->where('parent_id',0)->first()->module_id ?? InfixModuleStudentParentInfo::where('id',$module)->first()->module_id;
                }else{
                   $assign->module_addons=InfixModuleInfo::find($module)->module_id;
                }
                $assign->child_id=$module;
                $assign->role_id=$user->role_id;
                $assign->user_id=$user->id;
                $assign->parent_position_no=$module;
                $assign->active_status=1;                 
                $assign->save();
                }
            }
            if ($request->child_module_id) {
                    UserMenu::where('user_id',$user->id)->where('role_id',$user->role_id)->delete();
                foreach ($request->child_module_id as $key=>$child_module) {  
                    $userMenu=new UserMenu();
                    $userMenu->module_id = $child_module;
                    if($user->role_id==2 || $user->role_id==3) {
                         $userMenu->parent_id = InfixModuleStudentParentInfo::where('module_id',$child_module)->where('parent_id',0)->first()->module_id  ?? InfixModuleStudentParentInfo::where('id',$child_module)->first()->module_id;    
                    }else{
                         $userMenu->parent_id = InfixModuleInfo::find($child_module)->parent_id;
                    }
                    $userMenu->role_id=$user->role_id;
                    $userMenu->user_id=$user->id;
                    $userMenu->save();        
                }
            }     
            Toastr::success('Successfully Insert', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            Toastr::error('Operation Failed', 'Error');
            return redirect()->back();
        }
    }

    public function manage(){

        $id= Auth::user()->role_id;
        $role = InfixRole::where('is_saas',0)->where('id',$id)->first();
        $all_modules = InfixModuleInfo::where('is_saas',0)->where('active_status', 1)->get();       
        $all_modules = $all_modules->groupBy('module_id');    
        $all_sidebars=Sidebar::where('is_saas',0)->groupBy('module_id')->get();       
        return view('menumanage::all_sidebar_menu',compact('role','all_modules','all_sidebars'));
    }
    public function storeSidebar(Request $request){

         Sidebar::truncate();
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
            if (Auth::user()->role_id != 1) {
                $all_modules->where('module_id','!=',18);
            }


            $all_modules =  $all_modules->where('module_id','!=',1)->where('active_status', 1)
                            ->whereNotIn('name',['add','edit','delete','download','print','view'])
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
            if (Auth::user()->role_id != 1) {
                $all_modules->where('module_id','!=',18);
            }

             $all_modules = $all_modules->where('module_id','!=',1)->whereNotIn('name',['add','edit','delete','download','print','view'])
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
        Toastr::success('Successfully Insert', 'Success');
        return redirect()->back();

    }


    public function edit($id)
    {
             
        $role_id= Auth::user()->role_id;
        $role = InfixRole::where('is_saas',0)->where('id',$role_id)->first();
        $all_modules = InfixModuleInfo::where('is_saas',0)->where('active_status', 1)->get();       
        $all_modules = $all_modules->groupBy('module_id');
    
        $all_sidebars=Sidebar::where('is_saas',0)->groupBy('module_id')->get();
        $sidebar=Sidebar::find($id);
        return view('menumanage::edit_sidebar_menu',compact('all_modules','all_sidebars','sidebar'));
    }


    public function update(Request $request)
    {
        $name=strtolower(str_replace(' ','_',$request->name));     
        $sidebar =Sidebar::find($request->id);
        $sidebar->name=$request->name;
        $sidebar->lan_name=$name;
        $sidebar->icon_class =$request->icon_class;
        $sidebar->route=$request->route;        
        $sidebar->save();
        Toastr::success('Update Successfully', 'Success');
        return redirect()->route('menumanage.manage');
    }
    public function reset(){
        try {

            $user= Auth::user();             
            MenuManage::where('user_id',$user->id)->where('role_id',$user->role_id)->delete();
            UserMenu::where('user_id',$user->id)->where('role_id',$user->role_id)->delete();
            Toastr::success('Operation Successful', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


}
