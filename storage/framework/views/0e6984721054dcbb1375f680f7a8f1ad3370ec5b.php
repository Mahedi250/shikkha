
<?php if(userPermission(554)): ?>
    <li data-position="" class="sortable_li">
        <a href="#zoomMenu" data-toggle="collapse" aria-expanded="false"
        class="dropdown-toggle">
            <span class="flaticon-reading"></span>
        Live Class
        </a>
        <ul class="collapse list-unstyled" id="zoomMenu">
            <?php if(userPermission(555)): ?>
                <li data-position="">
                    <a href="<?php echo e(route('zoom.virtual-class')); ?>"><?php echo app('translator')->get('lang.virtual_class'); ?></a>
                </li>
            <?php endif; ?>
            <?php if(userPermission(560)): ?>
                <li data-position="">
                    <a href="<?php echo e(route('zoom.meetings')); ?>"><?php echo app('translator')->get('lang.virtual_meeting'); ?></a>
                </li>
            <?php endif; ?>
            <?php if(userPermission(565)): ?>
                <li data-position="">
                    <a href="<?php echo e(route('zoom.virtual.class.reports.show')); ?>"><?php echo app('translator')->get('lang.class_reports'); ?></a>
                </li>
            <?php endif; ?>
            


            <?php if(userPermission(567)): ?>
                <li data-position="">
                    <a href="<?php echo e(route('zoom.meeting.reports.show')); ?>"><?php echo app('translator')->get('lang.meeting_reports'); ?></a>
                </li>
            <?php endif; ?>
            <?php if(userPermission(569)): ?>
                <li data-position="">
                    <a href="<?php echo e(route('zoom.settings')); ?>"><?php echo app('translator')->get('lang.settings'); ?></a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
    <!-- Zoom Menu  -->
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\sikkha\Modules/Zoom\Resources/views/menu/Zoom.blade.php ENDPATH**/ ?>