<?php
include('template/header.php');
include('system/send-mail.php');

	
if (@$_GET['token'] === @$_SESSION['file_token']) {
	$file_id 	= $_REQUEST['id'];
	$file 		= $YuuClass->get_file($file_id);
	@$copy 		= copyFile_createFolder($file['file_id']);
	//$direct     = str_replace('&gd=true', '', @$copy['downloadUrl']);
	if(isset($copy['error'])) {
		if($copy['error'] == '404') {
			kirim_email($file['file_owner_mail'], $file['file_name'], @$_SERVER['HTTP_REFERER']);
			$YuuClass->broken_file(array(
				'id' => $file_id,
				'file_owner_mail' => $file['file_owner_mail'],
				'created_date' => $YuuClass->DATETIME,
				'type' => 1
			));
		} elseif($copy['error'] == '401') {
			$url = base64_encode(CURRENT_URL);
			return redirect(base_url("OAuth?r=$url"));
		}
		$msg = '<i class="fa fa-warning"></i> '.errorText($copy['error']); goto lewat;
	} else {
		$YuuClass->update_dls($file['downloads'], $file_id);
		$YuuClass->update_last_dls(array(
			'id' => $file_id,
			'file_name' => $file['file_name'],
			'user' => $_user['email'],
			'download_at' => $YuuClass->DATETIME
		));
		$dlLink = ($plugins['directdl_api']) ? $plugins['directdl_api'] . '?url=' . $copy['webContentLink'] : directdl($copy['id']);
		return redirect($dlLink);
	}
} else {
	$msg = "Invalid Token! <small><a href='$_SERVER[HTTP_REFERER]'>Click here</a></small> to download again..";
}
lewat:
?>
<div class="container" style="margin-top: 40px;">
	<div class="alert bg-danger text-light" style="padding: 30px;text-align: center;font-size: 13pt;">
		<h2 class="lead text-white"><?php echo $msg; ?></h2>
	</div>
</div>
<?php include('template/footer.php'); ?>