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
 			<!-- <div class="form-group">
 				<?php 
					// echo form_label('Subject Kepentingan');
					// echo form_error('subject_kepentingan');
					// echo form_input($subject_kepentingan);
				?>
 			</div> -->
 			<div class="form-group">
 				<label for="">Subject Kepentingan</label>

 				<select name="subject_kepentingan" id="member" class="form-control">
 					<?php foreach ($list_kepentingan as $key => $value): ?>
 					<?="<option value=$value->id > $value->kepentingan</option>"?>
 					<?php endforeach;?>
 				</select>
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
 				<label for="">Member</label>

 				<select name="member_id" id="member" class="form-control">
 					<?php foreach ($member as $key => $value): ?>
 					<?="<option value=$value->id > $value->nama</option>"?>
 					<?php endforeach;?>
 				</select>
 			</div>
 			
 			<div class="form-group">
				 <input type="hidden" name="admin_id" value="<?php echo $admin_id ?>">
 				<label for="">Date Input</label>
 				<div class="input-group date">

 					<div class="input-group-addon">
 						<i class="fa fa-calendar"></i>
 					</div>
 					<input name="date_input" type="text" class="form-control pull-right datepicker-me"
 						id="datepicker-me">
 				</div>
 			</div>
 			<div class="form-group">
 				<label for="">Date Finish</label>
 				<div class="input-group date">
 					<div class="input-group-addon">
 						<i class="fa fa-calendar"></i>
 					</div>
 					<input name="date_finish" type="text" class="form-control pull-right datepicker-me" id="datepicker-me">
 				</div>
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
