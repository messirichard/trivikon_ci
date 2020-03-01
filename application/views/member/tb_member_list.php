
       
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
		 <h3 class="box-title">Daftar Tb_member</h3><hr />	
        
			 <?php echo anchor(site_url('member/create'),'<i class = "fa fa-plus"></i> Tambah', 'class="btn btn-flat btn-primary"'); ?>
            
            <div class="box-tools pull-right">
                <form action="<?php echo site_url('member/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('member'); ?>" class="btn btn-flat btn-default">Reset</a>
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
		<th>Nama</th>
		<th>Jabatan</th>
		<th>Nick Name</th>
		<th>Alamat Rumah</th>
		<th>Telp Aktif</th>
		<th>Telp Saudara</th>
		<th>Tgl Masuk</th>
		<th>Foto Diri</th>
		<th>Foto Ktp</th>
		<th>Nama Subkontraktor</th>
		<th>Status</th>
		<th>Aksi</th>
            </tr><?php
            foreach ($member_data as $member)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $member->nama ?></td>
			<td><?php echo $member->jabatan ?></td>
			<td><?php echo $member->nick_name ?></td>
			<td><?php echo $member->alamat_rumah ?></td>
			<td><?php echo $member->telp_aktif ?></td>
			<td><?php echo $member->telp_saudara ?></td>
			<td><?php echo $member->tgl_masuk ?></td>
			<td><?php echo $member->foto_diri ?></td>
			<td><?php echo $member->foto_ktp ?></td>
			<td><?php echo $member->nama_subkontraktor ?></td>
			<td><?php echo $member->status ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('member/read/'.$member->id),'<i class="fa fa-eye"></i>','class="btn btn-flat btn-info"'); 
				echo '  '; 
				echo anchor(site_url('member/update/'.$member->id),'<i class="fa fa-edit"></i>','class="btn btn-flat btn-warning"'); 
				echo '  '; 
				echo anchor(site_url('member/delete/'.$member->id),'<i class="fa fa-trash"></i>','class="btn btn-flat btn-danger"','onclick="javasciprt: return confirm(\'Anda Yakin ?\')"'); 
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
		<?php echo anchor(site_url('member/excel'), '<i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-flat btn-success"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
		</div>
		</div>
		</section>
   <!-- /.content -->
  
    