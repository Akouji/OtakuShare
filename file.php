<?php include('template/header.php'); ?>
<?php get_token_file(); ?>
<?php
$file_id 	= $_REQUEST['id'];
$get_file 	= $YuuClass->get_file($file_id);
$dl_now     = $get_file['file_id'];
$filename 	= $get_file['file_name'];
$fileext  	= getFileExtension($filename);
$fileMIME   = $get_file['file_type'];
$filesize 	= filesize_formatted($get_file['file_size']);
$filedate 	= timeAgo($get_file['created_date']);
$filedls	= $get_file['downloads'];
?>
<?php if (!$get_file): changeTitle('File not Found', 'File was not found!'); ?>
<div class="container text-center" style="margin-top:50px;">
	<div class="alert alert-danger">
		<h4 class="fa fa-exclamation-triangle fa-4x" aria-hidden="true"></h4><br/>
		<label>The file you are trying to download is no longer available!</label>
	</div>
</div>
<?php goto liwat; else:
# -- Change Title
	$title = "$filename - $filesize";
	$desc = "Download $filename - $filesize";
	$icon = get_icon($fileext);
	changeTitle($title, $desc, $icon);
endif;
?>
<div class="container" style="margin-top: 40px;">
    <div class="alert alert-primary no-border">
	<p class="mb-0"><i class="fa fa-bullhorn"></i> Info : Pastikan kamu sudah login terlebih dahulu sebelum mendownload dan space drive kamu tidak penuh~</p>
    </div>
	<?php if(is_admin() || $get_file['file_owner_mail'] == @$_user['email']): ?>
		<a href="javascript:void(0)" title="Delete file" onclick="javascript:if(confirm('Are you sure want to delete?'))delFile('<?= $file_id; ?>', false, true)" class="btn btn-sm btn-outline-danger float-right"><i class="fa fa-trash"></i></a>
	<?php endif; ?>
	<div class="text-center" style="word-wrap: break-word;">
		<h4><img src="<?= $icon; ?>" height="40"><?= $filename; ?></h4>
		<p class="lead">(<?= $filesize; ?>)</p>
	<?php if(is_admin()) : ?>
		<p style="font-size: 10pt;" class="text-muted"><small>Uploaded by <?= "<b>$get_file[file_owner_mail]</b>";?></small></p>
	<?php endif; ?>
	</div>
	<hr/>
	<div id="btn-dl">
		<small class="float-right text-muted"><?= "$filedate | $filedls";?>1x downloads</small>
		<a class="btn btn-primary btn-sm" data-toggle="collapse" href="#view" aria-expanded="false" aria-controls="view"><i class="fa fa-video-camera fa-fw"></i> Streaming <i class="fa fa-chevron-down"></i></a>
	</div>
	<div class="py-3 text-center">
	    
	</div>
	<div class="collapse" id="view">
	    <div class="alert alert-danger"><span>Apabila hanya muncul loading berarti video player tidak support!</span></div>
		<?php if($plugins['player'] && allow_video($fileMIME)) : ?>
		<div class="embed-responsive embed-responsive-16by9" style="border-radius:1px;">
			<iframe class="embed-responsive-item" src="/embed/<?= $file_id; ?>" scrolling="no" allowfullscreen="true"></iframe>
		</div>
		<?php elseif(!$plugins['player']): ?>
			<div class="alert alert-danger"><span>Fitur streaming dinonaktifkan oleh Admin</span></div>
		<?php else : ?>
			<div class="alert alert-danger"><span>Maaf, streaming tidak dapat dimuat. Jenis file ini mungkin tidak didukung!</span></div>
		<?php endif; ?>
	</div>
	<div class="my-3 text-center">
	<!-- Composite Start -->
    <div id="M459512ScriptRootC913555">
    </div>
    <script src="https://jsc.mgid.com/w/h/whatsuplife.in.913555.js" async></script>
    <!-- Composite End --><br/>
		<a data-target="dl" href="#dl" onclick="dl(this)" class="btn btn-outline-primary round btn-lg"><i class="fa fa-cloud-download"></i> Download via <strong>Login (Bypass Limit)</strong></a>
		<br/><br/>
		<button onclick="window.open('https://drive.google.com/uc?id=<?= $dl_now; ?>')" class="btn btn-dark round btn-sm"><i class="fa fa-external-link"></i> Download tanpa <strong>Login</strong> [<small><?= $filesize; ?></small>]</button>
