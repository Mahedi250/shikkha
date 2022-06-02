<?php $__env->startSection('main_content'); ?>
  <?php

$noticeboard =App\SmNoticeBoard::all();
//dd($noticeboard);

  ?>
    
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title">
                        <h3>Notice Board</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <div class="row">
             <?php if(isset($noticeboard)): ?>
                 <?php $__currentLoopData = $noticeboard; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-8">
                    
                        
                        <h6> Date: <?php echo e($notice->publish_on != ""? dateConvert($notice->publish_on):''); ?></h6>
                        
                        
                    
                     <div class="notice-box">
                         <h5>Notice: <?php echo e($notice->notice_title); ?> </h5>
                        <a href="notice-board/<?php echo e($notice->id); ?>" class="mobile-off">See More</a>
                    </div>
                     <div class="notice-box">
                         <h5>Details: <?php echo e($notice->notice_message); ?> </h5>
                     
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <div class="col-md-4">
                    <div class="page-sidebar mt-2">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i> Related Topics
                    </div>
                    <div class="page-sidebar-list">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="<?php echo e(url('/')); ?>/noticeboard"><i class="fa fa-angle-double-right"
                                        aria-hidden="true"></i> Notice Board</a></li>
                      
                            
                          

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

 
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontEnd.home.front_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/sikkha/resources/views/frontEnd/home/lightnoticeboard.blade.php ENDPATH**/ ?>