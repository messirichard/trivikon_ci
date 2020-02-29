 
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
		 <h3 class="box-title"><?php echo $button ;?> Tb_tugas_lists</h3>
		<hr />	 
		<?php echo form_open($action);?>
	    <div class="form-group">
				<?php 
					echo form_label('Dari');
					echo form_error('dari');
					echo form_input($dari);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Kepada');
					echo form_error('kepada');
					echo form_input($kepada);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Prioritas');
					echo form_error('prioritas');
					echo form_input($prioritas);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Subject Kepentingan');
					echo form_error('subject_kepentingan');
					echo form_input($subject_kepentingan);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Deskripsi');
					echo form_error('deskripsi');
					echo form_textarea($deskripsi);
				?>
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Status');
					echo form_error('status');
					echo form_input($status);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Status Selesai');
					echo form_error('status_selesai');
					echo form_input($status_selesai);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Member Id');
					echo form_error('member_id');
					echo form_input($member_id);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Admin Id');
					echo form_error('admin_id');
					echo form_input($admin_id);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Date Input');
					echo form_error('date_input');
					echo form_input($date_input);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Date Finish');
					echo form_error('date_finish');
					echo form_input($date_finish);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Data');
					echo form_error('data');
					echo form_input($data);
				?>				
			</div>
	    <?php 
			echo form_input($id);
	    	echo form_submit('submit', $button , array('class'=>'btn btn-flat btn-primary'));
	        echo anchor('tugas_lists','Batal',array('class'=>'btn btn-flat btn-default')); 
						?>
	<?php echo form_close();?>
		</div>
	 </div>
               
    </section>
	<!-- /.content -->

    