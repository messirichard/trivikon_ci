
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>        
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><?php echo anchor('dashboard','<i class="fa fa-dashboard"></i> Beranda</a>')?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	<?php if(isset($message)){   
		 echo '<div class="alert alert-warning">  
		   <a href="#" class="close" data-dismiss="alert">&times;</a>  
		   '.$message.'
		 </div> '; 
    }  ?>
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
		 <h3 class="box-title">Detail Tb_tugas_lists</h3>
		<hr />
        <table class="table">
	    <tr><td>Dari</td><td><?php echo $dari; ?></td></tr>
	    <tr><td>Kepada</td><td><?php echo $kepada; ?></td></tr>
	    <tr><td>Prioritas</td><td><?php echo $prioritas; ?></td></tr>
	    <tr><td>Subject Kepentingan</td><td><?php echo $subject_kepentingan; ?></td></tr>
	    <tr><td>Deskripsi</td><td><?php echo $deskripsi; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Status Selesai</td><td><?php echo $status_selesai; ?></td></tr>
	    <tr><td>Member Id</td><td><?php echo $member_id; ?></td></tr>
	    <tr><td>Admin Id</td><td><?php echo $admin_id; ?></td></tr>
	    <tr><td>Date Input</td><td><?php echo $date_input; ?></td></tr>
	    <tr><td>Date Finish</td><td><?php echo $date_finish; ?></td></tr>
	    <tr><td>Data</td><td><?php echo $data; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tugas_lists') ?>" class="btn btn-flat btn-default">Batal</a></td></tr>
	</table>
        </div>
	 </div>
               
    </section>
	<!-- /.content -->