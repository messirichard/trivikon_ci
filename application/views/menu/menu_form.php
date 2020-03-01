 
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
		 <h3 class="box-title"><?php echo $button ;?> Menu</h3>
		<hr />	 
		<?php echo form_open($action);?>
	    <div class="form-group">
				<?php 
					echo form_label('Parent Menu');
					echo form_error('parent_menu');
					echo form_input($parent_menu);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Nama Menu');
					echo form_error('nama_menu');
					echo form_input($nama_menu);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Controller Link');
					echo form_error('controller_link');
					echo form_input($controller_link);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Icon');
					echo form_error('icon');
					echo form_input($icon);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Slug');
					echo form_error('slug');
					echo form_input($slug);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Urut Menu');
					echo form_error('urut_menu');
					echo form_input($urut_menu);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Menu Grup User');
					echo form_error('menu_grup_user');
					echo form_input($menu_grup_user);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Is Active');
					echo form_error('is_active');
					echo form_input($is_active);
				?>				
			</div>
	    <?php 
			echo form_input($id);
	    	echo form_submit('submit', $button , array('class'=>'btn btn-flat btn-primary'));
	        echo anchor('menu','Batal',array('class'=>'btn btn-flat btn-default')); 
						?>
	<?php echo form_close();?>
		</div>
	 </div>
               
    </section>
	<!-- /.content -->

    