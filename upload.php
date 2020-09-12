<?php include('template/header.php'); check_login(); ?>
<?php changeTitle('Upload Link - '. _NAME); ?>
<div class="container mt-4">
	<div class="card">
		<strong class="card-header text-center bg-primary text-white"><i class="fa fa-cloud-upload"></i> Upload Link</strong>
		<div class="card-body">
			<form method="POST" id="upload-url">
			    <div class="form-group text-center lead">
			      <label for="exampleTextarea">Upload File From Link</label><br/>
			      <textarea class="form-control" id="file_url" name="file_url" rows="9" placeholder="Paste google drive link here"></textarea>
			    </div>
			    <div class="form-group text-center">
			    	<button type="submit" id="btn-share" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
			    </div>
			</form>
			<center><div class="preload1"> Uploading...</div></center>
		</div>
	</div>
	<div class="card" id="shareFrm1" style="margin-top: 20px;display: none;">
	    <div class="card-body">
	      <div class="form-group" id="sharetxt">
	        <label for="sharetext">Download Link</label>
	        <div class="form-control" id="sharetext"></div>
	      </div>
	    </div>
  	</div>
</div>
<?php kaki: include('template/footer.php'); ?>