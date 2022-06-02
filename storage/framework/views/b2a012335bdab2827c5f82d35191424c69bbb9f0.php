<li>
    <a href="#subMenuChat" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <span class="flaticon-test"></span>
        <?php echo app('translator')->get('lang.chat'); ?>
    </a>
    <ul class="collapse list-unstyled" id="subMenuChat">
        <?php if(userPermission(901) || userPermission(911)): ?>
        <li>
            <a href="<?php echo e(route('chat.index')); ?>"><?php echo app('translator')->get('lang.chat'); ?> <?php echo app('translator')->get('lang.box'); ?></a>
        </li>
        <?php endif; ?>

        <?php if(userPermission(903) || userPermission(913)): ?>
        <li>
            <a href="<?php echo e(route('chat.invitation')); ?>"><?php echo app('translator')->get('lang.invitation'); ?></a>
        </li>
        <?php endif; ?>

        <?php if(userPermission(904) || userPermission(914)): ?>
            <li>
                <a href="<?php echo e(route('chat.blocked.users')); ?>"><?php echo app('translator')->get('lang.blocked'); ?> <?php echo app('translator')->get('lang.user'); ?></a>
            </li>
        <?php endif; ?>

        <?php if(userPermission(905)): ?>
            <li>
                <a href="<?php echo e(route('chat.settings')); ?>"><?php echo app('translator')->get('lang.settings'); ?></a>
            </li>
        <?php endif; ?>
    </ul>
</li>
<?php /**PATH /opt/lampp/htdocs/sikkha/Modules/Chat/Resources/views/menu.blade.php ENDPATH**/ ?>