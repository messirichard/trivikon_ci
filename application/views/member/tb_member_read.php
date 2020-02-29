
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
		 <h3 class="box-title">Detail Tb_member</h3>
		<hr />
        <table class="table">
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Jabatan</td><td><?php echo $jabatan; ?></td></tr>
	    <tr><td>Nick Name</td><td><?php echo $nick_name; ?></td></tr>
	    <tr><td>Alamat Rumah</td><td><?php echo $alamat_rumah; ?></td></tr>
	    <tr><td>Telp Aktif</td><td><?php echo $telp_aktif; ?></td></tr>
	    <tr><td>Telp Saudara</td><td><?php echo $telp_saudara; ?></td></tr>
	    <tr><td>Tgl Masuk</td><td><?php echo $tgl_masuk; ?></td></tr>
	    <tr><td>Foto Diri</td><td><?php echo $foto_diri; ?></td></tr>
	    <tr><td>Foto Ktp</td><td><?php echo $foto_ktp; ?></td></tr>
	    <tr><td>Nama Subkontraktor</td><td><?php echo $nama_subkontraktor; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('member') ?>" class="btn btn-flat btn-default">Batal</a></td></tr>
	</table>
        </div>
	 </div>
               
    </section>
	<!-- /.content -->