<?php if($get_file['mirror_multiup']) : ?>
		<button onclick="window.open('http://multiup.org/download/<?=$get_file['mirror_multiup'];?>')" class="btn btn-dark round btn-sm"><i class="fa fa-external-link"></i> Download via <strong>Mirror</strong> (multiup) [<small><?= $filesize; ?></small>]</button>
<?php endif; ?>
	</div>
	
	<ul class="nav nav-tabs">
	  <li class="nav-item">
	    <a class="nav-link active" data-toggle="tab" href="#dlink"><i class="fa fa-download"></i> Link</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" data-toggle="tab" href="#htmlcode"><i class="fa fa-html5"></i> HTML Code</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" data-toggle="tab" href="#bbcode"><i class="fa fa-code-fork"></i> BB Code</a>
	  </li>
	  <?php if($plugins['player'] && allow_video($fileMIME)) : ?>
	  <li class="nav-item">
	    <a class="nav-link" data-toggle="tab" href="#embedvid"><i class="fa fa-youtube-play"></i> Embed Code</a>
	  </li>
	  <?php endif; ?>
	</ul>
	<div id="myTabContent" class="tab-content">
	  <div class="tab-pane fade in active show" id="dlink">
	    <input readonly onclick="copier(this)" class="form-control" value="<?= CURRENT_URL; ?>">
	  </div>
	  <div class="tab-pane fade" id="htmlcode">
	    <input readonly onclick="copier(this)" class="form-control" value='<?= htmlcode(CURRENT_URL, $filename.' - '.$filesize); ?>'>
	  </div>
	  <div class="tab-pane fade" id="bbcode">
	    <input readonly onclick="copier(this)" class="form-control" value='<?= bbcode(CURRENT_URL, $filename.' - '.$filesize); ?>'>
	  </div>
	  <?php if($plugins['player'] && allow_video($fileMIME)) : ?>
	  <div class="tab-pane fade" id="embedvid">
	    <input readonly onclick="copier(this)" class="form-control" value='Fitur ini telah dinonaktifkan oleh admin.'>
	  </div>
	  <?php endif; ?>
	</div>
	<br/>
	<div class="py-3 text-center">
		<center><a href="https://bit.ly/GdriveUnlimitedKak"><img src="https://nee.my.id/img/ads.gif" style="border-radius:10px;" alt="Ads"></a></center>
	</div>
</div>
<!--/-->
<script type="text/javascript">(function(a,b,c){var e,f=a.getElementsByTagName(b)[0];a.getElementById(c)||(e=a.createElement(b),e.id=c,e.src='https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=686664881396932&autoLogAppEvents=1',f.parentNode.insertBefore(e,f))})(document,'script','facebook-jssdk');var file_id='<?= $file_id; ?>';function popupwindow(a,b){var c=400,d=400,e=screen.width/2-c/2,f=screen.height/2-d/2;return window.open(a,b,'toolbar=no, location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width='+c+',height='+d+',top='+f+',left='+e)}

var dlUrl="/download?token=<?= $_SESSION['file_token'].'&id='.$file_id; ?>";
</script>

<script src="https://muhbayu.github.io/adBDetect/js/adbdetect.packed.js"></script>
<script type="text/javascript">
adBDetect().setup({
	wait:1000,
	setPage:'/page/ad-detect.html'
}).start();
</script>

<?php liwat: include('template/footer.php'); ?>