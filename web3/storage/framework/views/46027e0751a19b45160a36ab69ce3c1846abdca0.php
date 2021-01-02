<?php $__env->startSection('content'); ?> 
    
        <?php if(count($posts) > 0): ?>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <section class="wrapper style1">
                        <div class="inner">
                <div class="flex flex-3">
                    <div class="col align-center">
                        <h1><?php echo e($post->title); ?></h1>
                        <div class="image round fit">
                            <img src="images/pic03.jpg" alt="" />
                        </div>
                        <p>Sed congue elit malesuada nibh, a varius odio vehicula aliquet. Aliquam consequat, nunc quis sollicitudin aliquet. </p>
                        <p><small>Written on <?php echo e($post->created_at); ?></small></p>
                        <a href="posts/<?php echo e($post->id); ?>" class="button">Learn More</a>
                    </div>
                </div>
            </section>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($posts->links()); ?>

        <?php else: ?>
            <p> No posts found</p>
        <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web32\resources\views/posts/index.blade.php ENDPATH**/ ?>