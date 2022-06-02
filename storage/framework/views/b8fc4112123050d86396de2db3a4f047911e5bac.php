                    <?php if(userPermission(399)): ?>
                        <li>
                            <a href="<?php echo e(route('manage-adons')); ?>"><?php echo app('translator')->get('lang.module'); ?> <?php echo app('translator')->get('lang.manager'); ?></a>
                        </li>
                    <?php endif; ?>

                        <?php if(userPermission(401)): ?>
                                <li>
                                    <a href="<?php echo e(route('manage-currency')); ?>"><?php echo app('translator')->get('lang.manage'); ?> <?php echo app('translator')->get('lang.currency'); ?></a>
                                </li>
                        <?php endif; ?>

                       <?php if(userPermission(410)): ?>

                            <li>
                                <a href="<?php echo e(route('email-settings')); ?>"><?php echo app('translator')->get('lang.email_settings'); ?></a>
                            </li>
                        <?php endif; ?>
                       

                       <?php if(userPermission(428)): ?>

                                <li>
                                    <a href="<?php echo e(route('base_setup')); ?>"><?php echo app('translator')->get('lang.base_setup'); ?></a>
                                </li>
                         <?php endif; ?>

                         <?php if(userPermission(549)): ?>

                            <li>
                                <a href="<?php echo e(route('language-list')); ?>"><?php echo app('translator')->get('lang.language'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(userPermission(451)): ?>

                            <li>
                                <a href="<?php echo e(route('language-settings')); ?>"><?php echo app('translator')->get('lang.language_settings'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(userPermission(456)): ?>

                            <li>
                                <a href="<?php echo e(route('backup-settings')); ?>"><?php echo app('translator')->get('lang.backup_settings'); ?></a>
                            </li>
                        <?php endif; ?>
                        
                       <?php if(userPermission(444)): ?>

                            <li>
                                <a href="<?php echo e(route('sms-settings')); ?>"><?php echo app('translator')->get('lang.sms_settings'); ?></a>
                            </li>
                        <?php endif; ?>
                       
                        <?php if(userPermission(463)): ?>
                            <li>
                                <a href="<?php echo e(route('button-disable-enable')); ?>"><?php echo app('translator')->get('lang.header'); ?> <?php echo app('translator')->get('lang.option'); ?> </a>
                            </li>
                        <?php endif; ?>


                        <?php if(userPermission(477)): ?>

                            <li>
                                <a href="<?php echo e(route('about-system')); ?>"><?php echo app('translator')->get('lang.about'); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(userPermission(478)): ?>

                            <li>
                                <a href="<?php echo e(route('update-system')); ?>"><?php echo app('translator')->get('lang.update'); ?></a>
                            </li>
                        <?php endif; ?>
                       
                        
                            
                        
                        <?php if(userPermission(482)): ?>
                        <li>
                            <a href="<?php echo e(route('api/permission')); ?>"><?php echo app('translator')->get('lang.api'); ?> <?php echo app('translator')->get('lang.permission'); ?> </a>
                        </li>
                    <?php endif; ?>
                    
<?php /**PATH C:\xampp\htdocs\sikkha\resources\views/backEnd/partials/without_saas_school_admin_menu.blade.php ENDPATH**/ ?>