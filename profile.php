<?php include('template/header.php'); check_login(); ?>
<?php changeTitle('Account - '. _NAME); ?>
<?php $account_info = account_info(); ?>
<div class="container mt-4">
	<div class="card">
		<strong class="card-header text-center bg-primary text-white"><i class="fa fa-user"></i> Account</strong>
		<div class="card-body">
			<div class="row">
				<div class="col-md-3 mb-3">
					<div class="card">
						<img class="card-img-top" src="<?= $_user['picture']; ?>" width="40" alt="Card image">
						<div class="card-body">
							<h4 class="card-title"><?= $_user['name'];?></h4>
							<p class="card-text"><?= $_user['email'];?></p>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="blockquote-box blockquote-success clearfix">
						<div class="square pull-left"><span class="fa fa-file fa-3x"></span></div>
						<h5 class="lead jdulz">Your Files</h5>
						<strong class="lead"><?= $YuuClass->get_count('tb_file', $_user['email']); ?></strong>
					</div>
					<div class="blockquote-box blockquote-primary clearfix">
						<div class="square pull-left"><span class="fa fa-hdd-o fa-3x"></span></div>
						<h5 class="lead jdulz">Space Used</h5>
						<strong class="lead"><?= filesize_formatted($YuuClass->get_all_filesize($_user['email'])); ?></strong>
					</div>
					<div class="blockquote-box blockquote-info clearfix">
						<div class="square pull-left"><span class="fa fa-hdd-o fa-3x"></span></div>
						<h5 class="lead jdulz">Usage in Drive</h5>
						<strong class="lead"><?= filesize_formatted($account_info['storageQuota']['usageInDrive']); ?></strong>
					</div>
					<div class="blockquote-box blockquote-danger clearfix">
						<div class="square pull-left"><span class="fa fa-trash-o fa-3x"></span></div>
						<h5 class="lead jdulz">Trash</h5>
						<strong class="lead"><?= filesize_formatted($account_info['storageQuota']['usageInDriveTrash']); ?></strong>
					</div>
				</div>
			</div>
		</div> <!-- / card-body -->
	</div> <!-- / card -->
</div>

<?php include('template/footer.php'); ?>