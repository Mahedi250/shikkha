<?php $__env->startPush('css'); ?>
   <!-- <link rel="stylesheet" href="<?php echo e(asset('public/')); ?>/frontend/css/new_style.css"/> -->
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main_content'); ?>
 
  <?php

  $testimonial=App\SmTestimonial::all();
 // dd($testimonial);
  ?>
      
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title">
                        <h3>Governing Body</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <section class="page-content">
        <div class="container">
        
            <div class="row">
                <div class="col-md-9">
                 <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                       
                       
                       <div class="col-sm-2 col-md-4">
                         
                       </div>
                        <div class="col-sm-10 col-md-4">
                            <div class="governing-box">
                                <div class="teacherImageMain">
                                    <a href="#" data-toggle="modal" data-target="#exampleModal2">
                                        <div class="teacherImage">
                                            <img src="<?php echo e(asset($value->image)); ?>" alt="Miss Watson" class="d-block w-100">

                                         
                                        </div>
                                        <div class="teacherName">
                                            <h4><?php echo e($value->name); ?></h4>
                                            <p><?php echo e($value->designation); ?></p>
                                       </div>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                         
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    </div>
                
                <div class="col-md-3">
                    <div class="page-sidebar mt-2">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i> Related Topics
                    </div>
                    <div class="page-sidebar-list">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="<?php echo e(url('/')); ?>/about"><i class="fa fa-angle-double-right"
                                        aria-hidden="true"></i>Why Choose Us</a></li>
                            <li class="list-group-item"><a href="<?php echo e(url('/')); ?>/message"><i
                                        class="fa fa-angle-double-right" aria-hidden="true"></i> Message </a></li>
                           
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
<?php echo $__env->make('frontEnd.home.front_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/sikkha/resources/views/frontEnd/home/governingbody.blade.php ENDPATH**/ ?>