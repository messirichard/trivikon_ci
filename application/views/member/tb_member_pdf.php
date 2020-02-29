<!doctype html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Tb_member List</h2>
        <table class="word-table" style="margin-bottom: 10px">
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
		
            </tr><?php
            foreach ($member_data as $member)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
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
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>