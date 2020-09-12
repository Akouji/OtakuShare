<?php include(realpath($_SERVER['DOCUMENT_ROOT']) . '/template/header.php'); ?>
<?php changeTitle('GDrive Direct Download - OtakuShare'); ?>
<style>
.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -75px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>
<div class="container" style="margin-top:30px;">
<div class="card">
<strong class="card-header bg-primary text-light"><i class="fa fa-external-link fa-fw"></i> GDrive Direct Download</strong>
<div class="card-body">
    
<div class="form-group form-group-sm">
<label class="control-label">Enter Google Drive File URL</label>
<input type="text" class="form-control no-border" name="sharingurl" id="sharingurl" placeholder="https://drive.google.com/file/d/1i8DeQDx3-9uv4VQM-2jKxrVcP5PZZ9Qq/view" autofocus="true" />
<div class="text-center"><button id="generate" class="btn btn-success btn-sm text-light mt-2" style="border-radius:0;width:100%">Generate</button></div>
<label class="control-label">Result</label>
<input type="text" class="form-control no-border" name="googlelink" id="googlelink" autofocus="true" />
<p class="card-text text-muted"></p>
<div class="tooltip"><span class="tooltiptext" id="myTooltip">Copy to clipboard</span></div>
<button onclick="myFunction()" onmouseout="outFunc()" class="btn btn-success btn-sm text-light" style="border-radius:0">Copy Link</button>
<button data-clipboard-target="#googlelink" id="download" class="btn btn-info btn-sm text-light" style="border-radius:0">Direct Download</button>
<button id="borrar" class="btn btn-info btn-sm text-light" style="border-radius:0">Clear</button>

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
<script>
function myFunction() {
  var copyText = document.getElementById("googlelink");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied: " + copyText.value;
}

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}
</script>
<script src="https://nee.my.id/tools/gdirect/gd.js"></script>
<?php include(realpath($_SERVER['DOCUMENT_ROOT']) . '/template/footer.php'); ?>