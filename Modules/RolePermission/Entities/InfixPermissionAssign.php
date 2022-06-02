<?php

namespace Modules\RolePermission\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Modules\MenuManage\Entities\Sidebar;
use Modules\MenuManage\Entities\MenuManage;
use Modules\RolePermission\Entities\InfixModuleInfo;

class InfixPermissionAssign extends Model
{
    protected $casts = [
        'saas_schools' => 'array'
    ];
    protected $fillable = [];

     public function menuName(){
        return $this->belongsTo('Modules\MenuManager\Entities\Sidebar','module_id','infix_module_id');
    }
    public static function childMenu($infix_module_id){
        $user=Auth::user();
        return InfixModuleInfo::where('parent_id',$infix_module_id)->where('active_status',1)->get();
    }
    public static function subMenu($infix_module_id){
        
        $check=InfixPermissionAssign::where('role_id',Auth::user()->role_id)->get('module_id');       
        $submenu=Sidebar::query();
            if (moduleStatusCheck('Zoom')== FALSE) {
                $submenu->where('module_id','!=',22);
            } 
            if (moduleStatusCheck('ParentRegistration')== FALSE) {
                $submenu->where('module_id','!=',21);
            } 
        
            if (moduleStatusCheck('Jitsi')== FALSE) {
                $submenu->where('module_id','!=',30);
            }
            if (moduleStatusCheck('Lesson')== FALSE) {
                $submenu->where('module_id','!=',29);
            }

            if (moduleStatusCheck('BBB')== FALSE) {
                $submenu->where('module_id','!=',33);
            } 
            $submenu= $submenu->whereIn('infix_module_id',$check)->where('parent_id',$infix_module_id)->where('active_status',1)->get();
            return $submenu;
      
    }
    public static function parentMenu($infix_module_id){
        $parentMenu=Sidebar::query();
        if (moduleStatusCheck('Zoom')== FALSE) {
            $parentMenu->where('module_id','!=',22);
        } 
        if (moduleStatusCheck('ParentRegistration')== FALSE) {
            $parentMenu->where('module_id','!=',21);
        } 
    
        if (moduleStatusCheck('Jitsi')== FALSE) {
            $parentMenu->where('module_id','!=',30);
        }
        if (moduleStatusCheck('Lesson')== FALSE) {
            $parentMenu->where('module_id','!=',29);
        }

        if (moduleStatusCheck('BBB')== FALSE) {
            $parentMenu->where('module_id','!=',33);
        } 
        $parentMenu=$parentMenu->where('infix_module_id',$infix_module_id)->where('parent_id',0)->where('active_status',1)->get();
        return $parentMenu;
    }
    public function childMenuName(){
       return $this->belongsTo('Modules\MenuManager\Entities\Sidebar','child_id','infix_module_id');
   }

    public function menuNameFirst(){
        return $this->belongsTo('Modules\RolePermission\Entities\InfixModuleInfo','module_id','id')->where('parent_id',0);
    }
        public static function childMenuFirst($id){
            $user=Auth::user();
            return InfixModuleInfo::where('parent_id',$id)->where('active_status',1)->get();
        }
}
