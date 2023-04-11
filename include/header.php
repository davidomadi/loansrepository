<?php 



require_once("cnx.php");
require("database.php");


$ths_pg = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);



function countLoans($account){
    require("cnx.php");

    $l=$conn->query("SELECT COUNT(*) AS loans FROM bank_loans WHERE account_number='{$account}'");

    $loans = $l->fetch_assoc();
    return $loans['loans'];
}

function countDigit($number) {
  return strlen($number);
}

?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Loans Tracker">
    <meta name="keywords" content="Loans Tracker">
    <meta name="author" content="David Omadi">
    <title>Loans Tracker</title>
    <link rel="apple-touch-icon" href="app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/animate-css/animate.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/chartist-js/chartist.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/chartist-js/chartist-plugin-tooltip.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/horizontal-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/horizontal-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/layouts/style-horizontal.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/dashboard-modern.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/intro.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/form-select2.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/custom/custom.css">
    <!-- END: Custom CSS-->

    <script>
			function del_item(ID, TABLE)
			{
			var r=confirm("Are you sure you want to Remove this Record from your list?");
			if (r==true)
			  {
			  window.location='?delete&item='+ID+'&table='+TABLE;
			  }
			}		

    </script>
</head>
<!-- END: Head-->

<body class="horizontal-layout page-header-light horizontal-menu preload-transitions 2-columns   " data-open="click" data-menu="horizontal-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-light-blue-cyan">
                <div class="nav-wrapper">
                    <ul class="left">
                        <li>
                            <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="dash.php"><img src="app-assets/images/logo/materialize-logo.png" alt="materialize logo"><span class="logo-text hide-on-med-and-down">LOANS-API</span></a></h1>
                        </li>
                    </ul>
                   
                    <ul class="navbar-list right">
                        <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="app-assets/images/avatar/avatar-7.png" alt="avatar"><i></i></span></a></li>
                    </ul>
                    <!-- profile-dropdown-->
                    <ul class="dropdown-content" id="profile-dropdown">
                        <li><a class="grey-text text-darken-1" href="include/do_signout.php"><i class="material-icons">keyboard_tab</i> Logout</a></li>
                    </ul>
                </div>
                <nav class="display-none search-sm">
                    <div class="nav-wrapper">
                        <form id="navbarForm">
                            <div class="input-field search-input-sm">
                                <input class="search-box-sm" type="search" required="" id="search" placeholder="Explore Materialize" data-search="template-list">
                                <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                                <ul class="search-list collection search-list-sm display-none"></ul>
                            </div>
                        </form>
                    </div>
                </nav>
            </nav>
            
        </div>
    </header>
    <!-- END: Header-->