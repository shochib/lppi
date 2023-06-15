<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $title ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><?= $page ?></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <button type="button" class="btn btn-sm bg-gradient-success" onclick="location.href='<?php echo base_url("Data/form") ?>' "><i class="fa fa-plus"></i> Tambah data </button>

        <!-- /.card-header -->
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Unit</th>
              <th>Username</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $no = 0;
            foreach ($user as $key => $obj) {
              $no++;
              $IDdata = $obj->id;
              $IDunit = $obj->unit;
              $Username = $obj->username;

            ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $IDunit ?></td>
                <td><?= $Username ?></td>
                <td>

                  <button type="button" class="btn btn-sm bg-gradient-primary" onclick="location.href='<?php echo base_url("Data/detail/$IDdata") ?>' ">Detail</button>

                  <button type="button" class="btn btn-sm bg-gradient-warning" onclick="location.href='<?php echo base_url("Data/edit/$IDdata") ?>' "> <i class="fa fa-edit"></i> </button>

                  <a href='<?php echo base_url("Data/hapus/$IDdata") ?>' onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')" class="btn btn-sm bg-gradient-danger">
                    <i class="fa fa-trash"></i>
                  </a>

                </td>
              </tr>
            <?php

            }

            ?>

          </tbody>

        </table>

        <!-- /.card-body -->


      </div>

    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->