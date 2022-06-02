@extends('backEnd.master')
@section('mainContent')
<link rel="stylesheet" href="{{asset('/Modules/RolePermission/public/css/style.css')}}">
<style type="text/css">
   .erp_role_permission_area {
   display: block !important;
   }
   .single_permission {
   margin-bottom: 0px;
   }
   .erp_role_permission_area .single_permission .permission_body > ul > li ul {
   display: inline-block;
   margin-left: 25px;
   grid-template-columns: repeat(3, 1fr);
   /* grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); */
   }
   .erp_role_permission_area .single_permission .permission_body > ul > li ul li {
   margin-right: 20px;
   }
   .mesonary_role_header{
   column-count: 2;
   column-gap: 30px;
   }
   .single_role_blocks {
   display: inline-block;
   background: #fff;
   box-sizing: border-box;
   width: 100%;
   margin: 0 0 5px;
   }
   .erp_role_permission_area .single_permission .permission_body > ul > li {
    padding: 14px 10px 0px 45px;
   }
   .erp_role_permission_area .single_permission .permission_header {
   padding: 20px 25px 11px 25px;
   position: relative;
   }
   @media (min-width: 320px) and (max-width: 1199.98px) { 
   .mesonary_role_header{
   column-count: 1;
   column-gap: 30px;
   }
   }
   @media (min-width: 320px) and (max-width: 767.98px) { 
   .erp_role_permission_area .single_permission .permission_body > ul > li ul {
   grid-template-columns: repeat(2, 1fr);
   grid-gap:10px
   /* grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); */
   }
   }
   .permission_header{
   position: relative;
   }
   .arrow::after {
   position: absolute;
   content: "\e622";
   top: 50%;
   right: 12px;
   height: auto;
   font-family: 'themify';
   color: #fff;
   font-size: 18px;
   -webkit-transform: translateY(-50%);
   -ms-transform: translateY(-50%);
   transform: translateY(-50%);
   right: 22px;
   }
   .arrow.collapsed::after {
   content: "\e61a";
   color: #fff;
   font-size: 18px;
   }
   .erp_role_permission_area .single_permission .permission_header div {
   position: relative;
   top: -5px;
   position: relative;
   z-index: 999;
   }
   .erp_role_permission_area .single_permission .permission_header div.arrow {
   position: absolute;
   width: 100%;
   z-index: 0;
   left: 0;
   bottom: 0;
   top: 0;
   right: 0;
   }
   .erp_role_permission_area .single_permission .permission_header div.arrow i{
   color:#FFF;
   font-size: 20px;
   }
   .row3{
      display:inline-block;
   }
</style>
@section('title')
@lang('lang.manage') @lang('lang.position')
@endsection
<section class="sms-breadcrumb mb-40 white-box">
   <div class="container-fluid">
      <div class="row justify-content-between">
         <h1>@lang('lang.menu') @lang('lang.manage')</h1>
         <div class="bc-pages">
            <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
            <a href="#">@lang('lang.menu') @lang('lang.manage')</a>
            <a href="#">@lang('lang.manage') @lang('lang.position')</a> 
         </div>
      </div>
   </div>
</section>
<div class="row">
   <div class="col-lg-10 col-xs-6 col-md-6 col-6 no-gutters ">
       <div class="main-title sm_mb_20 sm2_mb_20 md_mb_20 mb-30 ">
           <h3 class="mb-0"> @lang('lang.menu') @lang('lang.position')</h3>
       </div>
   </div>
   <div class="col-lg-2 col-xs-6 col-md-6 col-6 no-gutters ">
       <a href="{{route('menumanage.reset')}}" class="primary-btn fix-gr-bg small pull-right"> <i
                   class="ti-reload"> </i> @lang('lang.reset')</a>
   </div>
</div>

