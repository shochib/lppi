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

                <!-- /.card-header -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Publikasi</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data_publikasi as $key => $obj) {
                            $no++;
                            $IDdata = $obj->id;
                            $Nama = $obj->nama;

                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $Nama ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm bg-gradient-success" onclick="location.href='<?php echo base_url("Form/detail/$IDdata") ?>' "><i class="fa fa-bars "></i> Detail </button>
                                    <button type="button" class="btn btn-sm bg-gradient-warning" onclick="location.href='<?php echo base_url("Form/view/$IDdata") ?>' "><i class="fa fa-eye "></i> Tampil </button>
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