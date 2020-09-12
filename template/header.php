<?php ob_start(); require_once(__DIR__ . '/../library/autoload.php'); ?>
<?php
if(is_login()) {
  $broken_count = $YuuClass->get_count('tb_broken', @$_user['email']);
  $broken_badge = ($broken_count >= 1) ? 'badge-danger' : 'badge-secondary';
}
$redirectURL = base64_encode(CURRENT_URL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf-8>
    <meta content="IE=edge" http-equiv=X-UA-Compatible>
    <meta content="width=device-width,initial-scale=1" name=viewport>
    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow">
    <meta name="description" content="Layanan Google Drive Sharer yg memudahkan kamu berbagi file kepada siapapun.">
    <meta name="keywords" content="otakushare, neemyid, google drive sharer, share google drive, yuudrive, download google drive sharer, download anime google drive, download film google drive">
    <meta name="revisit-after" content="1 days">
    <meta name="author" content="Ayanokōji">
<?php if(BASE_PAGE == 'file.php' || BASE_PAGE == 'list-file.php'): ?>
    <meta name="robots" content="noindex,nofollow">
    <meta name="googlebot" content="noindex,nofollow">
<?php endif;?>
    <meta property="og:description" content="<?= $app['description'];?>"/>
    <meta property="og:image" content="/assets/img/yui.jpg"/>
    <meta property="og:type" content="website"/>
    <title><?=  _NAME; ?> - <?= $app['description'];?></title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.ico'); ?>"/>
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Sniglet&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('css/discord.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <!-- Bootstrap DataTable -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css" />
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ad3bc6c5b8.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.3.4/sweetalert2.all.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="<?= base_url('assets/js/countUp.js'); ?>"></script>
    <!-- Bootstrap DataTable -->
    <script src="<?= base_url('assets/js/bootstrap-table.min.js'); ?>"></script>
	 <style>
::-webkit-scrollbar {
height:5px;
width: 4px;
background: #1f232d85; //warna background scroll
}
::-webkit-scrollbar-thumb {
background-color: #007bff; //warna scroll
}
.btn-square{border-radius:0!important}
footer.footer {
    margin-top: 20px;
    text-align:center;
}
body {
    background: url(https://nee.my.id/img/bg-pattern-inspiration-geometry.png),#000;
    background-position: 50% 35px;
    color:#fff;
}
.bg-light {
    background-color: #1f232d !important;
}
.navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link:focus {
    color: #007bff;
}
.navbar-light .navbar-nav .nav-link {
    color: #fff;
}
.navbar-light .navbar-text {
    color: #fff;
}
.card {
    background-color: #1f232d85 !important;
}
.blockquote-box {
    background-color: #1f232d85 !important;
    border-radius: 40px 0px 0px 40px;
}
.lead {
    padding-top: 15px;
}
.blockquote-box .square {
    width: 95px;
}
h4, .h4 {
    padding-top:20px;
    color: #fff;
}
.form-control:disabled, .form-control[readonly] {
    background-color: #0e0e0e !important;
}
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #4582ec;
    background-color: transparent;
    border-color: #007bff #007bff #007bff;
}
.nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
    border-color: #007bff #007bff #007bff;
}
hr {
    border-top: 1px solid #3d4352;
}
.navbar-light .navbar-toggler {
    padding-top: 7px;
    color: #ffffff26;
    border-color: #ffffff26;
}
.btn.btn-ghost.btn-primary:hover {
    color: #4582EC;
    border-color: #4582EC;
    background-color: #fff;
}
.btn.btn-ghost.btn-primary {
    margin-top:2px;
    color: #fff;
    background-color: #4582EC;
    border-color: #4582EC;
    box-shadow: 0 3px 5px 0 rgba(47, 85, 212, 0.3);
    padding: 6px 10px;
    font-size: 13px;
    border-radius: 15px;
}
.btn.btn-ghost.btn-danger:hover {
    color: #d9534f;
    border-color: #d9534f;
    background-color: #fff;
}
.btn.btn-ghost.btn-danger {
    margin-top:2px;
    color: #fff;
    background-color: #d9534f;
    border-color: #d9534f;
}
.jss6 {
    box-shadow: none;
    background-color: transparent;
}
.MuiGrid-spacing-xs-4 {
    width: calc(100% + 32px);
    margin: -16px;
}
.MuiGrid-justify-xs-center {
    justify-content: center;
}
.MuiGrid-container {
    display: flex;
    flex-wrap: wrap;
    box-sizing: border-box;
}
.MuiGrid-spacing-xs-4 > .MuiGrid-item {
    padding: 10px;
}
.MuiGrid-item {
    margin: 0;
    box-sizing: border-box;
}
.jss8 {
    width: 140px;
    background-image: url(https://nee.my.id/img/nakama.png);
    background-position: 0px 0px;
}
.jss9 {
    width: 165px;
    background-image: url(https://nee.my.id/img/nakama.png);
    background-position: -144px 0px;
}
.jss10 {
    width: 130px;
    background-image: url(https://nee.my.id/img/nakama.png);
    background-position: -315px 0px;
}
@media (max-width: 1279.95px)
.jss {
    margin: 0;
}
.jss {
    filter: saturate(0%);
    height: 39px;
    margin: 0 32px;
    transition: filter 400ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
}
.jss:hover {
    filter: saturate(100%);
}
.jdulz {
    font-family: 'Sniglet', cursive;
}
	 </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?= base_url(); ?>"><img src="https://nee.my.id/img/new-logo-light-v2.png" width="150px" height="35px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
   <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="white" fill-rule="evenodd" clip-rule="evenodd"><path d="M11.954 11c3.33 0 7.057 6.123 7.632 8.716.575 2.594-.996 4.729-3.484 4.112-1.092-.271-3.252-1.307-4.102-1.291-.925.016-2.379.836-3.587 1.252-2.657.916-4.717-1.283-4.01-4.073.774-3.051 4.48-8.716 7.551-8.716zm10.793-4.39c1.188.539 1.629 2.82.894 5.27-.704 2.341-2.33 3.806-4.556 2.796-1.931-.877-2.158-3.178-.894-5.27 1.274-2.107 3.367-3.336 4.556-2.796zm-21.968.706c-1.044.729-1.06 2.996.082 5.215 1.092 2.12 2.913 3.236 4.868 1.87 1.696-1.185 1.504-3.433-.082-5.215-1.596-1.793-3.824-2.599-4.868-1.87zm15.643-7.292c1.323.251 2.321 2.428 2.182 5.062-.134 2.517-1.405 4.382-3.882 3.912-2.149-.407-2.938-2.657-2.181-5.061.761-2.421 2.559-4.164 3.881-3.913zm-10.295.058c-1.268.451-1.92 2.756-1.377 5.337.519 2.467 2.062 4.114 4.437 3.269 2.06-.732 2.494-3.077 1.377-5.336-1.125-2.276-3.169-3.721-4.437-3.27z"/></svg> 
  </button>
  <div class="collapse navbar-collapse" id="navbarColor03">
    <?php if (is_login()): ?>
      <ul class="navbar-nav mr-auto">
      <?php if(!check_public()) : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('manage/files'); ?>">File Manager</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('upload/links'); ?>">Upload Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('upload/drive'); ?>">Upload Drive</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('file-report'); ?>">Reported Files <sup><span class="badge-pill <?=$broken_badge;?>"><?= $broken_count; ?></span></sup></a>
        </li>
        <?php if(is_admin()): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('admin'); ?>">Admin</a>
        </li>
        <?php endif; ?>
      <?php endif; ?>
      </ul>
    <?php endif;?>
    <?php if (is_login()): ?>
    <div class="form-inline my-2 my-lg-0">
      <span class="navbar-text"><a href="<?= base_url('account'); ?>" style="color:#fff!important;"><img src="<?= $_user['picture'];?>" class="rounded-circle" height="30px"> <?= $_user['email']; ?></a></span>&nbsp;&nbsp;<a class="btn btn-danger btn-sm my-2 my-sm-0 btn-square" href="<?= base_url("logout?r=$redirectURL"); ?>">Log-out</a>
    </div>
    <?php else: ?>
    <ul class="navbar-nav ml-auto">
      <li><a href="<?= base_url("login?r=$redirectURL"); ?>" class="btn btn-ghost btn-sm btn-primary jdulz" style="margin-right:5px"><i class="fa fa-user-o" aria-hidden="true"></i> Login</a></li>
      <li><a data-toggle="modal" data-target="#infoModal" class="btn btn-ghost btn-sm btn-primary jdulz" style="margin-right:10px"><i class="fas fa-disease" aria-hidden="true"></i> Notification</a></li>
    </ul>
    <?php endif;?>
  </div>
</nav>