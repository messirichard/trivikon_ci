
       
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
		 <h3 class="box-title">Daftar Tb_tugas_lists</h3><hr />	
        
			 <?php echo anchor(site_url('tugas_lists/create'),'<i class = "fa fa-plus"></i> Tambah', 'class="btn btn-flat btn-primary"'); ?>
            
            <div class="box-tools pull-right">
                <form action="<?php echo site_url('tugas_lists/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tugas_lists'); ?>" class="btn btn-flat btn-default">Reset</a>
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
		<th>Dari</th>
		<th>Kepada</th>
		<th>Prioritas</th>
		<th>Subject Kepentingan</th>
		<th>Deskripsi</th>
		<th>Status</th>
		<th>Status Selesai</th>
		<th>Member Id</th>
		<th>Admin Id</th>
		<th>Date Input</th>
		<th>Date Finish</th>
		<th>Data</th>
		<th>Aksi</th>
            </tr><?php
            foreach ($tugas_lists_data as $tugas_lists)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $tugas_lists->dari ?></td>
			<td><?php echo $tugas_lists->kepada ?></td>
			<td><?php echo $tugas_lists->prioritas ?></td>
			<td><?php echo $tugas_lists->subject_kepentingan ?></td>
			<td><?php echo $tugas_lists->deskripsi ?></td>
			<td><?php echo $tugas_lists->status ?></td>
			<td><?php echo $tugas_lists->status_selesai ?></td>
			<td><?php echo $tugas_lists->member_id ?></td>
			<td><?php echo $tugas_lists->admin_id ?></td>
			<td><?php echo $tugas_lists->date_input ?></td>
			<td><?php echo $tugas_lists->date_finish ?></td>
			<td><?php echo $tugas_lists->data ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('tugas_lists/read/'.$tugas_lists->id),'<i class="fa fa-eye"></i>','class="btn btn-flat btn-info"'); 
				echo '  '; 
				echo anchor(site_url('tugas_lists/update/'.$tugas_lists->id),'<i class="fa fa-edit"></i>','class="btn btn-flat btn-warning"'); 
				echo '  '; 
				echo anchor(site_url('tugas_lists/delete/'.$tugas_lists->id),'<i class="fa fa-trash"></i>','class="btn btn-flat btn-danger"','onclick="javasciprt: return confirm(\'Anda Yakin ?\')"'); 
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
		<?php echo anchor(site_url('tugas_lists/excel'), '<i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-flat btn-success"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
		</div>
		</div>
		</section>
   <!-- /.content -->
  
    