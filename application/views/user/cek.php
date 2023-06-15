<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Title</h3>

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
                            <?= $ket ?>
                            <hr>

                            <?php
                            //echo $id_user;
                            //echo $id_jenis;
                            //echo $id_publis;

                            if ($status == 1) {
                            ?>
                                <button type="button" class="btn btn-primary float-right" onclick="location.href='<?php echo base_url("Pengajuan/form/$id_jenis/$id_publis/$id_pengajuan") ?>' "><i class="fas fa-plus"></i> Tambah Pengajuan</button>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Control Sidebar -->

<!-- /.control-sidebar -->
</div>