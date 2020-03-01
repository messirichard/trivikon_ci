
       
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><?php echo anchor('dashboard','<i class="fa fa-dashboard"></i> Dashboard</a>')?></li>
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
		 <h3 class="box-title">Daftar Users</h3><hr />	
        
			 <?php echo anchor(site_url('users/create'),'<i class = "fa fa-plus"></i> Tambah', 'class="btn btn-flat btn-primary"'); ?>
            
            <div class="box-tools pull-right">
                <form action="<?php echo site_url('users/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('users'); ?>" class="btn btn-flat btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
		<div class="box-body">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Ip Address</th>
		<th>Username</th>
		<th>Password</th>
		<th>Salt</th>
		<th>Email</th>
		<th>Activation Code</th>
		<th>Forgotten Password Code</th>
		<th>Forgotten Password Time</th>
		<th>Remember Code</th>
		<th>Created On</th>
		<th>Last Login</th>
		<th>Active</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Company</th>
		<th>Phone</th>
		<th>Aksi</th>
            </tr><?php
            foreach ($users_data as $users)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $users->ip_address ?></td>
			<td><?php echo $users->username ?></td>
			<td><?php echo $users->password ?></td>
			<td><?php echo $users->salt ?></td>
			<td><?php echo $users->email ?></td>
			<td><?php echo $users->activation_code ?></td>
			<td><?php echo $users->forgotten_password_code ?></td>
			<td><?php echo $users->forgotten_password_time ?></td>
			<td><?php echo $users->remember_code ?></td>
			<td><?php echo $users->created_on ?></td>
			<td><?php echo $users->last_login ?></td>
			<td><?php echo $users->active ?></td>
			<td><?php echo $users->first_name ?></td>
			<td><?php echo $users->last_name ?></td>
			<td><?php echo $users->company ?></td>
			<td><?php echo $users->phone ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('users/read/'.$users->id),'<i class="fa fa-eye"></i>','class="btn btn-flat btn-info"'); 
				echo '  '; 
				echo anchor(site_url('users/update/'.$users->id),'<i class="fa fa-edit"></i>','class="btn btn-flat btn-warning"'); 
				echo '  '; 
				echo anchor(site_url('users/delete/'.$users->id),'<i class="fa fa-trash"></i>','class="btn btn-flat btn-danger"','onclick="javasciprt: return confirm(\'Anda Yakin ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-flat btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
		</div>
		</div>
		</section>
   <!-- /.content -->
  
    