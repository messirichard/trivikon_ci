
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
		 <h3 class="box-title">Detail Users_groups</h3>
		<hr />
        <table class="table">
	    <tr><td>User Id</td><td><?php echo $user_id; ?></td></tr>
	    <tr><td>Group Id</td><td><?php echo $group_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('users_groups') ?>" class="btn btn-flat btn-default">Batal</a></td></tr>
	</table>
        </div>
	 </div>
               
    </section>
	<!-- /.content -->