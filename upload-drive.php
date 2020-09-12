<?php include('template/header.php'); check_login(); ?>
<?php changeTitle('Upload Drive - '. _NAME); ?>
<div class="container mt-4">
  <div class="card">
    <strong class="card-header text-center bg-primary text-white"><i class="fa fa-hdd-o"></i> Upload Drive</strong>
    <div class="card-body">
      <div class="form-group">
          <small class="text-danger">*(max: 25 files)</small>
          <div class="text-center text-muted" style="padding:20px;border:2px #DFE2E5 dashed;"><button class="btn btn-sm btn-outline-success" onclick="onApiLoad()"><i class="fa fa-folder-open"></i> Choose File</button></div>
          <hr/>
          <form id="upload-picker"></form>
      </div>
      <div class="form-group text-center">
          <button id="btn-share" onclick="$('form').submit()" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Upload</button>
      </div>
    </div>
  </div>
  <div class="card" id="shareFrm2" style="margin-top:20px;display:none;">
    <div class="card-body">
      <div class="form-group" id="sharetxt">
        <label for="sharetext">Download Link</label>
        <div class="form-control" id="sharetext"></div>
      </div>
    </div>
  </div>
</div> <!-- / contaier -->
<?php $src = base_url('assets/js/6576815c5202ef23c57b797dfcb29d95.js?v2&t='.base64_encode(@$_COOKIE['g_token'])); ?>
<script type="text/javascript" src="<?= $src; ?>"></script>
<script src="https://apis.google.com/js/client.js?onload=initPicker"></script>
<?php include('template/footer.php'); ?>