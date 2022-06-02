<?php if(@in_array(542, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
    <li>
        <a href="#subMenuStudentRegistration" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <span class="flaticon-reading"></span>
            <?php echo app('translator')->get('lang.registration'); ?>
        </a>
        <ul class="collapse list-unstyled" id="subMenuStudentRegistration">
            <?php if(@in_array(543, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                <li>
                    <a href="<?php echo e(url('parentregistration/student-list')); ?>"> <?php echo app('translator')->get('lang.student_list'); ?></a>
                </li>
            <?php endif; ?>
            <?php if(App\SmGeneralSettings::isModule('Saas') != TRUE): ?>
                <?php if(@in_array(547, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1): ?>
                    <li>
                        <a href="<?php echo e(url('parentregistration/settings')); ?>"> <?php echo app('translator')->get('lang.settings'); ?></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\sikkha\Modules/ParentRegistration\Resources/views/menu/ParentRegistration.blade.php ENDPATH**/ ?>