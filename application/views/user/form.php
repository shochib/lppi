<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $jurnal['nama']; ?></h1>
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
        <?php
        $id_jenis = $this->uri->segment(3, 0);
        $id_publis = $this->uri->segment(4, 0);
        $id_pengaju = $this->uri->segment(5, 0);

        $no = 0;
        $form = "";
        $form2 = "";
        $form_jurnal = "";
        $form_pensitasi = "";
        $bagi2 = floor(count($field) / 2);

        $array_val = array();
        foreach ($publikasi_user as $key3 => $obj3) {

            foreach ($publikasi_colum as $key2 => $obj2) {
                $Field = $obj2->Field;
                $vl = $obj3->$Field;

                $array_val[$Field] = array("nilai" => $vl);
            }
        }

        //print_r($array_val);

        foreach ($field as $key => $obj) {
            $no++;
            $IDdata = $obj->id;
            $IDfield = $obj->id_field;
            $Namafield = $obj->nama_field;
            $Namajudul = $obj->nama_judul;
            $IDpublikasi = $obj->id_publikasi;
            $Subform = $obj->sub_form;

            if ($IDfield == 1) {

                if (!empty($array_val[$Namafield]["nilai"])) {
                    $val1 = $array_val[$Namafield]["nilai"];
                } else {
                    $val1 = "";
                }

                $field = "<input type=\"text\" name=\"$Namafield\" class=\"form-control\" id=\"exampleInputEmail1\" value=\"$val1\" >";
            } elseif ($IDfield == 3) {
                $reff_pilihdata = $obj->reff_pilihdata;
                if ($reff_pilihdata) {

                    $radio = "";
                    $field = "";

                    $this->db->select('*');
                    $this->db->from($reff_pilihdata);
                    $this->db->where('hapus', 0);
                    $query = $this->db->get();

                    foreach ($query->result() as $row) {
                        $Nama = $row->nama;
                        $ID_data = $row->id;

                        if (!empty($array_val[$Namafield]["nilai"])) {
                            $val2 = $array_val[$Namafield]["nilai"];
                        } else {
                            $val2 = "";
                        }

                        if ($val2 == $ID_data) {
                            $cek = "checked";
                        } else {
                            $cek = "";
                        }

                        $field .= "<div class=\"custom-control custom-radio\">
                        <input class=\"form-check-input\" type=\"radio\" name=\"$Namafield\" value=\"$ID_data\" $cek> $Nama 
                        </div>";
                    }
                }
            } elseif ($IDfield == 5) {
                $field = "<div class=\"input-group\">
                      <div class=\"custom-file\">
                        <input type=\"file\" class=\"custom-file-input\" id=\"exampleInputFile\" name=\"$Namafield\">
                        <label class=\"custom-file-label\" for=\"exampleInputFile\">Choose file</label>
                      </div>
                      
                    </div>";
            } elseif ($IDfield == 6) {
                //$val3 = $array_val[$Namafield]["nilai"];
                if (!empty($array_val[$Namafield]["nilai"])) {
                    $val3 = $array_val[$Namafield]["nilai"];
                } else {
                    $val3 = "";
                }

                $field = "<input type=\"date\" name=\"$Namafield\" class=\"form-control\" id=\"exampleInputEmail1\" value=\"$val3\">";
            } elseif ($IDfield == 7) {
                $thn_now = date("Y");
                //$val4 = $array_val[$Namafield]["nilai"];
                if (!empty($array_val[$Namafield]["nilai"])) {
                    $val4 = $array_val[$Namafield]["nilai"];
                } else {
                    $val4 = "";
                }
                $field = "<input type=\"number\" name=\"$Namafield\" value=\"$thn_now\" class=\"form-control\" id=\"exampleInputEmail1\" value=\"$val4\">";
            }

            if ($Subform == $IDpublikasi) {
                $form_pensitasi .= "<div class=\"form-group\">
                    <label for=\"exampleInputEmail1\">$Namajudul</label>
                    $field
                </div>";
            } else {
                $form_jurnal .= "<div class=\"form-group\">
                    <label for=\"exampleInputEmail1\">$Namajudul</label>
                    $field
                </div>";
            }

            if ($no <= $bagi2) {
                $form .= "<div class=\"form-group\">
                    <label for=\"exampleInputEmail1\">$Namajudul</label>
                    $field
                </div>";
            } else {
                $form2 .= "<div class=\"form-group\">
                    <label for=\"exampleInputEmail1\">$Namajudul</label>
                    $field
                </div>";
            }
        }

        ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $jurnal_detail['nama']; ?></h3>

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

                <?php
                if ($Subform > 0) {
                ?>
                    <div class="card-body">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-jurnal">
                            <i class="fa fa-plus"></i> Tambah Jurnal
                        </button>
                        <hr>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No.</th>
                                    <th>Jurnal</th>
                                    <th>Jurnal Pensitasi</th>
                                    <th style="width: 40px">Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($penelitian) > 0) {
                                    $nu = 0;
                                    foreach ($penelitian as $key => $obj) {
                                        $nu++;
                                        $judul = $obj->judul;
                                        $id_penelitian = $obj->id;

                                        $judul_s = "";
                                        foreach ($sitasi as $key2 => $obj2) {
                                            $id_penelitian2 = $obj2->id_penelitian;
                                            if ($id_penelitian == $id_penelitian2) {
                                                $judul_sitasi = $obj2->judul;
                                                $judul_s .= "$judul_sitasi <br>";
                                            }
                                        }
                                ?>
                                        <tr>
                                            <td><?= $nu ?></td>
                                            <td><?= $judul ?></td>
                                            <td> <?= $judul_s ?>

                                                <br>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-pensitasi-<?= $nu ?>">
                                                    <i class="fa fa-plus"></i> Tambah Pensitasi
                                                </button>
                                            </td>
                                            <td></td>
                                        </tr>

                                        <div class="modal fade" id="modal-pensitasi-<?= $nu ?>">
                                            <div class="modal-dialog">

                                                <form action="<?php echo base_url() . 'Pengajuan/simpan'; ?>" method="post" enctype="multipart/form-data">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Tambah Data Pensitasi</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="card-body">
                                                            <input type="hidden" name="id_jenis" value="<?= $id_jenis ?>">
                                                            <input type="hidden" name="id_publis" value="<?= $id_publis ?>">
                                                            <input type="hidden" name="id_pengaju" value="<?= $id_pengaju ?>">
                                                            <input type="hidden" name="id_penelitian" value="<?= $id_penelitian ?>">
                                                            <input type="hidden" name="sub_form_input" value="3">

                                                            <?= $form_pensitasi ?>
                                                        </div>
                                                        <!-- /.card-body -->

                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="simpan" class="btn btn-primary">Save</button>
                                                        </div>

                                                    </div>
                                                </form>

                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                <?php
                                    }
                                } ?>


                            </tbody>
                        </table>
                    </div>

                    <div class="modal fade" id="modal-jurnal">
                        <div class="modal-dialog">
                            <form action="<?php echo base_url() . 'Pengajuan/simpan'; ?>" method="post" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Data</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="card-body">
                                        <input type="hidden" name="id_jenis" value="<?= $id_jenis ?>">
                                        <input type="hidden" name="id_publis" value="<?= $id_publis ?>">
                                        <input type="hidden" name="id_pengaju" value="<?= $id_pengaju ?>">

                                        <?= $form_jurnal ?>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" name="simpan" class="btn btn-primary">Save</button>
                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </form>
                        </div>
                        <!-- /.modal-dialog -->
                    </div>



                <?php
                } else {
                ?>
                    <div class="card-body">
                        <form action="<?php echo base_url() . 'Pengajuan/simpan'; ?>" method="post" enctype="multipart/form-data">
                            <div class="row">

                                <!-- left column -->
                                <div class="col-md-6">
                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Isian Ke 1</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->

                                        <div class="card-body">
                                            <input type="hidden" name="id_jenis" value="<?= $id_jenis ?>">
                                            <input type="hidden" name="id_publis" value="<?= $id_publis ?>">
                                            <input type="hidden" name="id_pengaju" value="<?= $id_pengaju ?>">

                                            <?= $form ?>
                                        </div>
                                        <!-- /.card-body -->



                                    </div>
                                    <!-- /.card -->

                                </div>
                                <!--/.col (left) -->
                                <!-- right column -->
                                <div class="col-md-6">
                                    <!-- Form Element sizes -->
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Isian Ke 2</h3>
                                        </div>
                                        <div class="card-body">
                                            <?= $form2 ?>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->

                                    <!-- /.card -->
                                </div>
                                <!--/.col (right) -->

                            </div>


                            <button type="submit" class="btn btn-primary">Simpan</button>


                        </form>
                    </div>
                <?php

                }
                ?>


            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">

            <button type="button" class="btn btn-default" onclick="location.href='<?php echo base_url("Pengajuan/add") ?>' "> Kembali</button>
        </div>
        <!-- /.card-footer-->
</div>
</section>

</div>