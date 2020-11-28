<?php $__env->startSection('content'); ?>
    <div class="login-container">

        <p><?php echo e(__('voyager::login.signin_below')); ?></p>

        <form action="<?php echo e(route('voyager.login')); ?>" method="POST">
            <?php echo e(csrf_field()); ?>

            <div class="form-group form-group-default" id="emailGroup">
                <label><?php echo e(__('voyager::generic.email')); ?></label>
                <div class="controls">
                    <input type="text" name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('voyager::generic.email')); ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group form-group-default" id="passwordGroup">
                <label><?php echo e(__('voyager::generic.password')); ?></label>
                <div class="controls">
                    <input type="password" name="password" placeholder="<?php echo e(__('voyager::generic.password')); ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group" id="rememberMeGroup">
                <div class="controls">
                    <input type="checkbox" name="remember" id="remember" value="1"><label for="remember" class="remember-me-text"><?php echo e(__('voyager::generic.remember_me')); ?></label>
                </div>
            </div>

            <button type="submit" class="btn btn-block login-button">
                <span class="signingin hidden"><span class="voyager-refresh"></span> <?php echo e(__('voyager::login.loggingin')); ?>...</span>
                <span class="signin"><?php echo e(__('voyager::generic.login')); ?></span>
            </button>

        </form>

        <div style="clear:both"></div>

        <?php if(!$errors->isEmpty()): ?>
            <div class="alert alert-red">
                <ul class="list-unstyled">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($err); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

    </div> <!-- .login-container -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('post_js'); ?>

    <script>
        var btn = document.querySelector('button[type="submit"]');
        var form = document.forms[0];
        var email = document.querySelector('[name="email"]');
        var password = document.querySelector('[name="password"]');
        btn.addEventListener('click', function(ev){
            if (form.checkValidity()) {
                btn.querySelector('.signingin').className = 'signingin';
                btn.querySelector('.signin').className = 'signin hidden';
            } else {
                ev.preventDefault();
            }
        });
        email.focus();
        document.getElementById('emailGroup').classList.add("focused");

        // Focus events for email and password fields
        email.addEventListener('focusin', function(e){
            document.getElementById('emailGroup').classList.add("focused");
        });
        email.addEventListener('focusout', function(e){
            document.getElementById('emailGroup').classList.remove("focused");
        });

        password.addEventListener('focusin', function(e){
            document.getElementById('passwordGroup').classList.add("focused");
        });
        password.addEventListener('focusout', function(e){
            document.getElementById('passwordGroup').classList.remove("focused");
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('voyager::auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\test\adminpanel6\vendor\tcg\voyager\src/../resources/views/login.blade.php ENDPATH**/ ?>