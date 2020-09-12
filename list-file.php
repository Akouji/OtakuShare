<?php include('template/header.php'); ?>
<?php
changeTitle('All Files');
$batas      = 35;
$page       = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$offset     = ($page > 1) ? ($page-1)*$batas : $page - 1;
$allFiles 	= $YuuClass->get_all_files($offset, $batas); 
$next       = $page + 1;
$prev       = ($page !== 10) ? $page - 1 : 0;
$jumData    = $YuuClass->get_count('tb_file');
$jumHalaman = ceil($jumData / $batas);
?>
<div class="container" style="margin-top: 30px;">
	<ol class="breadcrumb">
	  <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
	  <li class="breadcrumb-item active">All Files</li>
	</ol>
	<div class="card">
		<strong class="card-header text-center bg-primary text-white"><i class="fa fa-file"></i> All Files</strong>
		<div class="card-body">
		<h5 class="lead">Showing: <? echo $allFiles['count']; ?> files</h3>
		<hr/>
		<div class="table-responsive">
		<table data-toggle="table" class="table">
			<thead>
				<tr>
			      <th>File Name</th>
			      <th>Size</th>
			      <th data-align="center">Dls</th>
			      <th>Created</th>
			    </tr>
		  	</thead>
		  	<tbody>
		  		<?php foreach ($allFiles['files'] as $key => $file): ?>
		  		<?php $fileUrl = $file['id']."/".sanitize_filename($file['file_name']); ?> 
		  		<tr>
			      <td><a href="/<?= $fileUrl; ?>"><?= $file['file_name'];?></a></td>
			      <td><?= filesize_formatted($file['file_size']);?></td>
			      <td><?= $file['downloads']; ?>x</td>
			      <td><?= timeAgo($file['created_date']); ?></td>
			  	</tr>
				<?php endforeach;?>
			</tbody>
		</table></div>
		<hr/>
		<div class="text-center"><span class="text-muted"><?= $page .' of '. $jumHalaman; ?></span></div>
		<ul class="pagination float-right">
	    <?php if($next > 2) : ?>
	        <li class="page-item"><a href="/list-file.php?page=<?= $prev;?>" class="page-link">&larr; Back</a></li>
	    <?php endif; ?>
	   	<?php if($jumHalaman != $page && $jumHalaman > 1) : ?>
	    	<li class="page-item active"><a href="/list-file.php?page=<?= $next;?>" class="page-link">More &rarr;</a></li>
	    <?php endif; ?>
	  	</ul>
	</div></div>
</div>
<?php include('template/footer.php'); ?>