<?php include('template/header.php'); ?>
<?php
if($google['redirect'] != 'urn:ietf:wg:oauth:2.0:oob') return redirect('OAuth?r='.@$_GET['r']); ?>
<div class="container mt-4">
	<div class="card">
		<strong class="card-header bg-primary text-white text-center"><i class="fa fa-user"></i> Login</strong>
		<form class="card-body" method="GET" action="<?= base_url('OAuth'); ?>">
            <div class="form-group">
                <label class="control-label">Enter OAuth Code</label>
                <div class="form-group">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="hidden" name="r" value="<?= @$_GET['r']; ?>">
                    <input type="text" name="code" class="form-control" autocomplete="off" placeholder="Example: 4/SQHo3WCLsU-SQZYsVEHTOLgeYSsOqUVUc6X_id5Jm-87RbTxXxXxXxX" />
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-info" style="border-radius:0;">Login</button>
                <button type="button" class="btn btn-info" style="border-radius:0;" onclick="javascript:getCode(900,500);">Get Access</button>
            </div>
        </form>
    </div>
</div>

<script>
function getCode(w, h) {
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  return window.open('<?= authURL(); ?>', 'Authentication', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
</script>
<?php include('template/footer.php'); ?>