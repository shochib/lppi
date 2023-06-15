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

     <section class="content">

         <div class="card-footer clearfix">
             <button type="button" class="btn btn-primary float-right" onclick="location.href='<?php echo base_url() . 'Pengajuan/add'; ?>'"><i class="fas fa-plus"></i> Tambah Pengajuan</button>
         </div>

         <div class="card">
             <div class="card-header">
                 <h3 class="card-title">Data Pengajuan</h3>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                     <thead>
                         <tr>
                             <th>No.</th>
                             <th>Judul</th>
                             <th>Jenis</th>
                             <th>Status</th>
                             <th>Edit</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 0;
                            $array_namapen = array();
                            foreach ($nama_publikasi as $key2 => $obj2) {
                                $id = $obj2->id;
                                $nama = $obj2->nama;
                                $array_namapub[$id] = array("nama_publikasi" => $nama);
                            }

                            //print_r($array_namapub);
                            $nm_pub = "";
                            foreach ($penelitian as $key => $obj) {
                                $no++;
                                $kode = $obj->kode;
                                $id = $obj->id;
                                $id_kategori = $obj->id_kategori;
                                $st_publikasi = $obj->st_publikasi;
                                $tgl_pengaju = $obj->tanggal_pengaju;

                                if ($id_kategori == 3) {
                                    $judul = "Sitasi Artikel";
                                    $nm_pub = "Sitasi";

                                    $arr = $this->Model_form->getperiode($tgl_pengaju);
                                    $periode = $arr[0]->periode;
                                    $tgl_awal = $arr[0]->tgl_awal;
                                    $tgl_akhir = $arr[0]->tgl_akhir;
                                    $thn_sekarang = 2023;
                                    $id_user = $this->session->userdata('id_user');

                                    $arr2 = $this->Model_form->ceksitasi($thn_sekarang, $tgl_awal, $tgl_akhir, $id_user);
                                    //$id_pengajuan = $arr2[0]->id;
                                    if (count($arr2) > 0) {
                                        $id_pengajuan = $arr2[0]->id;
                                    }
                                } else {
                                    $judul = $obj->judul;

                                    if ($st_publikasi > 0) {
                                        $nm_pub = $array_namapub[$id_kategori]["nama_publikasi"];
                                    } else {
                                        $nm_pub = "-";
                                    }

                                    $id_pengajuan = $id;
                                }

                            ?>
                             <tr>
                                 <td><?= $no ?></td>
                                 <td><?= $judul ?></td>
                                 <td><?= $nm_pub ?></td>
                                 <td></td>
                                 <td><button type="button" class="btn btn-block btn-success btn-xs" onclick="location.href='<?php echo base_url("Pengajuan/form/$id_kategori/$st_publikasi/$id_pengajuan"); ?>'">Edit</button></td>
                             </tr>

                         <?php
                            }
                            ?>


                     </tbody>
                     <tfoot>
                         <tr>
                             <th>No.</th>
                             <th>Judul</th>
                             <th>Jenis</th>
                             <th>Status</th>
                             <th>Edit</th>
                         </tr>
                     </tfoot>
                 </table>
             </div>
             <!-- /.card-body -->
         </div>
         <!-- /.card -->
     </section>
 </div>