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
   display: grid;
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
   padding: 8px 10px 5px 50px;
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
    
      @if(Auth::user()->role_id==2 || Auth::user()->role_id==3) 
      @if(empty($menus))
          
    
         @foreach ($student_parent_menu as $key=>$student_parent_module)
              <?php 
                  $subModule=Modules\RolePermission\Entities\InfixModuleStudentParentInfo::studentMenu($student_parent_module->id);
                 ?>
             @if(in_array($student_parent_module->id,$already_assigned))                  
                <div class="single_role_blocks" data-id="menu_org{{ $student_parent_module->module_id }}">
                     <div class="single_permission" id="{{$student_parent_module->module_id}}">
                        <div class="permission_header d-flex align-items-center justify-content-between">
                           <div>
                              <input type="checkbox" name="child_module_id[]" value="{{$student_parent_module->module_id}}" 
                              id="Main_Module_{{$key}}" class="common-radio permission-checkAll main_module_id_{{$student_parent_module->module_id}}" {{in_array($student_parent_module->id,$already_assigned)? 'checked':''}}
                           
                              >
                              <input type="hidden" value="{{$student_parent_module->module_id}}" name="all_menus[]">
                              <label for="Main_Module_{{$key}}">{{$student_parent_module->name}}</label>
                           </div>
                           @if(count($subModule)>0)
                           <div class="arrow collapsed" data-toggle="collapse" data-target="#Role{{$student_parent_module->module_id}}">
                           </div>
                           @endif
                        </div>
                        <div id="Role{{$student_parent_module->module_id}}" class="collapse">
                           <div  class="permission_body">
                              <ul class="submenuSort">
                              
                                 @foreach($subModule as $key=>$row2)
                                 <li>
                                    <div class="submodule"> 
                                       <input type="hidden" value="{{$row2->id}}" name="all_menus[]">
                                       <input id="Sub_Module_{{$row2->id}}" name="child_module_id[]" value="{{$row2->id}}" 
                                       class="infix_csk common-radio  module_id_{{$student_parent_module->module_id}} module_link"  type="checkbox" 
                                       {{in_array($row2->id,$already_assigned)? 'checked':''}}
                                       >
                                       <label for="Sub_Module_{{$row2->id}}">{{$row2->name}}</label>
                                       <br>
                                    </div>
                                 </li>
                                 @endforeach
                              </ul>
                           </div>
                        </div>
                     </div>
                </div>
             @endif
         @endforeach
        
         @else
         @foreach($all_menus as $key=>$module)
         @php
         $studentParentMenu=Modules\MenuManage\Entities\UserMenu::studentParent($module->parent_id);
         $student_parent_submenu=Modules\MenuManage\Entities\MenuManage::childMenu($module->parent_id);                                            
         @endphp
         <div class="single_role_blocks" data-id="menu_org{{ $module->parent_id }}">
            <div class="single_permission" id="{{$module->parent_id}}">
               <div class="permission_header d-flex align-items-center justify-content-between">
                  <div>
                     <input type="hidden" value="{{$module->parent_id}}" name="all_menus[]">

                     <input type="checkbox" name="child_module_id[]" value="{{$module->parent_id}}" id="Main_Module_{{$key}}" class="common-radio permission-checkAll main_module_id_{{$module->parent_id}}"
                     @if($menus>0) {{in_array($module->parent_id,$user_parent_assigned ?? '')? 'checked':''}} @else checked @endif
                     >
                     <label for="Main_Module_{{$key}}">    {{$studentParentMenu->name}}</label>
                  </div>
                  @if(count($student_parent_submenu)>0)
                  <div class="arrow collapsed" data-toggle="collapse" data-target="#Role{{$module->parent_id}}">
                  </div>
                  @endif
               </div>
               <div id="Role{{$module->parent_id}}" class="collapse">
                  <div  class="permission_body">
                     <ul class="submenuSort">
                        @foreach($student_parent_submenu as $key=>$row2)
                        @php
                           $studentParentSubMenu=Modules\MenuManage\Entities\UserMenu::studentParentSubMenu($row2->module_id);
                        @endphp
                        <li>
                           <div class="submodule"> 
                              <input type="hidden" value="{{$studentParentSubMenu->id}}" name="all_menus[]">
                              <input id="Sub_Module_{{$row2->id}}" name="child_module_id[]" value="{{$row2->module_id}}" 
                               class="infix_csk common-radio  module_id_{{$module->parent_id}} module_link"  type="checkbox" 
                               @if($menus>0) {{in_array($row2->module_id,$user_child_assigned ?? '')? 'checked':''}} @else  {{in_array($row2->module_id ,$already_assigned ?? '')? 'checked':''}} @endif
                               >
                              <label for="Sub_Module_{{$row2->id}}">{{$studentParentSubMenu->name}}</label>
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
      @endif 
      @if($newModules !=null)
      @foreach($newModules as $key=>$student_parent_module)
      <?php 
      $subModule=Modules\RolePermission\Entities\InfixModuleStudentParentInfo::studentMenu($student_parent_module->id);
     ?>
 @if(in_array($student_parent_module->id,$already_assigned))                  
    <div class="single_role_blocks" data-id="menu_org{{ $student_parent_module->module_id }}">
         <div class="single_permission" id="{{$student_parent_module->module_id}}">
            <div class="permission_header d-flex align-items-center justify-content-between">
               <div>
                  <input type="checkbox" name="child_module_id[]" value="{{$student_parent_module->module_id}}" 
                  id="Main_Module_{{$student_parent_module->module_id}}" class="common-radio permission-checkAll main_module_id_{{$student_parent_module->module_id}}" {{in_array($student_parent_module->id,$already_assigned)? 'checked':''}}
               
                  >
                  <input type="hidden" value="{{$student_parent_module->module_id}}" name="all_menus[]">
                  <label for="Main_Module_{{$student_parent_module->module_id}}">{{$student_parent_module->name}}</label>
               </div>
               @if(count($subModule)>0)
               <div class="arrow collapsed" data-toggle="collapse" data-target="#Role{{$student_parent_module->module_id}}">
               </div>
               @endif
            </div>
            <div id="Role{{$student_parent_module->module_id}}" class="collapse">
               <div  class="permission_body">
                  <ul class="submenuSort">
                  
                     @foreach($subModule as $key=>$row2)
                     <li>
                        <div class="submodule"> 
                           <input type="hidden" value="{{$row2->id}}" name="all_menus[]">
                           <input id="Sub_Module_{{$row2->id}}" name="child_module_id[]" value="{{$row2->id}}" 
                           class="infix_csk common-radio  module_id_{{$student_parent_module->module_id}} module_link"  type="checkbox" 
                           {{in_array($row2->id,$already_assigned)? 'checked':''}}
                           >
                           <label for="Sub_Module_{{$row2->id}}">{{$row2->name}}</label>
                           <br>
                        </div>
                     </li>
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
    </div>
 @endif

      @endforeach
   @endif
   </div>
   @if(!empty($check_sidebar))
   <div class="row mt-40">
      <div class="col-lg-12 text-center">
         <button class="primary-btn fix-gr-bg">
         <span class="ti-check"></span>
         @lang('submit')
         </button>
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