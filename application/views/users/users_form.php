 
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
		 <h3 class="box-title"><?php echo $button ;?> Users</h3>
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
					echo form_label('Username');
					echo form_error('username');
					echo form_input($username);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Password');
					echo form_error('password');
					echo form_input($password);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Salt');
					echo form_error('salt');
					echo form_input($salt);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Email');
					echo form_error('email');
					echo form_input($email);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Activation Code');
					echo form_error('activation_code');
					echo form_input($activation_code);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Forgotten Password Code');
					echo form_error('forgotten_password_code');
					echo form_input($forgotten_password_code);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Forgotten Password Time');
					echo form_error('forgotten_password_time');
					echo form_input($forgotten_password_time);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Remember Code');
					echo form_error('remember_code');
					echo form_input($remember_code);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Created On');
					echo form_error('created_on');
					echo form_input($created_on);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Last Login');
					echo form_error('last_login');
					echo form_input($last_login);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Active');
					echo form_error('active');
					echo form_input($active);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('First Name');
					echo form_error('first_name');
					echo form_input($first_name);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Last Name');
					echo form_error('last_name');
					echo form_input($last_name);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Company');
					echo form_error('company');
					echo form_input($company);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Phone');
					echo form_error('phone');
					echo form_input($phone);
				?>				
			</div>
	    <?php 
			echo form_input($id);
	    	echo form_submit('submit', $button , array('class'=>'btn btn-flat btn-primary'));
	        echo anchor('users','Batal',array('class'=>'btn btn-flat btn-default')); 
						?>
	<?php echo form_close();?>
		</div>
	 </div>
               
    </section>
	<!-- /.content -->

    