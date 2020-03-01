
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
		 <h3 class="box-title">Detail Identitas_web</h3>
		<hr />
        <table class="table">
	    <tr><td>Nama Web</td><td><?php echo $nama_web; ?></td></tr>
	    <tr><td>Meta Deskripsi</td><td><?php echo $meta_deskripsi; ?></td></tr>
	    <tr><td>Meta Keyword</td><td><?php echo $meta_keyword; ?></td></tr>
	    <tr><td>Copyright</td><td><?php echo $copyright; ?></td></tr>
	    <tr><td>Logo</td><td><?php echo $logo; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('identitas_web') ?>" class="btn btn-flat btn-default">Batal</a></td></tr>
	</table>
        </div>
	 </div>
               
    </section>
	<!-- /.content -->