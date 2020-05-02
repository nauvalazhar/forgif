<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Forgif is a GIF sharing site, on this site you can find various GIF animations that other people and your friends are sharing. Just start by signing up for free and start sharing your GIF.">
    <meta name="keyword" content="Forgif, GIF sharing site, free GIF, social networking, social media, funnies GIF">
    <?php echo $__env->yieldContent('og'); ?>
    <link rel="shortcut icon" href="<?php echo e(url(config('app.icon'))); ?>">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title'); ?> &mdash; <?php echo e(config('app.name', 'Forgif')); ?></title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('scripts/bootstrap-tour/build/css/bootstrap-tour.min.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <div id="app">
    <?php if(@$navbar !== false): ?>
        <nav class="navbar navbar-default navbar-static-top <?php echo e(Auth::check() && (Auth::user()->status == NULL || !Auth::user()->password) ? 'has-topbar' : ''); ?>">
            <?php if(Auth::check() && Auth::user()->status == NULL): ?>
            <div class="topbar">
                <div class="container-fluid">
                    <strong>Welcome to <?php echo e(config('app.name')); ?>!</strong> You need to activate your account. Please, check your email.
                </div>
            </div>
            <?php elseif(Auth::check() && !Auth::user()->password): ?>
            <div class="topbar">
                <div class="container-fluid">
                    <strong>Welcome to <?php echo e(config('app.name')); ?>!</strong> Just set your password then you can login with your email. <a href="<?php echo e(route('users.settings')); ?>">Go to settings</a>.
                </div>
            </div>
            <?php endif; ?>
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <div class="navbar-brand">
                        <a class="logo" href="<?php echo e(url('/')); ?>"><?php echo e(config('app.name', 'Laravel')); ?><span>.</span></a>
                        <div class="global-loader">                    
                            <img src="<?php echo e(url('media/loader.gif')); ?>">
                        </div>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <form class="navbar-form navbar-left" action="<?php echo e(route('users.search')); ?>">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" placeholder="Search" required="">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="ion-search"></i></button>                        
                                </div>                                
                            </div>
                        </div>
                    </form>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <?php if(Auth::guest()): ?>
                            <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                            <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle<?php echo e(count(Friends::request()) > 0 ? ' dotme': ''); ?>" data-toggle="dropdown">
                                    <i class="ion-person-stalker"></i> <span class="text">Forgif Request</span>
                                </a>
                                <div class="dropdown-menu user-menu">
                                    <h4 class="title-block">Forgif Request</h4>
                                    <?php if(count(Friends::request())): ?>
                                    <ul class="user-list">
                                        <?php $__currentLoopData = Friends::request(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="confirm-list-<?php echo e($user->users->id); ?>">
                                            <figure>
                                                <a href="">
                                                    <img src="<?php echo avatar($user->users->picture.'_md'); ?>" alt="<?php echo e($user->users->name); ?>">
                                                </a>
                                            </figure>
                                            <div class="desc">
                                                <div class="name"><a href=""><?php echo e($user->users->name); ?></a></div>
                                                <div class="action">
                                                <?php echo forgifButton($user->users); ?>

                                                </div>
                                            </div>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <?php else: ?>
                                    <p class="text-center"><i>You have no forgif request</i></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li>
                                <a href="<?php echo e(route('users.detail', Auth::user()->username)); ?>">
                                    <div><?php echo e(firstname(Auth::user()->name)); ?></div>
                                    <div class="avatar">
                                        <img src="<?php echo e(avatar(Auth::user()->picture)); ?>">
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="ion-gear-b"></i> <span class="text">Options</span></a>
                                <div class="dropdown-menu user-options" role="menu">
                                    <h4 class="title-block">Options</h4>
                                    <ul>
                                        <li><a href="<?php echo e(route('users.friends')); ?>"><i class="ion ion-person"></i> Find Friends</a></li>
                                        <?php if(isAdmin()): ?>
                                        <li><a href="<?php echo e(route('report.list')); ?>"><i class="ion ion-alert-circled"></i> Reports</a></li>
                                        <?php endif; ?>
                                        <?php if(isAdmin()): ?>
                                        <li><a href="<?php echo e(route('pages')); ?>"><i class="ion ion-document"></i> Pages</a></li>
                                        <?php endif; ?>
                                        <li><a href="<?php echo e(route('help')); ?>"><i class="ion ion-help"></i> Help Center</a></li>
                                        <li><a href="<?php echo e(route('users.settings', Auth::user()->username)); ?>"><i class="ion ion-gear-a"></i> Settings</a></li>
                                        <li>
                                            <a href="<?php echo e(route('logout')); ?>"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                <i class="ion ion-log-out"></i> Logout
                                            </a>

                                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                                <?php echo e(csrf_field()); ?>

                                            </form>
                                        </li>                                        
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php if(Auth::check()): ?>
                <div class="right-on-mobile">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo e(route('users.detail', Auth::user()->username)); ?>"><i class="ion-person"></i></a></li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </nav>
    <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>

        <?php if(@$footer !== false): ?>
        <footer class="footer main-footer">
            <div class="copyright">            
                Copyright &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. All Right Reserved.
            </div>
            <ul class="footer-nav">
                <li><a href="<?php echo e(route('pages.view', 'about')); ?>">About</a></li>
                <li><a href="<?php echo e(route('pages.view', 'contact')); ?>">Contact</a></li>
                <li><a href="<?php echo e(route('help')); ?>">Help</a></li>
            </ul>
        </footer>
        <?php endif; ?>
    </div>

    <!-- Scripts -->
    <script>var base_url = '<?php echo e(url('/')); ?>', appver = '<?php echo e(Auth::check() ? md5(Auth::user()->id) : md5(request()->ip)); ?>';</script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('scripts/autosize/dist/autosize.min.js')); ?>"></script>
    <script src="<?php echo e(asset('scripts/sticky.js')); ?>"></script>
    <script src="<?php echo e(asset('scripts/jquery.nicescroll.min.js')); ?>"></script>
    <script src="<?php echo e(asset('scripts/bootstrap-tour/build/js/bootstrap-tour.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
    <?php echo $__env->yieldContent('js'); ?>
</body>
</html>
