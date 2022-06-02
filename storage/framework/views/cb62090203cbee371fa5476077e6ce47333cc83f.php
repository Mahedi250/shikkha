<?php $__env->startPush('css'); ?>
   <!-- <link rel="stylesheet" href="<?php echo e(asset('public/')); ?>/frontend/css/new_style.css"/> -->
<?php $__env->stopPush(); ?>
<?php
$missions = App\SmAboutPage::first();
//dd($missions);
?>
<?php $__env->startSection('main_content'); ?>
 
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title">
                        <h3><?php echo e($missions->title); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="quote-details">
                        <div class="quote-img">
                            <img src="<?php echo e($missions->image); ?>" width="100%" height="300px" alt="">
                            <div class="details mt-4">
                                <p><?php echo e($missions->description); ?></p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="page-sidebar mt-2">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i> Related Topics
                    </div>
                    <div class="page-sidebar-list">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="<?php echo e(url('/')); ?>/about"><i class="fa fa-angle-double-right"
                                        aria-hidden="true"></i>Why Choose Us</a></li>
                            <li class="list-group-item"><a href="<?php echo e(url('/')); ?>/message"><i
                                        class="fa fa-angle-double-right" aria-hidden="true"></i> Message 
                                    </a></li>
                            
                            <li class="list-group-item"><a href="<?php echo e(url('/')); ?>/governingbody"><i
                                        class="fa fa-angle-double-right" aria-hidden="true"></i> Governing Body</a></li>
                            <li class="list-group-item"><a href="<?php echo e(url('/')); ?>/mission"><i
                                        class="fa fa-angle-double-right" aria-hidden="true"></i> Mission & Vision</a>
                            </li>
                           

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontEnd.home.front_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/sikkha/resources/views/frontEnd/home/missionvision.blade.php ENDPATH**/ ?>