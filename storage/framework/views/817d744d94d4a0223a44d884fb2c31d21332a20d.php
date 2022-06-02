<?php $__env->startPush('css'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('public/')); ?>/frontend/css/new_style.css"/>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('main_content'); ?>

    <!--================ Home Banner Area =================-->

  

    <!--================ End Home Banner Area =================-->



   <!--================ News Details Area =================-->

    <section class="news-details-area ">

        <div class="container">

            <div class="row">

                <div class="col-lg-10">

                    <h1><?php echo e($news->news_title); ?></h1>

                    <div class="meta mb-30 d-flex flex-md-row flex-column">

                        <div class="date text-uppercase">

                            <span class="ti-calendar mr-10"></span>   

                            <?php echo e($news->publish_date != ""? dateConvert($news->publish_date):''); ?>


                        </div>

                        <div class="date text-uppercase">

                            <span class="ti-map-alt mr-10"></span>

                            <?php echo e($news->category->category_name); ?>


                        </div>

                    </div>

                    <div class="news-img">

                        <img class="img-fluid news-image" src="<?php echo e(asset($news->image)); ?>" alt="<?php echo e($news->news_title); ?>">

                    </div>

                    <p class="mt-2">

                        <?php echo $news->news_body; ?>


                    </p>



                </div>



                <div class="col-lg-2 notice-board-area">
                 

                </div>

            </div>

        </div>

    </section>

    <!--================ End News Details Area =================-->

    

    <!--================ Related News Area =================-->

    <section class="news-area section-gap-top">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="row">

                        <div class="col-lg-12">

                            <h3 class="title"><?php echo app('translator')->get('lang.related_news'); ?></h3>

                        </div>

                    </div>

                    <div class="row">

                        <?php $__currentLoopData = $otherNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theNews): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="col-lg-3 col-md-6">

                            <div class="news-item">

                                <div class="news-img">

                                    <img class="img-fluid w-100 news-image" src="<?php echo e(asset($theNews->image)); ?>" alt="">

                                </div>

                                <div class="news-text">

                                    <p class="date">

                                        

<?php echo e($theNews->publish_date != ""? dateConvert($theNews->publish_date):''); ?>




                                    </p>

                                    <h4>

                                        <a href="<?php echo e(url('news-details/'.$theNews->id)); ?>">

                                            <?php echo e($theNews->news_title); ?>


                                        </a>

                                    </h4>

                                </div>

                            </div>

                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!--================ End Related News Area =================-->

<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontEnd.home.front_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/sikkha/resources/views/frontEnd/home/light_news_details.blade.php ENDPATH**/ ?>