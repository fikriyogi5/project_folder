<?php
function generateHeader($headerOptions) {
	// $headerOptions = [
	//     'title' => 'Selamat Datang',
	//     'header_menu' => 1, // 1 for Home, 0 for Back
	//     'link_back' => '#',
	//     'icon' => 'fa-indent',
	//     'header_title' => 'Welcome',
	//     'footer_menu' => 1, // 1 for Tab Menu, 0 for none
	//     'header_style' => 'header-clear-small',
	// ];

	// echo generateHeader($headerOptions);

    $title = $headerOptions['title'];
    $is_jquery = 1;
    $is_bootstrap = 1;
    $header_menu = $headerOptions['header_menu'];
    $header_title = $headerOptions['header_title'];
    $link_back = $headerOptions['link_back'];
    $icon = $headerOptions['icon'];
    $footer_menu = $headerOptions['footer_menu'];
    $header_style = $headerOptions['header_style'];

    $html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <script src="scripts/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="scripts/bootstrap.min.js"></script>
    <script type="text/javascript" src="scripts/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js">
    </script>
    <title>' . $title . '</title>
</head>
<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default">

<div id="page">';
    if ($header_menu == 1) {
        $html .= '<div class="header header-fixed header-logo-center" style="transform: translateX(0px);">
            <a href="index.php" class="header-title">' . $header_title . '</a>
            <a href="' . $link_back . '" data-menu="menu-sidebar-left-4" class="header-icon header-icon-1">
                <i class="fas ' . $icon . ' font-18"></i>
            </a>
            <a href="#" data-toggle-theme="" class="header-icon header-icon-4"><i class="fas fa-lightbulb font-18"></i></a>
            <a href="search_homepage.php" class="header-icon header-icon-3"><i class="fas fa-search"></i></a>

        </div>';
    } else {
        $html .= '<div class="header header-fixed header-logo-center">
        <a href="index.php" class="header-title">' . $header_title . '</a>
        <a href="' . $link_back . '" class="header-icon header-icon-1"><i class="fas ' . $icon . '"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-4"><i class="fas fa-lightbulb"></i></a>
        <a href="search_homepage.php" class="header-icon header-icon-3"><i class="fas fa-search"></i></a>
    </div>';
    }
    
    if ($footer_menu == 1) {
        $html .= '<div id="footer-bar" class="footer-bar-4 ">
                <a href="#" class="tab-link active-nav" data-tab="tab-1">
                <img src="   https://cdn-icons-png.flaticon.com/512/4481/4481380.png " width="30" height="30" alt="" title="" class="img-small">

                    <span>Beranda</span>
                </a>
                <a href="#" class="tab-link" data-tab="tab-2">
                <img src="   https://cdn-icons-png.flaticon.com/512/4481/4481070.png " width="30" height="30" alt="" title="" class="img-small">
                    <span>Info</span>
                </a>
                <a href="#" class="tab-link" data-tab="tab-3">
                <img src="   https://cdn-icons-png.flaticon.com/512/4481/4481387.png " width="30" height="30" alt="" title="" class="img-small">
                    <span>Agenda</span>
                </a>
                <a href="#" class="tab-link" data-tab="tab-4">
                <img src="   https://cdn-icons-png.flaticon.com/512/4481/4481135.png " width="30" height="30" alt="" title="" class="img-small">
                    <span>sdssa</span>
                </a>
                <a href="#" class="tab-link" data-tab="tab-5">
                <img src="   https://cdn-icons-png.flaticon.com/512/4481/4481330.png " width="30" height="30" alt="" title="" class="img-small">
                    <span>Settings</span>
                </a>
            </div>';
    }

    $html .= '<div class="page-content ' . $header_style . '">';
    return $html;
}