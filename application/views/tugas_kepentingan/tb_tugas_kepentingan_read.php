
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
		 <h3 class="box-title">Detail Tb_tugas_kepentingan</h3>
		<hr />
        <table class="table">
	    <tr><td>Kepentingan</td><td><?php echo $kepentingan; ?></td></tr>
	    <tr><td>Nama Kepentingan</td><td><?php echo $nama_kepentingan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tugas_kepentingan') ?>" class="btn btn-flat btn-default">Batal</a></td></tr>
	</table>
        </div>
	 </div>
               
    </section>
	<!-- /.content -->