<div class="erp_role_permission_area ">
   {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' =>'menumanage.store.menu',
   'method' => 'POST']) }}
   <input type="hidden" name="role_id" value="{{@$role->id}}">
   <div  class="mesonary_role_header"  id="sortable" >
      @if(empty($menus))
       {{-- jodi menu position kora nah thake --}}
               @php
               $i=0;
               @endphp
               @foreach($all_modules as $key => $row)
                     @php                                  
                        if (moduleStatusCheck('SaasRolePermission') == TRUE) {
                           $module_info = Modules\RolePermission\Entities\InfixModuleInfo::where('module_id', $key)->first();
                           $all_group_modules = Modules\RolePermission\Entities\InfixModuleInfo::where('module_id', $key)->where('id', '!=', $key)->get();
                        } else {
                           $module_info = Modules\RolePermission\Entities\InfixModuleInfo::where('module_id', $key)->where('is_saas',0)->first();
                           $all_group_modules = Modules\RolePermission\Entities\InfixModuleInfo::where('module_id', $key)->where('id', '!=', $key)->where('is_saas',0)->get();
                        }
                     @endphp
                     @if(Auth::user()->role_id ==1)                                           
                           <div class="single_role_blocks" data-id="menu_org{{ $module_info->id }}">
                              <div class="single_permission" id="{{$module_info->id}}">
                                 <div class="permission_header d-flex align-items-center justify-content-between">
                                    <div>
                                          <input type="checkbox" name="module_id[]" value="{{$module_info->id}}" id="Main_Module_{{$key}}" class="common-radio permission-checkAll main_module_id_{{$module_info->id}}" @if($menus>0) {{in_array($module_info->id,$user_parent_assigned ?? '')? 'checked':''}} @else checked @endif >
                                       <label for="Main_Module_{{$key}}">{{$module_info->name}}</label>
                                    </div>
                                    <div class="arrow collapsed" data-toggle="collapse" data-target="#Role{{$module_info->id}}">
                                    </div>
                                 </div>
                                 <div id="Role{{$module_info->id}}" class="collapse">
                                    <div  class="permission_body">
                                       <ul class="submenuSort">
                                          <?php 
                                             $subModule= DB::table('infix_module_infos')->where('parent_id',$module_info->id)->where('id','!=',663)->where('id','!=',833)->where('id','!=',834)->where('id','!=',193)->where('active_status', 1)->get();
                                             ?>
                                          @foreach($subModule as $row2)
                                          <li>
                                             <div class="submodule">                         
                                                <input type="hidden" value="{{$row2->id}}" name="all_menus[]">
                                                @if(env('APP_SYNC')==TRUE)
                                                <input id="Sub_Module_{{$row2->id}}" name="child_module_id[]" value="{{$row2->id}}"  class="infix_csk common-radio  module_id_{{$module_info->id}} module_link"  type="checkbox" @if($menus>0) {{in_array($row2->id,$user_child_assigned ?? '')? 'checked':''}} @else checked  @endif>
                                                @else
                                                <input id="Sub_Module_{{$row2->id}}" name="child_module_id[]" value="{{$row2->id}}"  class="infix_csk common-radio  module_id_{{$module_info->id}} module_link"  type="checkbox" @if($menus>0) {{in_array($row2->id,$user_child_assigned ?? '')? 'checked':''}} @else checked  @endif>
                                                @endif
                                                <label for="Sub_Module_{{$row2->id}}">{{$row2->name}}</label>
                                                <br>
                                             </div>
                                             <?php                            
                                             $childModule= DB::table('infix_module_infos')->where('route','!=','')->where('parent_id',$row2->id)->where('active_status', 1)->get();
                                             ?>
                                             @if(count($childModule)>0)
                                                <ul class="option row3">
                                                
                                                   @foreach($childModule as $row3)
                                                      <li>
                                                         <div class="module_link_option_div" id="{{$row2->id}}">
                                                            <input type="hidden" value="{{$row3->id}}" name="child_module_id[]">
                                                               <input id="Option_{{$row3->id}}" name="module_id[]" value="{{$row3->id}}"  class="infix_csk common-radio module_id_{{$module_info->id}} module_option_{{$module_info->id}}_{{$row2->id}} module_link_option"  type="checkbox" @if($menus>0) {{in_array($row3->id,$user_child_assigned ?? '')? 'checked':''}} @else checked  @endif>
                                                               <label class="nowrap" for="Option_{{$row3->id}}">{{$row3->name}}</label>
                                                               <br>
                                                         </div>
                                                      </li>
                                                   @endforeach
                                             </ul>
                                          @endif
                                          </li>
                                       
                                          @endforeach
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                     @else
                        @if(in_array($module_info->id,$already_assigned))
                              <div class="single_role_blocks sort_menu " data-id="menu_org{{ $module_info->id }}">
                                 <div class="single_permission" id="{{$module_info->id}}">
                                    <div class="permission_header d-flex align-items-center justify-content-between">
                                       <div>
                                          <input type="checkbox" name="module_id[]" value="{{$module_info->id}}" id="Main_Module_{{$key}}" class="common-radio permission-checkAll main_module_id_{{$module_info->id}}" @if($menus>0) {{in_array($module_info->id,$user_parent_assigned ?? '')? 'checked':''}} @else  {{in_array($module_info->id,$already_assigned ?? '')? 'checked':''}} @endif>
                                          <label for="Main_Module_{{$key}}" class="handle">{{$module_info->name}}</label>
                                       </div>
                                       <div class="arrow collapsed" data-toggle="collapse" data-target="#Role{{$module_info->id}}">
                                       </div>
                                    </div>
                                    <div id="Role{{$module_info->id}}" class="collapse">
                                       <div  class="permission_body">
                                          <ul class="submenuSort">
                                             <?php 
                                                $subModule= DB::table('infix_module_infos')->where('parent_id',$module_info->id)->where('id','!=',663)->where('active_status', 1)->get();
                                                ?>
                                             @foreach($subModule as $row2)             
                                             @if(in_array($row2->id ,$already_assigned))
                                             <li>
                                                <div class="submodule">
                                                   <input type="hidden"  name="parent_module_id[]" value="{{$row2->parent_id}}">
                                                   <input type="hidden" value="{{$row2->id}}" name="all_menus[]">
                                                   <input id="Sub_Module_{{$row2->id}}" name="child_module_id[]" value="{{$row2->id}}"   class="infix_csk common-radio  module_id_{{$module_info->id}} module_link"   type="checkbox" @if($menus>0) {{in_array($row2->id,$user_child_assigned ?? '')? 'checked':''}} 
                                                   @else  {{in_array($row2->id ,$already_assigned ?? '')? 'checked':''}} 
                                                   @endif>
                                                   <label for="Sub_Module_{{$row2->id}}">{{$row2->name}}</label>
                                                   <br>
                                                </div>
                                             </li>
                                             @endif
                                             @endforeach
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                        @endif
                  @endif
               @endforeach
       {{-- jodi menu position kora nah thake --}}   
      @else
         @foreach($all_menus as $key=>$module)
            <div class="single_role_blocks" data-id="menu_org{{ $module->parent_id }}">
               <div class="single_permission" id="{{$module->parent_id}}">
                  <div class="permission_header d-flex align-items-center justify-content-between">
                     <div>
                        <input type="checkbox" name="module_id[]" value="{{$module->parent_id}}" id="Main_Module_{{$key}}" class="common-radio permission-checkAll main_module_id_{{$module->parent_id}}" @if($menus>0) {{in_array($module->parent_id,$user_parent_assigned ?? '')? 'checked':''}} @else checked @endif >
                        <label for="Main_Module_{{$key}}">{{@$module->menuName->name}}</label>
                     </div>
                     <div class="arrow collapsed" data-toggle="collapse" data-target="#Role{{$module->parent_id}}">
                     </div>
                  </div>
                  <div id="Role{{$module->parent_id}}" class="collapse">
                     <div  class="permission_body">
                        <ul class="submenuSort">
                           <?php 
                              $subModule= Modules\MenuManage\Entities\MenuManage::childMenu($module->parent_id);
                              ?>
                           @foreach($subModule as $key=>$row2)
                           <li>
                              <div class="submodule"> 
                                 <input type="hidden" value="{{$row2->module_id}}" name="all_menus[]">
                                 <input id="Sub_Module_{{$row2->module_id}}" name="child_module_id[]" value="{{$row2->module_id}}"  class="infix_csk common-radio  module_id_{{$module->parent_id}} module_link"  type="checkbox" @if($menus>0) {{in_array($row2->module_id,$user_child_assigned ?? '')? 'checked':''}} @else  {{in_array($row2->module_id ,$already_assigned ?? '')? 'checked':''}} @endif>
                                 <label for="Sub_Module_{{$row2->module_id}}">{{$row2->subModule->name}}</label>
                                 <br>
                              </div>
                           </li>
                           
                           @endforeach
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         @endforeach
      @endif  

      @if($newModules !=null)
         @foreach($newModules as $key => $row)
               @php                                  
                  if (moduleStatusCheck('SaasRolePermission') == TRUE) {
                     $module_info = Modules\RolePermission\Entities\InfixModuleInfo::where('module_id', $row->module_id)->first();
                     $all_group_modules = Modules\RolePermission\Entities\InfixModuleInfo::where('module_id', $key)->where('id', '!=', $key)->get();
                  } else {
                     $module_info = Modules\RolePermission\Entities\InfixModuleInfo::where('module_id', $row->module_id)->where('is_saas',0)->first();
                     $all_group_modules = Modules\RolePermission\Entities\InfixModuleInfo::where('module_id', $key)->where('id', '!=', $key)->where('is_saas',0)->get();
                  }
               @endphp
                                             
               <div class="single_role_blocks" data-id="menu_org{{ $module_info->id }}">
                  <div class="single_permission" id="{{$module_info->id}}">
                     <div class="permission_header d-flex align-items-center justify-content-between">
                        <div>
                           @if(env('APP_SYNC')==TRUE)
                              <input type="checkbox" name="module_id[]" title="Disable For Demo" data-toggle="tooltip" value="{{$module_info->id}}" id="Main_Module_{{$row->module_id}}" class="common-radio permission-checkAll main_module_id_{{$module_info->id}}" @if($menus>0) {{in_array($module_info->id,$user_parent_assigned ?? '')? 'checked':''}} @else checked @endif  disabled>
                              <span>Disable</span>
                              @else
                              <input type="checkbox" name="module_id[]" value="{{$module_info->id}}" id="Main_Module_{{$row->module_id+50}}" class="common-radio permission-checkAll main_module_id_{{$module_info->id+50}}" @if($menus>0) {{in_array($module_info->id,$user_parent_assigned ?? '')? 'checked':''}} @else checked @endif >
                           @endif
                           <label for="Main_Module_{{$row->module_id+50}}">{{$module_info->name}}</label>
                        </div>
                        <div class="arrow collapsed" data-toggle="collapse" data-target="#Role{{$module_info->id}}">
                        </div>
                     </div>
                     <div id="Role{{$module_info->id}}" class="collapse">
                        <div  class="permission_body">
                           <ul class="submenuSort">
                              <?php 
                                 $subModule= DB::table('infix_module_infos')->where('parent_id',$module_info->id)->where('id','!=',663)->where('id','!=',833)->where('id','!=',834)->where('id','!=',193)->where('active_status', 1)->get();
                                 ?>
                              @foreach($subModule as $row2)
                              <li>
                                 <div class="submodule">                         
                                    <input type="hidden" value="{{$row2->id}}" name="all_menus[]">
                                    @if(env('APP_SYNC')==TRUE)
                                    <input id="Sub_Module_{{$row2->id}}" name="child_module_id[]" value="{{$row2->id}}"  class="infix_csk common-radio  module_id_{{$module_info->id}} module_link"  type="checkbox" @if($menus>0) {{in_array($row2->id,$user_child_assigned ?? '')? 'checked':''}} @else checked  @endif>
                                    @else
                                    <input id="Sub_Module_{{$row2->id}}" name="child_module_id[]" value="{{$row2->id}}"  class="infix_csk common-radio  module_id_{{$module_info->id}} module_link"  type="checkbox" @if($menus>0) {{in_array($row2->id,$user_child_assigned ?? '')? 'checked':''}} @else checked  @endif>
                                    @endif
                                    <label for="Sub_Module_{{$row2->id}}">{{$row2->name}}</label>
                                    <br>
                                 </div>
                                 <?php                            
                                 $childModule= DB::table('infix_module_infos')->where('route','!=','')->where('parent_id',$row2->id)->where('active_status', 1)->get();
                                 ?>
                                 @if(count($childModule)>0)
                                    <ul class="option row3">
                                    
                                       @foreach($childModule as $row3)
                                          <li>
                                             <div class="module_link_option_div" id="{{$row2->id}}">
                                                <input type="hidden" value="{{$row3->id}}" name="child_module_id[]">
                                                   <input id="Option_{{$row3->id}}" name="module_id[]" value="{{$row3->id}}"  class="infix_csk common-radio module_id_{{$module_info->id}} module_option_{{$module_info->id}}_{{$row2->id}} module_link_option"  type="checkbox" @if($menus>0) {{in_array($row3->id,$user_child_assigned ?? '')? 'checked':''}} @else checked  @endif>
                                                   <label class="nowrap" for="Option_{{$row3->id}}">{{$row3->name}}</label>
                                                   <br>
                                             </div>
                                          </li>
                                       @endforeach
                                 </ul>
                              @endif
                              </li>
                           
                              @endforeach
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>

         @endforeach
      @endif
      
   </div>
   @if(!empty($check_sidebar))
   <div class="row mt-40">
      <div class="col-lg-12 text-center">
         @if(env('APP_SYNC')==TRUE)
            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> 
               <button class="primary-btn small fix-gr-bg  demo_view" style="pointer-events: none;" type="button" > 
                  @lang('lang.submit')
               </button>
            </span>
                           
         @else
            <button class="primary-btn fix-gr-bg">
               <span class="ti-check"></span>
                  @lang('submit')
            </button>
         @endif
      </div>
   </div>
   @endif
   {{ Form::close() }}
