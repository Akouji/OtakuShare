<?php
	error_reporting(0);
	include "curl_gd.php";

	if($_POST['submit'] != ""){
		$url = $_POST['url'];
		$gid = get_drive_id($url);
		$iframeid = my_simple_crypt($gid);
		$backup = 'https://drive.google.com/file/d/'.$gid.'/preview';
		$posterimg = PosterImg($backup);
		$linkdown = Drive($url);
		$file = '//nee.my.id/stream/?id='.$gid.'';
	}
?>
<?php include(realpath($_SERVER['DOCUMENT_ROOT']) . '/template/header.php'); ?>
<?php changeTitle('GDrive Player - OtakuShare'); ?>

<div class="container" style="margin-top:30px;">
<div class="card">
<strong class="card-header bg-primary text-light"><i class="fa fa-external-link fa-fw"></i> GDrive Player</strong>
<div class="card-body">
    
<div class="form-group form-group-sm">
<label class="control-label">Enter Google Drive File URL</label>
<form action="" method="POST">
<input type="text" class="form-control no-border" name="url" placeholder="https://drive.google.com/file/d/1i8DeQDx3-9uv4VQM-2jKxrVcP5PZZ9Qq/view" autofocus="true" />
<div class="text-center"><input type="submit" name="submit" class="btn btn-success btn-sm text-light mt-2" style="border-radius:0;width:100%" value="Generate"></div>
</form>
<br>
<iframe poster="<?php echo $posterimg; ?>" src="<?php echo $file?>" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH="100%" HEIGHT="100%"allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
<br>
<label class="control-label">Result</label>
<div><?php if($iframeid){echo '<textarea style="margin:10px;width: 97%;height: 80px;">https://nee.my.id/stream/?id='.$gid.'</textarea>';}?></div>
<div><?php if($iframeid){echo '<textarea style="margin:10px;width: 97%;height: 80px;">&lt;iframe src="//nee.my.id/stream/?id='.$gid.'" width="640" height="360" frameborder="0" scrolling="no" allowfullscreen&gt;&lt;/iframe&gt;</textarea>';}?></div>

</div>
</div>
</div>
<div class="alert bg-info no-border">
<span><i class="fa fa-info-circle"></i> <strong>INFO!</strong></span>
<span class="float-right">Service status: <i class="fa fa-thumbs-up"></i></span>
</div>
<div class="text-center mt-4">
<a href="https://bit.ly/GdriveUnlimitedKak"><img src="https://nee.my.id/img/ads.gif" style="border-radius:10px;" alt="Ads"></a>
</div>
</div>
<?php include(realpath($_SERVER['DOCUMENT_ROOT']) . '/template/footer.php'); ?>