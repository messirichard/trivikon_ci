
       
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
		 <h3 class="box-title">Daftar Users_groups</h3><hr />	
        
			 <?php echo anchor(site_url('users_groups/create'),'<i class = "fa fa-plus"></i> Tambah', 'class="btn btn-flat btn-primary"'); ?>
            
            <div class="box-tools pull-right">
                <form action="<?php echo site_url('users_groups/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('users_groups'); ?>" class="btn btn-flat btn-default">Reset</a>
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
		<th>User Id</th>
		<th>Group Id</th>
		<th>Aksi</th>
            </tr><?php
            foreach ($users_groups_data as $users_groups)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $users_groups->user_id ?></td>
			<td><?php echo $users_groups->group_id ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('users_groups/read/'.$users_groups->id),'<i class="fa fa-eye"></i>','class="btn btn-flat btn-info"'); 
				echo '  '; 
				echo anchor(site_url('users_groups/update/'.$users_groups->id),'<i class="fa fa-edit"></i>','class="btn btn-flat btn-warning"'); 
				echo '  '; 
				echo anchor(site_url('users_groups/delete/'.$users_groups->id),'<i class="fa fa-trash"></i>','class="btn btn-flat btn-danger"','onclick="javasciprt: return confirm(\'Anda Yakin ?\')"'); 
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
  
    