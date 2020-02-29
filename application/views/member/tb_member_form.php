 
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
		 <h3 class="box-title"><?php echo $button ;?> Tb_member</h3>
		<hr />	 
		<?php echo form_open($action);?>
	    <div class="form-group">
				<?php 
					echo form_label('Nama');
					echo form_error('nama');
					echo form_input($nama);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Jabatan');
					echo form_error('jabatan');
					echo form_input($jabatan);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Nick Name');
					echo form_error('nick_name');
					echo form_input($nick_name);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Alamat Rumah');
					echo form_error('alamat_rumah');
					echo form_textarea($alamat_rumah);
				?>
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Telp Aktif');
					echo form_error('telp_aktif');
					echo form_input($telp_aktif);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Telp Saudara');
					echo form_error('telp_saudara');
					echo form_input($telp_saudara);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Tgl Masuk');
					echo form_error('tgl_masuk');
					echo form_input($tgl_masuk);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Foto Diri');
					echo form_error('foto_diri');
					echo form_input($foto_diri);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Foto Ktp');
					echo form_error('foto_ktp');
					echo form_input($foto_ktp);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Nama Subkontraktor');
					echo form_error('nama_subkontraktor');
					echo form_input($nama_subkontraktor);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Status');
					echo form_error('status');
					echo form_input($status);
				?>				
			</div>
	    <?php 
			echo form_input($id);
	    	echo form_submit('submit', $button , array('class'=>'btn btn-flat btn-primary'));
	        echo anchor('member','Batal',array('class'=>'btn btn-flat btn-default')); 
						?>
	<?php echo form_close();?>
		</div>
	 </div>
               
    </section>
	<!-- /.content -->

    