</div>
@endsection
@push('script')
<script type="text/javascript">
   $( function() {
         $( "#sortable" ).sortable();
         $( "#sortable" ).disableSelection();
   });
   
   $( function() {
         $( ".submenuSort" ).sortable();
     
   });
   $( function() {
         $( ".row3" ).sortable();
     
   });
   
</script> 
@endpush
@section('script')
<script type="text/javascript">
   $('.permission-checkAll').on('click', function () {
   
       //$('.module_id_'+$(this).val()).prop('checked', this.checked);
   
   
      if($(this).is(":checked")){
           $( '.module_id_'+$(this).val() ).each(function() {
             $(this).prop('checked', true);
           });
      }else{
           $( '.module_id_'+$(this).val() ).each(function() {
             $(this).prop('checked', false);
           });
      }
   });
   
   
   
   $('.module_link').on('click', function () {
   
      var module_id = $(this).parents('.single_permission').attr("id");
      var module_link_id = $(this).val();
   
   
      if($(this).is(":checked")){
           $(".module_option_"+module_id+'_'+module_link_id).prop('checked', true);
       }else{
           $(".module_option_"+module_id+'_'+module_link_id).prop('checked', false);
       }
   
      var checked = 0;
      $( '.module_id_'+module_id ).each(function() {
         if($(this).is(":checked")){
           checked++;
         }
       });
   
       if(checked > 0){
           $(".main_module_id_"+module_id).prop('checked', true);
       }else{
           $(".main_module_id_"+module_id).prop('checked', false);
       }
    });
   
   
   
   
   $('.module_link_option').on('click', function () {
   
      var module_id = $(this).parents('.single_permission').attr("id");
      var module_link = $(this).parents('.module_link_option_div').attr("id");
   
   
   
   
      // module link check
   
       var link_checked = 0;
   
      $( '.module_option_'+module_id+'_'+ module_link).each(function() {
         if($(this).is(":checked")){
           link_checked++;
         }
       });
   
       if(link_checked > 0){
           $("#Sub_Module_"+module_link).prop('checked', true);
       }else{
           $("#Sub_Module_"+module_link).prop('checked', false);
       }
   
      // module check
      var checked = 0;
   
      $( '.module_id_'+module_id ).each(function() {
         if($(this).is(":checked")){
           checked++;
         }
       });
   
   
       if(checked > 0){
           $(".main_module_id_"+module_id).prop('checked', true);
       }else{
           $(".main_module_id_"+module_id).prop('checked', false);
       }
    });
   
</script>
@endsection