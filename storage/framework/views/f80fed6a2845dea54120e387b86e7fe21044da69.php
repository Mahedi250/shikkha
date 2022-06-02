<?php $__env->startSection('main_content'); ?>
  <?php



//dd($noticeID);

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
             <?php if(isset($noticeID)): ?>
                
                <div class="col-md-8">                   
                     <div class="notice-box">
                         <h5>Notice: <?php echo e($noticeID->notice_title); ?> </h5>
                     
                    </div>
                     <div class="notice-box">
                         <h5>Details: <?php echo e($noticeID->notice_message); ?> </h5>
                     
                    </div>
                </div>
        
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


<?php echo $__env->make('frontEnd.home.front_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/sikkha/resources/views/frontEnd/home/lightnoticeid.blade.php ENDPATH**/ ?>