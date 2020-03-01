 
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
		 <h3 class="box-title"><?php echo $button ;?> Login_attempts</h3>
		<hr />	 
		<?php echo form_open($action);?>
	    <div class="form-group">
				<?php 
					echo form_label('Ip Address');
					echo form_error('ip_address');
					echo form_input($ip_address);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Login');
					echo form_error('login');
					echo form_input($login);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Time');
					echo form_error('time');
					echo form_input($time);
				?>				
			</div>
	    <?php 
			echo form_input($id);
	    	echo form_submit('submit', $button , array('class'=>'btn btn-flat btn-primary'));
	        echo anchor('login_attempts','Batal',array('class'=>'btn btn-flat btn-default')); 
						?>
	<?php echo form_close();?>
		</div>
	 </div>
               
    </section>
	<!-- /.content -->

    