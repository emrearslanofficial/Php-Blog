<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <meta name="theme-name" content="quixlab" />
    <title>Emmedya - Admin Paneli</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../../admin/images/favicon.png">
    <link href="../../admin/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../admin/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="../../admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <link href="../../admin/css/style.css" rel="stylesheet">
</head>
<body>
    <div id="main-wrapper">
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.html">
                    <b class="logo-abbr">EMMEDYA</b>
                    <span class="logo-compact">EMMEDYA</span>
                    <span class="brand-title">
                        <h3 style="color:white;">EMMEDYA</h3>
                    </span>
                </a>
            </div>
        </div>

        <div class="header">    
            <div class="header-content clearfix">
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="/<?php echo $_SESSION['image'];?>" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="/logout.php"><i class="icon-key"></i> <span>Çıkış</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>