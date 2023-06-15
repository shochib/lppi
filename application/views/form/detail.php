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
                <h3 class="card-title"><?= $jurnal['nama']; ?></h3>

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

                <?php
                $opt_field = "";
                $opt_data = "";
                $arr_field = array();
                $idinput = $jurnal['id'];

                $this->db->select('*');
                $this->db->from('tbl_m_field');
                $this->db->where('hapus', 0);
                $query2 = $this->db->get();

                foreach ($query2->result() as $row2) {
                    $Nama_field = $row2->nama;
                    $ID_field = $row2->id;
                    $opt_field .= "<option value=\"$ID_field\">$Nama_field</option>";

                    $arr_field[$ID_field] = array("nama" => $Nama_field);
                }

                $this->db->select('*');
                $this->db->from('tbl_reff_pilihdata');
                $this->db->where('hapus', 0);
                $query3 = $this->db->get();

                foreach ($query3->result() as $row3) {
                    $Nama_data = $row3->nama;
                    $ID_data = $row3->id;
                    $Nama_tabel = $row3->nama_tabel;

                    $opt_data .= "<option value=\"$Nama_tabel\">$Nama_data</option>";
                }

                //print_r($arr_field);
                ?>

                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">

                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-plus"></i> Tambah Data
                        </button>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Jenis Input</th>
                                    <th>name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 0;

                                foreach ($field as $key => $obj) {
                                    $no++;
                                    $IDdata = $obj->id;
                                    $Nama = $obj->nama_judul;
                                    $Nama_input = $obj->nama_field;
                                    $IDf = $obj->id_field;

                                    $ff = $arr_field[$IDf]["nama"];

                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $Nama ?></td>
                                        <td><?= $ff ?></td>
                                        <td><?= $Nama_input ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm bg-gradient-success" onclick="location.href='<?php echo base_url("Form/detail/$IDdata") ?>' "><i class="fa fa-edit "></i> Edit </button>
                                            <button type="button" class="btn btn-sm bg-gradient-danger" onclick="location.href='<?php echo base_url("Form/view/$IDdata") ?>' "><i class="fa fa-trash "></i> Hapus </button>
                                        </td>
                                    </tr>
                                <?php

                                }
                                ?>

                            </tbody>

                        </table>

                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Data</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo base_url() . 'Form/add'; ?>" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Judul</label>
                                                <input type="text" name="judul" class="form-control" id="exampleInputEmail1">
                                                <input type="hidden" name="id_jenis" value="<?= $idinput ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">name</label>
                                                <input type="text" name="nama_input" class="form-control" id="exampleInputEmail1">
                                                <p><code>huruf kecil, tanpa spasi</code></p>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jenis Input</label>
                                                <select class="custom-select" name="jenis_input" required>
                                                    <option value="">- Pilih</option>
                                                    <?= $opt_field ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Pilih Data</label>
                                                <select class="custom-select" name="pilih_data">
                                                    <option value="">- Pilih</option>
                                                    <?= $opt_data ?>
                                                </select>
                                                <p><code>dipilih jika memilih jenis input (Select, Radio, Checkbox)</code></p>
                                            </div>

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" name="simpan" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>



            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url("Form") ?>' "> Kembali </button>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->