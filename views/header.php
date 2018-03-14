<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Magic LINK</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="../scripts/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../scripts/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../scripts/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect. -->
        <link rel="stylesheet" href="../scripts/css/skins/skin-blue.min.css">
         

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="home.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>Mg</b>L</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Magic&nbsp;</b>LINK</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!--Menu Toggle Button--> 
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!--The user image in the navbar-->
                                    <?php
                                    if ($_SESSION['img_user'] != null) {
                                        ?>
                                        <img src="../img/<?= $_SESSION['img_user'] ?>" class="user-image" alt="User Image">
                                        <?php
                                    } else {
                                        ?>
                                        <img src="../img/default.jpg" class="user-image" alt="User Image">
                                        <?php
                                    }
                                    ?>
                                    <!--hidden-xs hides the username on small devices so only the image appears.--> 
                                    <span class="hidden-xs"><?= $_SESSION['nome'] ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!--The user image in the menu--> 
                                    <li class="user-header">
                                        <?php
                                        if ($_SESSION['img_user'] != null) {
                                            ?>
                                            <img src="../img/<?= $_SESSION['img_user'] ?>" class="img-circle" alt="User Image">
                                            <?php
                                        } else {
                                            ?>
                                            <img src="../img/default.jpg" class="img-circle" alt="User Image">
                                            <?php
                                        }
                                        ?>
                                        <p>
                                            <?= $_SESSION['nome'] ?>
                                            <small><?= $_SESSION['email'] ?></small>
                                        </p>
                                    </li>
                                    <!--Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="../index.php" class="btn btn-default btn-flat">
                                                <i class="fa fa-sign-out"></i>&nbsp;Sair
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <!--          <li>
                                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                                      </li>-->
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- search form (Optional) -->
                    <!--      <form action="#" method="get" class="sidebar-form">
                            <div class="input-group">
                              <input type="text" name="q" class="form-control" placeholder="Search...">
                              <span class="input-group-btn">
                                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                  </button>
                                </span>
                            </div>
                          </form>-->
                    <!-- /.search form -->

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header text-center">Configurações</li>
                        <!-- Optionally, you can add icons to the links -->
                        <li class="active"><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-user-plus"></i> <span>Cadastro de Pessoa</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="cadastro_pessoa_fisica.php"><i class="fa fa-circle-o"></i>Pessoa Fisica</a></li>
                                <li><a href="#"><i class="fa fa-circle-o"></i>Pessoa Juridica</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
                    </ul>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content container-fluid">
                    <!--------------------------
                    | Your Page Content Here |
                    -------------------------->
