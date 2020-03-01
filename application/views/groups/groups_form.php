 
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
		 <h3 class="box-title"><?php echo $button ;?> Groups</h3>
		<hr />	 
		<?php echo form_open($action);?>
	    <div class="form-group">
				<?php 
					echo form_label('Name');
					echo form_error('name');
					echo form_input($name);
				?>				
			</div>
	    <div class="form-group">
				<?php 
					echo form_label('Description');
					echo form_error('description');
					echo form_input($description);
				?>				
			</div>
	    <?php 
			echo form_input($id);
	    	echo form_submit('submit', $button , array('class'=>'btn btn-flat btn-primary'));
	        echo anchor('groups','Batal',array('class'=>'btn btn-flat btn-default')); 
						?>
	<?php echo form_close();?>
		</div>
	 </div>
               
    </section>
	<!-- /.content -->

    