<?php

    $school_config = schoolConfig();
// dd($sidebars);
?>

<nav id="sidebar">

    <div class="sidebar-header update_sidebar">

    <?php
        
        $logo=App\SmGeneralSettings::first()->logo;
        // dd($logo);
    ?>

        <a href="<?php echo e(route('/')); ?>">

            <?php if(! is_null($school_config->logo)): ?>

                <!-- <img src="<?php echo e(asset('public/uploads/settings/logo.png')); ?>" alt="logo"> -->
                <img src=" <?php echo e(asset($logo)); ?>" alt="logo">
            <?php else: ?>
            <img src=" <?php echo e(asset($logo)); ?>" alt="logo"> 
                <!-- <img src="<?php echo e(asset('public/uploads/settings/logo.png')); ?>" alt="logo"> -->
               
            <?php endif; ?>

        </a>

        <a id="close_sidebar" class="d-lg-none">

            <i class="ti-close"></i>

        </a>

    </div>

    <?php if(Auth::user()->is_saas == 0): ?>

        <ul class="list-unstyled components">

            <?php if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 ): ?>

                <?php if(userPermission(1)): ?>

                    <li>

                        <?php if(moduleStatusCheck('Saas')== TRUE && Auth::user()->is_administrator=="yes" && Session::get('isSchoolAdmin')==FALSE && Auth::user()->role_id == 1): ?>



                            <a href="<?php echo e(route('superadmin-dashboard')); ?>" id="superadmin-dashboard">

                                <?php else: ?>

                                    <a href="<?php echo e(route('admin-dashboard')); ?>" id="admin-dashboard">

                                        <?php endif; ?>

                                        <span class="flaticon-speedometer"></span>

                                        <?php echo app('translator')->get('lang.dashboard'); ?>

                                    </a>

                    </li>

                <?php endif; ?>

            <?php endif; ?>

            <?php if(moduleStatusCheck('InfixBiometrics')== TRUE && Auth::user()->role_id == 1): ?>

                <?php echo $__env->make('infixbiometrics::menu.InfixBiometrics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php endif; ?>

<!-- Zoom Menu -->

         <?php if(moduleStatusCheck('Zoom') == TRUE): ?>

         <?php echo $__env->make('zoom::menu.Zoom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

         <?php endif; ?>

<!-- End Zoom Menu -->













            

            <?php if(moduleStatusCheck('SaasSubscription')== TRUE && Auth::user()->is_administrator != "yes"): ?>

                <?php echo $__env->make('saassubscription::menu.SaasSubscriptionSchool', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php endif; ?>

            

            <?php if(moduleStatusCheck('Saas')== TRUE && Auth::user()->is_administrator =="yes" && Session::get('isSchoolAdmin')==FALSE && Auth::user()->role_id == 1 ): ?>

                <?php echo $__env->make('saas::menu.Saas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php else: ?>



                <?php echo $__env->make('menumanage::menu.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3 ): ?>
            

                    <?php if(isset($sidebars)): ?>  

                        <?php $__currentLoopData = $sidebars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                       

                            <li>
                         
                                <?php if(isset($item->menuName) && $item->menuName !== null && $item->menuName->parent_id == 0): ?>

                                <a href="#menu_<?php echo e($item->parent_id); ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                                <span class="<?php echo e($item->menuName->icon_class !='' ? $item->menuName->icon_class :'flaticon-settings'); ?>"></span>                            

                                <?php echo e(__('lang.'.$item->menuName->lan_name)); ?>


                                </a>

                                <?php endif; ?>

                                <ul class="collapse list-unstyled" id="menu_<?php echo e($item->parent_id); ?>">

                                    <?php

                                        $childs=Modules\MenuManage\Entities\UserMenu::childMenu($item->parent_id);

                                    ?>

                                    <?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 

                                        <?php

                                            $subChilds=Modules\MenuManage\Entities\UserMenu::childMenu($child->module_id);

                                            $subMenu=Modules\MenuManage\Entities\Sidebar::where('infix_module_id',$child->module_id)->first();

                                        ?>

                                        <?php if(count($subChilds)>0): ?>

                                            <li>

                                            <?php if($subMenu): ?>

                                            <a href="#subMenuAccountReport_<?php echo e($child->module_id); ?>" data-toggle="collapse" aria-expanded="false"

                                            class="dropdown-toggle">

                                            <?php echo e(__('lang.'.$subMenu->lan_name)); ?>


                                                </a>

                                                <?php endif; ?>

                                                <ul class="collapse list-unstyled" id="subMenuAccountReport_<?php echo e($child->module_id); ?>">

                                                    <?php $__currentLoopData = $subChilds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subChild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                                                    

                                                    <?php

                                                    $subChildMenu=Modules\MenuManage\Entities\Sidebar::where('infix_module_id',$subChild->module_id)->first();

                                                        

                                                    ?>

                                        

                                                    

                                                        <li>

                                                            <?php if($subChildMenu ): ?>

                                                                <?php if(!empty($subChildMenu->route)): ?>

                                                            <a href="<?php echo e(route($subChildMenu->route)); ?>">   <?php echo e(__('lang.'.$subChildMenu->lan_name)); ?></a>

                                                            <?php endif; ?>

                                                            <?php endif; ?>

                                                        </li>

                                                    

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </ul>

                                        </li>

                                        <?php else: ?>

                                            <li>          

                                                <?php if($subMenu): ?>         

                                                <?php if(!empty($subMenu->route)): ?>                         

                                                <a href="<?php echo e(route($subMenu->route)); ?>">                                                                   

                                                    <?php echo e(__('lang.'.$subMenu->lan_name)); ?>                                                              

                                                    

                                                    </a>

                                                    <?php endif; ?>

                                                    

                                                    <?php endif; ?>

                                                    

                                            </li> 

                                        <?php endif; ?>    

                                                                            

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    

                                </ul>

                            </li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                        <?php if(intallMdouleMenu(21,'ParentRegistration')): ?>

                                <?php echo $__env->make('parentregistration::menu.ParentRegistration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php endif; ?>



                        <?php if(intallMdouleMenu(33,'BBB')): ?>

                           <?php echo $__env->make('bbb::menu.bigbluebutton_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>                   

                         <?php endif; ?>

                        <?php if(intallMdouleMenu(30,'Jitsi')): ?>

                            <?php echo $__env->make('jitsi::menu.jitsi_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>          

                        <?php endif; ?>

                        <?php if(intallMdouleMenu(22,'Zoom')): ?>

                            <?php echo $__env->make('zoom::menu.Zoom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php endif; ?>

                        

                    <?php endif; ?>



                    <?php if(isset($assign_menu)): ?>



                        <?php $__currentLoopData = $assign_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php

                                

                                    $menuNames=Modules\RolePermission\Entities\InfixPermissionAssign::parentMenu($item->module_id);

                                ?>

                                <?php $__currentLoopData = $menuNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <li>

                                            <a href="#menu_<?php echo e($name->infix_module_id); ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                                                <span class="<?php echo e($name->icon_class); ?>"></span>                    

                                                <?php echo e(__('lang.' . $name->lan_name)); ?>


                                            </a>

                                            <ul class="collapse list-unstyled" id="menu_<?php echo e($name->infix_module_id); ?>">

                                                <?php

                                                    $childs=Modules\RolePermission\Entities\InfixPermissionAssign::subMenu($item->module_id);

                                              

                                              ?>

                                                <?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  

                                                     

                                                    <?php if($child->route !=''): ?>

                                                            <li>                                                        

                                                                <a href="<?php echo e(route($child->route)); ?>">    <?php echo e(__('lang.' .$child->lan_name)); ?> </a>

                                                            </li>

                                                    <?php endif; ?>

                                              

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                

                                            </ul>

                                    </li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>

                    <?php if(isset($pre_assign_menu)): ?>

                        <?php $__currentLoopData = $pre_assign_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    

                                <?php

                                $menuNames=DB::table('infix_module_infos')->where('id',$item->module_id)->where('parent_id',0)->get();

                                ?>

                                <?php $__currentLoopData = $menuNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <li>

                                

                                        <a href="#menu_<?php echo e($name->id); ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                                            <span class="<?php echo e($name->icon_class); ?>"></span>

                                            <?php echo e(__('lang.' . $name->lang_name)); ?> 

                                        </a>

                                        <ul class="collapse list-unstyled" id="menu_<?php echo e($name->id); ?>">

                                            <?php

                                                $childs=Modules\RolePermission\Entities\InfixPermissionAssign::childMenu($name->id);

                                            ?>

                                            <?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>           

                                                    <?php if($child->route !=''): ?>

                                                    <li>                                                        

                                                        <a href="<?php echo e(route($child->route)); ?>">  <?php echo e(__('lang.' .$child->lang_name)); ?> </a>

                                                    </li>

                                                    <?php endif; ?>

                                            

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            

                                        </ul>

                                </li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>

                 <?php if(isset($super_admin)): ?>

                    

                    <?php if(intallMdouleMenu(21,'ParentRegistration')): ?>

                            <?php echo $__env->make('parentregistration::menu.ParentRegistration', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php endif; ?>

                    



                    <?php if(userPermission(11)): ?>

                        <li>

                            <a href="#subMenuAdmin" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-analytics"></span>

                                Administrator

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuAdmin">

                                <?php if((moduleStatusCheck('Saas')== TRUE) && (auth()->user()->is_administrator=="yes")): ?>

                                        <li>

                                            <a href="<?php echo e(route('school-general-settings')); ?>"> <?php echo app('translator')->get('lang.general_settings'); ?></a>

                                        </li>

                                    <?php else: ?>

                                        <?php if(userPermission(405)): ?>



                                            <li>

                                                <a href="<?php echo e(route('general-settings')); ?>"> <?php echo app('translator')->get('lang.general_settings'); ?></a>

                                            </li>

                                        <?php endif; ?>

                                    <?php endif; ?>

                                    

                                <?php if(userPermission(412)): ?>

                                    <li>

                                        <a href="<?php echo e(route('payment-method-settings')); ?>"><?php echo app('translator')->get('lang.payment_method_settings'); ?></a>

                                    </li>

                                    

                                    <li>

                                        <a href="<?php echo e(route('sms-settings')); ?>"><?php echo app('translator')->get('lang.sms_settings'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(410)): ?>



                                    <li>

                                        <a href="<?php echo e(route('email-settings')); ?>"><?php echo app('translator')->get('lang.email_settings'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(432)): ?>

                                    <li>

                                        <a href="<?php echo e(route('academic-year')); ?>"><?php echo app('translator')->get('lang.academic_year'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(585)): ?>

                                    <li>

                                        <a href="<?php echo e(route('rolepermission/role')); ?>"><?php echo app('translator')->get('lang.role'); ?></a>

                                    </li>

                                <?php endif; ?>

                                

                                <?php if(userPermission(394)): ?>

                                    <li>

                                        <!-- <a href="<?php echo e(route('user_log')); ?>"><?php echo app('translator')->get('lang.user_log'); ?></a> -->

                                        <a href="<?php echo e(route('user_log')); ?>">Activity log</a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(394)): ?>

                                    <li>

                                        <a href="backup-settings">Backup</a>

                                    </li>

                                <?php endif; ?>

                                

                            </ul>

                        </li>

                    <?php endif; ?>



                

                        <li>
                            <a href="#attendance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <span class="flaticon-analytics"></span>Attendances</a>
                            <ul class="collapse list-unstyled" id="attendance">
                                <li><a href="<?php echo e(route('student.attendance.all')); ?>"> Today Attendance</a></li>
                                <li><a href="<?php echo e(route('student.attendance')); ?>"> Student Attendance</a></li>
                                <li><a href="<?php echo e(route('teacher.attendance')); ?>"> Teacher Attendance</a></li>  
                            </ul>
                        </li>

                    

                    

                    <?php if(userPermission(61)): ?>

                        <li>

                            <a href="#subMenuTemplate" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-reading"></span>

                                Template

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuTemplate">

                                <?php if(userPermission(710)): ?>

                                <li>

                                    <a href="<?php echo e(route('sms-template-new')); ?>"><?php echo app('translator')->get('lang.sms'); ?> <?php echo app('translator')->get('lang.template'); ?></a>

                                </li>

                                <?php endif; ?>

                                <?php if(userPermission(480)): ?>

                                <li>

                                    <a href="<?php echo e(route('templatesettings/email-template')); ?>">

                                        <?php echo app('translator')->get('lang.email'); ?> <?php echo app('translator')->get('lang.template'); ?>

                                    </a>

                                </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>











                    <?php if(userPermission(61)): ?>

                        <li>

                            <a href="#subMenuFrontOffice" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-reading"></span>

                                Front Office

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuFrontOffice">

                                <?php if(userPermission(16)): ?>

                                    <li>

                                        <a href="<?php echo e(route('visitor')); ?>"><?php echo app('translator')->get('lang.visitor_book'); ?> </a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(21)): ?>

                                    <li>

                                        <a href="<?php echo e(route('complaint')); ?>"><?php echo app('translator')->get('lang.complaint'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(27)): ?>

                                    <li>

                                        <a href="<?php echo e(route('postal-receive')); ?>"><?php echo app('translator')->get('lang.postal_receive'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(32)): ?>

                                    <li>

                                        <a href="<?php echo e(route('postal-dispatch')); ?>"><?php echo app('translator')->get('lang.postal_dispatch'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(36)): ?>

                                    <li>

                                        <a href="<?php echo e(route('phone-call')); ?>"><?php echo app('translator')->get('lang.phone_call_log'); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>

                    

                    

                    <?php if(userPermission(160)): ?>

                        <li>

                            <a href="#subMenuHumanResource" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-consultation"></span>

                                <?php echo app('translator')->get('lang.human_resource'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuHumanResource">

                                <?php if(userPermission(180)): ?>

                                    <li>

                                        <a href="<?php echo e(route('designation')); ?>"> <?php echo app('translator')->get('lang.designation'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(184)): ?>

                                    <li>

                                        <a href="<?php echo e(route('department')); ?>"> <?php echo app('translator')->get('lang.department'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(162)): ?>

                                    <li>

                                        <a href="<?php echo e(route('addStaff')); ?>"> <?php echo app('translator')->get('lang.add'); ?>  <?php echo app('translator')->get('lang.staff'); ?> </a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(161)): ?>

                                    <li>

                                        <a href="<?php echo e(route('staff_directory')); ?>"> <?php echo app('translator')->get('lang.staff_directory'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(165)): ?>

                                    <li>

                                        <a href="<?php echo e(route('staff_attendance')); ?>"> <?php echo app('translator')->get('lang.staff_attendance'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(169)): ?>

                                    <li>

                                        <a href="<?php echo e(route('staff_attendance_report')); ?>"> <?php echo app('translator')->get('lang.staff_attendance_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(170)): ?>

                                    <li>

                                        <a href="<?php echo e(route('payroll')); ?>"> <?php echo app('translator')->get('lang.payroll'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(178)): ?>

                                    <li>

                                        <a href="<?php echo e(route('payroll-report')); ?>"> <?php echo app('translator')->get('lang.payroll_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    

                    

                    <?php if(userPermission(188)): ?>

                        <li>

                            <a href="#subMenuLeaveManagement" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-slumber"></span>

                                Manage Leave

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuLeaveManagement">

                                <?php if(userPermission(203)): ?>

                                    <li>

                                        <a href="<?php echo e(route('leave-type')); ?>"> <?php echo app('translator')->get('lang.leave_type'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(199)): ?>

                                    <li>

                                        <a href="<?php echo e(route('leave-define')); ?>"> <?php echo app('translator')->get('lang.leave_define'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(189)): ?>

                                    <li>

                                        <a href="<?php echo e(route('approve-leave')); ?>"><?php echo app('translator')->get('lang.approve_leave_request'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(196)): ?>

                                    <li>

                                        <a href="<?php echo e(route('pending-leave')); ?>"><?php echo app('translator')->get('lang.pending_leave_request'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(Auth::user()->role_id!=1): ?>



                                    <?php if(userPermission(193)): ?>

                                        <li>

                                            <a href="<?php echo e(route('apply-leave')); ?>"><?php echo app('translator')->get('lang.apply_leave'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    

                    <?php if(userPermission(245)): ?>

                        <li>

                            <a href="#subMenuAcademic" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                                <span class="flaticon-book"></span>

                                <?php echo app('translator')->get('lang.academics'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuAcademic">

                                <?php if(userPermission(537)): ?>

                                    <li>

                                        <a href="<?php echo e(route('optional-subject')); ?>"> <?php echo app('translator')->get('lang.optional'); ?> <?php echo app('translator')->get('lang.subject'); ?> </a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(265)): ?>

                                    <li>

                                        <a href="<?php echo e(route('section')); ?>"> <?php echo app('translator')->get('lang.section'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(261)): ?>

                                    <li>

                                        <a href="<?php echo e(route('class')); ?>"> <?php echo app('translator')->get('lang.class'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(257)): ?>

                                    <li>

                                        <a href="<?php echo e(route('subject')); ?>"> <?php echo app('translator')->get('lang.subjects'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(253)): ?>

                                    <li>

                                        <a href="<?php echo e(route('assign-class-teacher')); ?>"> <?php echo app('translator')->get('lang.assign_class_teacher'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(250)): ?>

                                    <li>

                                        <a href="<?php echo e(route('assign_subject')); ?>"> <?php echo app('translator')->get('lang.assign_subject'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(269)): ?>

                                    <li>

                                        <a href="<?php echo e(route('class-room')); ?>"> <?php echo app('translator')->get('lang.class_room'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(273)): ?>

                                    <li>

                                        <a href="<?php echo e(route('class-time')); ?>"> <?php echo app('translator')->get('lang.class_time_setup'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(246)): ?>

                                    <li>

                                        <a href="<?php echo e(route('class_routine_new')); ?>"> <?php echo app('translator')->get('lang.class_routine'); ?></a>



                                    </li>

                                <?php endif; ?>

                            <!-- only for teacher -->

                                <?php if(Auth::user()->role_id == 4): ?>

                                    <li>

                                        <a href="<?php echo e(route('view-teacher-routine')); ?>"><?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.class_routine'); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    

                    <?php if(userPermission(61)): ?>

                        <li>

                            <a href="#subMenuStudent" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-reading"></span>

                                <?php echo app('translator')->get('lang.student_information'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuStudent">

                                <?php if(userPermission(71)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student_category')); ?>"> <?php echo app('translator')->get('lang.student_category'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(62)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student_admission')); ?>"><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.student'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(64)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student_list')); ?>"> <?php echo app('translator')->get('lang.student_list'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(68)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student_attendance')); ?>"> <?php echo app('translator')->get('lang.student_attendance'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(70)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student_attendance_report')); ?>"> <?php echo app('translator')->get('lang.student_attendance_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(533)): ?>

                                    <li>

                                        <a href="<?php echo e(route('subject-wise-attendance')); ?>"> <?php echo app('translator')->get('lang.subject'); ?> <?php echo app('translator')->get('lang.wise'); ?> <?php echo app('translator')->get('lang.attendance'); ?> </a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(535)): ?>

                                    <li>

                                        <a href="<?php echo e(route('subject-attendance-report')); ?>"> <?php echo app('translator')->get('lang.subject_attendance_report'); ?> </a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(76)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student_group')); ?>"><?php echo app('translator')->get('lang.student_group'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(81)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student_promote')); ?>"><?php echo app('translator')->get('lang.student_promote'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(83)): ?>

                                    <li>

                                        <a href="<?php echo e(route('disabled_student')); ?>"><?php echo app('translator')->get('lang.disabled_student'); ?></a>

                                    </li>

                                <?php endif; ?>



                                <?php if(moduleStatusCheck('StudentAbsentNotification')== TRUE): ?>

                                <li>

                                    <a href="<?php echo e(route('notification_time_setup')); ?>"><?php echo app('translator')->get('lang.time_setup'); ?></a>

                                </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    

                    <?php if(userPermission(87)): ?>

                        <li>

                            <a href="#subMenuTeacher" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-professor"></span>

                                <?php echo app('translator')->get('lang.study_material'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuTeacher">

                                <?php if(userPermission(88)): ?>

                                    <li>

                                        <a href="<?php echo e(route('upload-content')); ?>"> <?php echo app('translator')->get('lang.upload_content'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(92)): ?>

                                    <li>

                                        <a href="<?php echo e(route('assignment-list')); ?>"><?php echo app('translator')->get('lang.assignment'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(100)): ?>

                                    <li>

                                        <a href="<?php echo e(route('syllabus-list')); ?>"><?php echo app('translator')->get('lang.syllabus'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(105)): ?>

                                    <li>

                                        <a href="<?php echo e(route('other-download-list')); ?>"><?php echo app('translator')->get('lang.other_download'); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if(userPermission(800)): ?>

                        <li>

                            <a href="#subMenuCertificate" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                                <span class="flaticon-professor"></span>

                                Certificate

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuCertificate">

                                <?php if(userPermission(49)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student-certificate')); ?>"><?php echo app('translator')->get('lang.student_certificate'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(53)): ?>

                                    <li>

                                        <a href="<?php echo e(route('generate_certificate')); ?>"><?php echo app('translator')->get('lang.generate_certificate'); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>

                    

                    <?php if(userPermission(298)): ?>

                        <li>

                            <a href="#subMenulibrary" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-book-1"></span>

                                <?php echo app('translator')->get('lang.library'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenulibrary">

                                <?php if(userPermission(304)): ?>

                                    <li>

                                        <a href="<?php echo e(route('book-category-list')); ?>"> <?php echo app('translator')->get('lang.book_category'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(579)): ?>

                                    <li>

                                        <a href="<?php echo e(route('library_subject')); ?>"> <?php echo app('translator')->get('lang.subject'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(299)): ?>

                                    <li>

                                        <a href="<?php echo e(route('add-book')); ?>"> <?php echo app('translator')->get('lang.add_book'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(301)): ?>

                                    <li>

                                        <a href="<?php echo e(route('book-list')); ?>"> <?php echo app('translator')->get('lang.book_list'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(308)): ?>

                                    <li>

                                        <a href="<?php echo e(route('library-member')); ?>"> <?php echo app('translator')->get('lang.library_member'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(311)): ?>

                                    <li>

                                        <a href="<?php echo e(route('member-list')); ?>"> <?php echo app('translator')->get('lang.member_list'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(314)): ?>

                                    <li>

                                        <a href="<?php echo e(route('all-issed-book')); ?>"> <?php echo app('translator')->get('lang.all_issued_book'); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    

                    

                    <?php if(userPermission(348)): ?>

                        <li>

                            <a href="#subMenuTransport" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-bus"></span>

                                <?php echo app('translator')->get('lang.transport'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuTransport">

                                <?php if(userPermission(349)): ?>

                                    <li>

                                        <a href="<?php echo e(route('transport-route')); ?>"> <?php echo app('translator')->get('lang.routes'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(353)): ?>

                                    <li>

                                        <a href="<?php echo e(route('vehicle')); ?>"> <?php echo app('translator')->get('lang.vehicle'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(357)): ?>

                                    <li>

                                        <a href="<?php echo e(route('assign-vehicle')); ?>"> <?php echo app('translator')->get('lang.assign_vehicle'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(361)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student_transport_report')); ?>"> <?php echo app('translator')->get('lang.student_transport_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    



                    <?php if(userPermission(362)): ?>

                        <li>

                            <a href="#subMenuDormitory" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-hotel"></span>

                                Hostel

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuDormitory">

                                <?php if(userPermission(371)): ?>

                                    <li>

                                        <a href="<?php echo e(route('room-type')); ?>"> <?php echo app('translator')->get('lang.room_type'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(367)): ?>

                                    <li>

                                        <a href="<?php echo e(route('dormitory-list')); ?>"> Manage Hostel</a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(363)): ?>

                                    <li>

                                        <a href="<?php echo e(route('room-list')); ?>"> Room List</a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(375)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student_dormitory_report')); ?>"> Hostel Member</a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    

                    



                    

                    

                   

                        <?php if(userPermission(108)): ?>

                            <li>

                                <a href="#subMenuFeesCollection" data-toggle="collapse" aria-expanded="false"

                                   class="dropdown-toggle">

                                    <span class="flaticon-wallet"></span>

                                    Accounting - Fees

                                </a>

                                <ul class="collapse list-unstyled" id="subMenuFeesCollection">

                             

                                    <?php if(userPermission(131)): ?>

                                        <li>

                                            <a href="<?php echo e(route('fees-master')); ?>"> <?php echo app('translator')->get('lang.fees_master'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                   

                                    <?php if(userPermission(109)): ?>
                                    <!-- old menu -->
                                     

                                    <!--new menu-->
                                    <li><a href="<?php echo e(route('fees.collection')); ?>"> <?php echo app('translator')->get('lang.collect_fees'); ?></a></li>
                                    <li><a href="<?php echo e(route('list.collection')); ?>"> Collection List</a></li>
                                    <?php endif; ?>

                                  
                                 

                                    <?php if(userPermission(840)): ?>

                                    <li>

                                        <a href="#subMenuFeesReport" data-toggle="collapse" aria-expanded="false"

                                           class="dropdown-toggle">

                                            <?php echo app('translator')->get('lang.report'); ?>

                                        </a>

                                        <ul class="collapse list-unstyled" id="subMenuFeesReport">

                                            <?php if(userPermission(383)): ?>

                                                <li>

                                                    <a href="<?php echo e(route('transaction_report')); ?>"><?php echo app('translator')->get('lang.collection'); ?> <?php echo app('translator')->get('lang.report'); ?></a>

                                                </li>

                                           <?php endif; ?>

                                            <?php if(userPermission(841)): ?>

                                                <li>

                                                    <a href="<?php echo e(route('monthly-collection-report')); ?>"> <?php echo app('translator')->get('lang.monthly'); ?> <?php echo app('translator')->get('lang.collection'); ?>   <?php echo app('translator')->get('lang.report'); ?></a>

                                                </li>

                                            <?php endif; ?>

                                           

                                        </ul>

                                    </li>

                                <?php endif; ?>

                                </ul>

                            </li>

                        <?php endif; ?>

                   

                    



                    

                    

                    <?php if(userPermission(137)): ?>

                        <li>

                            <a href="#subMenuAccount" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-accounting"></span>

                                <?php echo app('translator')->get('lang.accounts'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuAccount">

                                <?php if(userPermission(148)): ?>

                                    <li>

                                        <a href="<?php echo e(route('chart-of-account')); ?>"> <?php echo app('translator')->get('lang.chart_of_account'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(156)): ?>

                                    <li>

                                        <a href="<?php echo e(route('bank-account')); ?>"> <?php echo app('translator')->get('lang.bank_account'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(139)): ?>

                                    <li>

                                        <a href="<?php echo e(route('add_income')); ?>"> <?php echo app('translator')->get('lang.income'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(138)): ?>

                                    <li>

                                        <a href="<?php echo e(route('profit')); ?>"> <?php echo app('translator')->get('lang.profit'); ?> <?php echo app('translator')->get('lang.&'); ?> <?php echo app('translator')->get('lang.loss'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(143)): ?>

                                    <li>

                                        <a href="<?php echo e(route('add-expense')); ?>"> <?php echo app('translator')->get('lang.expense'); ?></a>

                                    </li>

                                <?php endif; ?>

                                

                                <?php if(userPermission(704)): ?>

                                    <li>

                                        <a href="<?php echo e(route('fund-transfer')); ?>"><?php echo app('translator')->get('lang.fund'); ?> <?php echo app('translator')->get('lang.transfer'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(700)): ?>

                                    <li>

                                        <a href="#subMenuAccountReport" data-toggle="collapse" aria-expanded="false"

                                           class="dropdown-toggle">

                                            <?php echo app('translator')->get('lang.report'); ?>

                                        </a>

                                        <ul class="collapse list-unstyled" id="subMenuAccountReport">

                                            <?php if(userPermission(701)): ?>

                                                <li>

                                                    <a href="<?php echo e(route('fine-report')); ?>"> <?php echo app('translator')->get('lang.fine'); ?> <?php echo app('translator')->get('lang.report'); ?></a>

                                                </li>

                                            <?php endif; ?>

                                            <?php if(userPermission(702)): ?>

                                                <li>

                                                    <a href="<?php echo e(route('accounts-payroll-report')); ?>"> <?php echo app('translator')->get('lang.payroll'); ?> <?php echo app('translator')->get('lang.report'); ?></a>

                                                </li>

                                            <?php endif; ?>

                                            <?php if(userPermission(703)): ?>

                                                <li>

                                                    <a href="<?php echo e(route('transaction')); ?>"> <?php echo app('translator')->get('lang.transaction'); ?></a>

                                                </li>

                                            <?php endif; ?>

                                        </ul>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>





                    <?php echo $__env->make('chat::menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



                    <?php if(userPermission(207)): ?>

                        <li>

                            <a href="#subMenuExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                                <span class="flaticon-test"></span>

                                Exam

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuExam">

                                <?php if(userPermission(225)): ?>

                                    <li>

                                        <a href="<?php echo e(route('marks-grade')); ?>"> <?php echo app('translator')->get('lang.marks_grade'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(571)): ?>

                                    <li>

                                        <a href="<?php echo e(route('exam-time')); ?>"> <?php echo app('translator')->get('lang.exam_time'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(208)): ?>

                                    <li>

                                        <a href="<?php echo e(route('exam-type')); ?>"> <?php echo app('translator')->get('lang.exam_type'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(214)): ?>

                                    <li>

                                        <a href="<?php echo e(route('exam')); ?>"> <?php echo app('translator')->get('lang.exam_setup'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(217)): ?>

                                    <li>

                                        <a href="<?php echo e(route('exam_schedule')); ?>"> <?php echo app('translator')->get('lang.exam_schedule'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(221)): ?>

                                    <li>

                                        <a href="<?php echo e(route('exam_attendance')); ?>"> <?php echo app('translator')->get('lang.exam_attendance'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(222)): ?>

                                    <li>

                                        <a href="<?php echo e(route('marks_register')); ?>"> <?php echo app('translator')->get('lang.marks_register'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(229)): ?>

                                    <li>

                                        <a href="<?php echo e(route('send_marks_by_sms')); ?>"> <?php echo app('translator')->get('lang.send_marks_by_sms'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(230)): ?>

                                    <li>

                                        <a href="<?php echo e(route('question-group')); ?>"><?php echo app('translator')->get('lang.question_group'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(234)): ?>

                                    <li>

                                        <a href="<?php echo e(route('question-bank')); ?>"><?php echo app('translator')->get('lang.question_bank'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(238)): ?>

                                    <li>

                                        <a href="<?php echo e(route('online-exam')); ?>"><?php echo app('translator')->get('lang.online_exam'); ?></a>

                                    </li>

                                <?php endif; ?>



                                <li>

                                    <a href="#examSettings" data-toggle="collapse" aria-expanded="false"

                                       class="dropdown-toggle">

                                        <?php echo app('translator')->get('lang.settings'); ?>

                                    </a>

                                    <ul class="collapse list-unstyled" id="examSettings">

                                        <?php if(userPermission(436)): ?>

                                            <li>

                                                <a href="<?php echo e(route('custom-result-setting')); ?>"><?php echo app('translator')->get('lang.setup'); ?> <?php echo app('translator')->get('lang.exam'); ?> <?php echo app('translator')->get('lang.rule'); ?></a>

                                            </li>

                                        <?php endif; ?>



                                        <?php if(userPermission(706)): ?>

                                            <li>

                                                <a href="<?php echo e(route('exam-settings')); ?>"><?php echo app('translator')->get('lang.format'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>

                                            </li>

                                        <?php endif; ?>

                                    </ul>

                                </li>



                            </ul>

                        </li>

                    <?php endif; ?>





                    

                    <?php if(moduleStatusCheck('OnlineExam')== TRUE): ?>

                         <?php echo $__env->make('onlineexam::menu_onlineexam', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php else: ?>

                        <?php if(userPermission(188)): ?>

                            <li>

                                <a href="#subMenuOnlineExam" data-toggle="collapse" aria-expanded="false"

                                class="dropdown-toggle">

                                    <span class="flaticon-book-1"></span>

                                    <?php echo app('translator')->get('lang.online_exam'); ?>

                                </a>

                                <ul class="collapse list-unstyled" id="subMenuOnlineExam">

                                        <?php if(userPermission(230)): ?>

                                                <li>

                                                    <a href="<?php echo e(route('question-group')); ?>"><?php echo app('translator')->get('lang.question_group'); ?></a>

                                                </li>

                                            <?php endif; ?>

                                            <?php if(userPermission(234)): ?>

                                                <li>

                                                    <a href="<?php echo e(route('question-bank')); ?>"><?php echo app('translator')->get('lang.question_bank'); ?></a>

                                                </li>

                                            <?php endif; ?>

                                            <?php if(userPermission(238)): ?>

                                                <li>

                                                    <a href="<?php echo e(route('online-exam')); ?>"><?php echo app('translator')->get('lang.online_exam'); ?></a>

                                                </li>

                                            <?php endif; ?>

                                </ul>

                            </li>

                        <?php endif; ?>

                    <?php endif; ?>



                    <?php if(userPermission(277)): ?>

                        <li>

                            <a href="#subMenuHomework" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-book"></span>

                                <?php echo app('translator')->get('lang.home_work'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuHomework">

                                <?php if(userPermission(278)): ?>

                                    <li>

                                        <a href="<?php echo e(route('add-homeworks')); ?>"> <?php echo app('translator')->get('lang.add_homework'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(280)): ?>

                                    <li>

                                        <a href="<?php echo e(route('homework-list')); ?>"> <?php echo app('translator')->get('lang.homework_list'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(284)): ?>

                                    <li>

                                        <a href="<?php echo e(route('evaluation-report')); ?>"> <?php echo app('translator')->get('lang.evaluation_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>

                    

                    

                    

                    <?php if(userPermission(160)): ?>

                        <li>

                            <a href="#subMenuHumanResource" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-consultation"></span>

                                Payroll

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuHumanResource">

                                

                                <?php if(userPermission(170)): ?>

                                    <li>

                                        <a href="<?php echo e(route('payroll')); ?>"> Payroll</a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(178)): ?>

                                    <li>

                                        <a href="<?php echo e(route('payroll-report')); ?>"> <?php echo app('translator')->get('lang.payroll_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if(userPermission(286)): ?>

                        <li>

                            <a href="#subMenuAccouncement" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-email"></span>

                                Announcement

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuAccouncement">

                                <?php if(userPermission(287)): ?>

                                    <li>

                                        <a href="<?php echo e(route('notice-list')); ?>"><?php echo app('translator')->get('lang.notice_board'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(@$config->Saas == 1 && Auth::user()->is_administrator != "yes" ): ?>

                                    <li>

                                        <a href="<?php echo e(route('administrator-notice')); ?>"><?php echo app('translator')->get('lang.administrator'); ?> <?php echo app('translator')->get('lang.notice'); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>

                    <?php if(userPermission(286)): ?>

                        <li>

                            <a href="#subMenuCommunicate" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-email"></span>

                                <?php echo app('translator')->get('lang.communicate'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuCommunicate">

                                <?php if(userPermission(287)): ?>

                                    <li>

                                        <a href="<?php echo e(route('notice-list')); ?>"><?php echo app('translator')->get('lang.notice_board'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(@$config->Saas == 1 && Auth::user()->is_administrator != "yes" ): ?>

                                    <li>

                                        <a href="<?php echo e(route('administrator-notice')); ?>"><?php echo app('translator')->get('lang.administrator'); ?> <?php echo app('translator')->get('lang.notice'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(291)): ?>

                                    <li>

                                        <a href="<?php echo e(route('send-email-sms-view')); ?>"><?php echo app('translator')->get('lang.send_email'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(293)): ?>

                                    <li>

                                        <a href="<?php echo e(route('email-sms-log')); ?>"><?php echo app('translator')->get('lang.email_sms_log'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(294)): ?>

                                    <li>

                                        <a href="<?php echo e(route('event')); ?>"><?php echo app('translator')->get('lang.event'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(710)): ?>

                                <li>

                                    <a href="<?php echo e(route('sms-template-new')); ?>"><?php echo app('translator')->get('lang.sms'); ?> <?php echo app('translator')->get('lang.template'); ?></a>

                                </li>

                                <?php endif; ?>

                                <?php if(userPermission(480)): ?>

                                <li>

                                    <a href="<?php echo e(route('templatesettings/email-template')); ?>">

                                        <?php echo app('translator')->get('lang.email'); ?> <?php echo app('translator')->get('lang.template'); ?>

                                    </a>

                                </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>

                    <?php if(userPermission(315)): ?>

                        <li>

                            <a href="#subMenuInventory" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-inventory"></span>

                                <?php echo app('translator')->get('lang.inventory'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuInventory">

                                <?php if(userPermission(316)): ?>

                                    <li>

                                        <a href="<?php echo e(route('item-category')); ?>"> <?php echo app('translator')->get('lang.item_category'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(320)): ?>

                                    <li>

                                        <a href="<?php echo e(route('item-list')); ?>"> <?php echo app('translator')->get('lang.item_list'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(324)): ?>

                                    <li>

                                        <a href="<?php echo e(route('item-store')); ?>"> <?php echo app('translator')->get('lang.item_store'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(328)): ?>

                                    <li>

                                        <a href="<?php echo e(route('suppliers')); ?>"> <?php echo app('translator')->get('lang.supplier'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(332)): ?>

                                    <li>

                                        <a href="<?php echo e(route('item-receive')); ?>"> <?php echo app('translator')->get('lang.item_receive'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(334)): ?>

                                    <li>

                                        <a href="<?php echo e(route('item-receive-list')); ?>"> <?php echo app('translator')->get('lang.item_receive_list'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(339)): ?>

                                    <li>

                                        <a href="<?php echo e(route('item-sell-list')); ?>"> <?php echo app('translator')->get('lang.item_sell'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(345)): ?>

                                    <li>

                                        <a href="<?php echo e(route('item-issue')); ?>"> <?php echo app('translator')->get('lang.item_issue'); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>

                    <?php if(userPermission(261)): ?>

                        <li>

                            <a href="#subMenusystemIDcard" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-analysis"></span>

                                ID Card Generator

                            </a> 

                            <ul class="collapse list-unstyled" id="subMenusystemIDcard">

                                

                                    

                                    <li>

                                        <a href="<?php echo e(route('generate_id_card')); ?>"><?php echo app('translator')->get('lang.generate_id_card'); ?></a>

                                    </li>

                                    <li>

                                        <a href="<?php echo e(route('generate_admit_card')); ?>">Generate Admit Card</a>

                                    </li>

                            </ul>

                        </li>

                    <?php endif; ?>

                    





                    <?php if(userPermission(376)): ?>

                        <li>

                            <a href="#subMenusystemReports" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-analysis"></span>

                                <?php echo app('translator')->get('lang.reports'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenusystemReports">

                                <?php if(userPermission(538)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student_report')); ?>"><?php echo app('translator')->get('lang.student_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(377)): ?>

                                    <li>

                                        <a href="<?php echo e(route('guardian_report')); ?>"><?php echo app('translator')->get('lang.guardian_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(378)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student_history')); ?>"><?php echo app('translator')->get('lang.student_history'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(379)): ?>

                                    <li>

                                        <a href="<?php echo e(route('student_login_report')); ?>"><?php echo app('translator')->get('lang.student_login_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(381)): ?>

                                    <li>

                                        <a href="<?php echo e(route('fees_statement')); ?>"><?php echo app('translator')->get('lang.fees_statement'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(382)): ?>

                                    <li>

                                        <a href="<?php echo e(route('balance_fees_report')); ?>"><?php echo app('translator')->get('lang.balance_fees_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(384)): ?>

                                    <li>

                                        <a href="<?php echo e(route('class_report')); ?>"><?php echo app('translator')->get('lang.class_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(385)): ?>

                                    <li>

                                        <a href="<?php echo e(route('class_routine_report')); ?>"><?php echo app('translator')->get('lang.class_routine'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(386)): ?>

                                    <li>

                                        <a href="<?php echo e(route('exam_routine_report')); ?>"><?php echo app('translator')->get('lang.exam_routine'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(387)): ?>

                                    <li>

                                        <a href="<?php echo e(route('teacher_class_routine_report')); ?>"><?php echo app('translator')->get('lang.teacher'); ?> <?php echo app('translator')->get('lang.class_routine'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(388)): ?>

                                    <li>

                                        <a href="<?php echo e(route('merit_list_report')); ?>"><?php echo app('translator')->get('lang.merit_list_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                                

                                <?php if(userPermission(389)): ?>

                                    <li>

                                        <a href="<?php echo e(route('online_exam_report')); ?>"><?php echo app('translator')->get('lang.online_exam_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(390)): ?>

                                    <li>

                                        <a href="<?php echo e(route('mark_sheet_report_student')); ?>"><?php echo app('translator')->get('lang.mark_sheet_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(391)): ?>

                                    <li>

                                        <a href="<?php echo e(route('tabulation_sheet_report')); ?>"><?php echo app('translator')->get('lang.tabulation_sheet_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(392)): ?>

                                    <li>

                                        <a href="<?php echo e(route('progress_card_report')); ?>"><?php echo app('translator')->get('lang.progress_card_report'); ?></a>

                                    </li>

                                <?php endif; ?>

                                

                                

                                <?php if(userPermission(539)): ?>

                                    <li>

                                        <a href="<?php echo e(route('previous-class-results')); ?>"><?php echo app('translator')->get('lang.previous'); ?> <?php echo app('translator')->get('lang.result'); ?> </a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(540)): ?>

                                    <li>

                                        <a href="<?php echo e(route('previous-record')); ?>"><?php echo app('translator')->get('lang.previous'); ?> <?php echo app('translator')->get('lang.record'); ?> </a>

                                    </li>

                                <?php endif; ?>

                                

                                <?php if(Auth::user()->role_id == 1): ?>

                                    <?php if(moduleStatusCheck('ResultReports')== TRUE): ?>

                                        

                                        <li>

                                            <a href="<?php echo e(route('resultreports/cumulative-sheet-report')); ?>"><?php echo app('translator')->get('lang.cumulative'); ?> <?php echo app('translator')->get('lang.sheet'); ?> <?php echo app('translator')->get('lang.report'); ?></a>

                                        </li>

                                        <li>

                                            <a href="<?php echo e(route('resultreports/continuous-assessment-report')); ?>"><?php echo app('translator')->get('lang.contonuous'); ?> <?php echo app('translator')->get('lang.assessment'); ?> <?php echo app('translator')->get('lang.report'); ?></a>

                                        </li>

                                        <li>

                                            <a href="<?php echo e(route('resultreports/termly-academic-report')); ?>"><?php echo app('translator')->get('lang.termly'); ?> <?php echo app('translator')->get('lang.academic'); ?> <?php echo app('translator')->get('lang.report'); ?></a>

                                        </li>

                                        <li>

                                            <a href="<?php echo e(route('resultreports/academic-performance-report')); ?>"><?php echo app('translator')->get('lang.academic'); ?> <?php echo app('translator')->get('lang.performance'); ?> <?php echo app('translator')->get('lang.report'); ?></a>

                                        </li>

                                        <li>

                                            <a href="<?php echo e(route('resultreports/terminal-report-sheet')); ?>"><?php echo app('translator')->get('lang.terminal'); ?> <?php echo app('translator')->get('lang.report'); ?> <?php echo app('translator')->get('lang.sheet'); ?></a>

                                        </li>

                                        <li>

                                            <a href="<?php echo e(route('resultreports/continuous-assessment-sheet')); ?>"><?php echo app('translator')->get('lang.continuous'); ?> <?php echo app('translator')->get('lang.assessment'); ?> <?php echo app('translator')->get('lang.sheet'); ?></a>

                                        </li>

                                        <li>

                                            <a href="<?php echo e(route('resultreports/result-version-two')); ?>"><?php echo app('translator')->get('lang.result'); ?> <?php echo app('translator')->get('lang.version'); ?>

                                                V2</a>

                                        </li>

                                        <li>

                                            <a href="<?php echo e(route('resultreports/result-version-three')); ?>"><?php echo app('translator')->get('lang.result'); ?> <?php echo app('translator')->get('lang.version'); ?>

                                                V3

                                            </a>

                                        </li>

                                        

                                    <?php endif; ?>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>

                    

                    <?php if(userPermission(417)): ?>

                        <li>

                            <a href="#subMenuUserManagement" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-authentication"></span>

                                <?php echo app('translator')->get('lang.role'); ?> <?php echo app('translator')->get('lang.&'); ?> <?php echo app('translator')->get('lang.permission'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenuUserManagement">

                                <?php if(userPermission(585)): ?>

                                    <li>

                                        <a href="<?php echo e(route('rolepermission/role')); ?>"><?php echo app('translator')->get('lang.role'); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if(userPermission(421)): ?>

                                    <li>

                                        <a href="<?php echo e(route('login-access-control')); ?>"><?php echo app('translator')->get('lang.login_permission'); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>

                    

                    <?php if(userPermission(398)): ?>

                        <li>

                            <a href="#subMenusystemSettings" data-toggle="collapse" aria-expanded="false"

                               class="dropdown-toggle">

                                <span class="flaticon-settings"></span>

                                <?php echo app('translator')->get('lang.system_settings'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="subMenusystemSettings">





                                

                                <?php if(userPermission(424)): ?>

                                    <li>

                                        <a href="<?php echo e(route('class_optional')); ?>"><?php echo app('translator')->get('lang.optional'); ?> <?php echo app('translator')->get('lang.subject'); ?> <?php echo app('translator')->get('lang.setup'); ?></a>

                                    </li>

                                <?php endif; ?>



                                <?php if(userPermission(121)): ?>

                                    

                                <?php endif; ?>



                                <?php if(userPermission(432)): ?>

                                    <li>

                                        <a href="<?php echo e(route('academic-year')); ?>"><?php echo app('translator')->get('lang.academic_year'); ?></a>

                                    </li>

                                <?php endif; ?>



                                <?php if(userPermission(440)): ?>

                                    <li>

                                        <a href="<?php echo e(route('holiday')); ?>"><?php echo app('translator')->get('lang.holiday'); ?></a>

                                    </li>

                                <?php endif; ?>



                                <?php if(userPermission(448)): ?>

                                    <li>

                                        <a href="<?php echo e(url('weekend')); ?>"><?php echo app('translator')->get('lang.weekend'); ?></a>

                                    </li>

                                <?php endif; ?>



                                

                                <?php if(moduleStatusCheck('Saas')== FALSE   ): ?>

                                    <?php echo $__env->make('backEnd/partials/without_saas_school_admin_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>

                    <?php if(moduleStatusCheck('Saas')== FALSE): ?>

                        <?php if(userPermission(485)): ?>

                            <li>

                                <a href="#subMenusystemStyle" data-toggle="collapse" aria-expanded="false"

                                   class="dropdown-toggle">

                                    <span class="flaticon-consultation"></span>

                                    <?php echo app('translator')->get('lang.style'); ?>

                                </a>

                                <ul class="collapse list-unstyled" id="subMenusystemStyle">

                                    <?php if(userPermission(486)): ?>

                                        <li>

                                            <a href="<?php echo e(route('background-setting')); ?>"><?php echo app('translator')->get('lang.background_settings'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(490)): ?>

                                        <li>

                                            <a href="<?php echo e(route('color-style')); ?>"><?php echo app('translator')->get('lang.color'); ?> <?php echo app('translator')->get('lang.theme'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                </ul>

                            </li>

                        <?php endif; ?>

                    <?php endif; ?>

                    <?php if(moduleStatusCheck('Saas')== FALSE): ?>

                        <?php if(userPermission(492)): ?>

                            <li>

                                <a href="#subMenufrontEndSettings" data-toggle="collapse" aria-expanded="false"

                                   class="dropdown-toggle">

                                    <span class="flaticon-software"></span>

                                    <?php echo app('translator')->get('lang.front_settings'); ?>

                                </a>

                                <ul class="collapse list-unstyled" id="subMenufrontEndSettings">

                                    <?php if(userPermission(650)): ?>

                                        <li>

                                            <a href="<?php echo e(route('header-menu-manager')); ?>"><?php echo app('translator')->get('lang.header'); ?> <?php echo app('translator')->get('lang.menu'); ?> <?php echo app('translator')->get('lang.manager'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(493)): ?>

                                        <li>

                                            <a href="<?php echo e(route('admin-home-page')); ?>"> <?php echo app('translator')->get('lang.home_page'); ?> </a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(523)): ?>

                                        <li>

                                            <a href="<?php echo e(route('news-heading-update')); ?>"><?php echo app('translator')->get('lang.news_heading'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(500)): ?>

                                        <li>

                                            <a href="<?php echo e(route('news-category')); ?>"><?php echo app('translator')->get('lang.news'); ?> <?php echo app('translator')->get('lang.category'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(495)): ?>

                                        <li>

                                            <a href="<?php echo e(route('news_index')); ?>"><?php echo app('translator')->get('lang.news_list'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(525)): ?>

                                        <li>

                                            <a href="<?php echo e(route('course-heading-update')); ?>"><?php echo app('translator')->get('lang.course_heading'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(525)): ?>

                                        <li>

                                            <a href="<?php echo e(route('course-details-heading')); ?>"><?php echo app('translator')->get('lang.course_details_heading'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(673)): ?>

                                        <li>

                                            <a href="<?php echo e(route('course-category')); ?>"><?php echo app('translator')->get('lang.course'); ?> <?php echo app('translator')->get('lang.category'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(509)): ?>

                                        <li>

                                            <a href="<?php echo e(route('course-list')); ?>"><?php echo app('translator')->get('lang.course_list'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(504)): ?>

                                        <li>

                                            <a href="<?php echo e(route('testimonial_index')); ?>"><?php echo app('translator')->get('lang.testimonial'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(514)): ?>

                                        <li>

                                            <a href="<?php echo e(route('conpactPage')); ?>"><?php echo app('translator')->get('lang.contact'); ?> <?php echo app('translator')->get('lang.page'); ?> </a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(517)): ?>

                                        <li>

                                            <a href="<?php echo e(route('contactMessage')); ?>"><?php echo app('translator')->get('lang.contact'); ?> <?php echo app('translator')->get('lang.message'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(520)): ?>

                                        <li>

                                            <a href="<?php echo e(route('about-page')); ?>"> <?php echo app('translator')->get('lang.about_us'); ?> </a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(529)): ?>

                                        <li>

                                            <a href="<?php echo e(route('social-media')); ?>"> <?php echo app('translator')->get('lang.social_media'); ?> </a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(654)): ?>

                                        <li>

                                            <a href="<?php echo e(route('page-list')); ?>"><?php echo app('translator')->get('lang.pages'); ?></a>

                                        </li>

                                    <?php endif; ?>

                                    <?php if(userPermission(527)): ?>

                                        <li>

                                            <a href="<?php echo e(route('custom-links')); ?>"> <?php echo app('translator')->get('lang.footer_widget'); ?> </a>

                                        </li>

                                    <?php endif; ?>

                                </ul>

                            </li>

                        <?php endif; ?>

                    <?php endif; ?>

                    <?php if(moduleStatusCheck('Saas')== TRUE  && Auth::user()->is_administrator != "yes" ): ?>

                        <li>

                            <a href="#Ticket" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                                <span class="flaticon-settings"></span>

                                <?php echo app('translator')->get('lang.ticket_system'); ?>

                            </a>

                            <ul class="collapse list-unstyled" id="Ticket">

                                <li>

                                    <a href="<?php echo e(route('school/ticket-view')); ?>"><?php echo app('translator')->get('lang.ticket_list'); ?></a>

                                </li>

                            </ul>

                        </li>

                    <?php endif; ?>

                       <!-- End Parents Panel Menu -->

                <!-- Zoom Menu -->


        <!-- End Zoom Menu -->

            <!-- BBB Menu -->

            

            <?php if(moduleStatusCheck('BBB') == true): ?>

                <?php echo $__env->make('bbb::menu.bigbluebutton_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php endif; ?>

        <!-- End BBB Menu -->

        <!-- Jitsi Menu -->

            <?php if(moduleStatusCheck('Jitsi')==true): ?>

                  <?php echo $__env->make('jitsi::menu.jitsi_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <?php endif; ?>

          <!-- End Jitsi Menu -->     

                 <?php endif; ?> 

                <?php endif; ?>



            <!-- Student Panel -->

                <?php if(Auth::user()->role_id == 2): ?>                   

                    <?php echo $__env->make('backEnd/partials/student_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php endif; ?>

            <!-- End student panel -->

                <!-- Parents Panel Menu -->

                <?php if(Auth::user()->role_id == 3): ?>

                    <?php echo $__env->make('backEnd/partials/parents_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php endif; ?>

          

            <?php endif; ?>

        </ul>

    <?php endif; ?>

    <?php if(Auth::user()->is_saas == 1): ?>

        <?php echo $__env->make('saasrolepermission::menu.SaasAdminMenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php endif; ?>

    <?php if(Auth::user()->is_saas == 1 && Auth::user()->role_id != 1): ?>

        <ul class="list-unstyled components">

            <li>

                <a href="<?php echo e(route('saas/institution-list')); ?>" id="superadmin-dashboard">

                    <span class="flaticon-analytics"></span>

                    institution List

                </a>

            </li>

        </ul>

    <?php endif; ?>

</nav>

<?php /**PATH /opt/lampp/htdocs/sikkha/resources/views/backEnd/partials/sidebar.blade.php ENDPATH**/ ?>