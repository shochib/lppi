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

          <section class="content">
              <div class="container-fluid">
                  <!-- Small boxes (Stat box) -->
                  <div class="row">
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                              <div class="inner">

                                  <p><b><?= $jml_jurnal ?></b> Jurnal</p>
                              </div>
                              <div class="icon">
                                  <i class="ion ion-bag"></i>
                              </div>
                              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                              <div class="inner">

                                  <p><b><?= $jml_buku ?></b> Penerbitan Buku</p>
                              </div>
                              <div class="icon">
                                  <i class="ion ion-stats-bars"></i>
                              </div>
                              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-warning">
                              <div class="inner">

                                  <p><b><?= $jml_sitasi ?></b> Jurnal Yang Di Sitasi</p>
                              </div>
                              <div class="icon">
                                  <i class="ion ion-person-add"></i>
                              </div>
                              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-danger">
                              <div class="inner">

                                  <p><b><?= $jml_penseminar ?></b> Penyertaan Seminar</p>
                              </div>
                              <div class="icon">
                                  <i class="ion ion-pie-graph"></i>
                              </div>
                              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-secondary">
                              <div class="inner">

                                  <p><b><?= $jml_prosiding ?></b> Prosiding</p>
                              </div>
                              <div class="icon">
                                  <i class="ion ion-pie-graph"></i>
                              </div>
                              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>

                      <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-primary">
                              <div class="inner">

                                  <p><b><?= $jml_bookchapter ?></b> Bookchapter</p>
                              </div>
                              <div class="icon">
                                  <i class="ion ion-pie-graph"></i>
                              </div>
                              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                      </div>
                  </div>
                  <!-- /.row -->

              </div><!-- /.container-fluid -->

          </section>
          <!-- /.card -->

          <!-- Left col -->
      </section>

      <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->

              <!-- TO DO List -->
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">
                          <i class="ion ion-clipboard mr-1"></i>

                          Daftar Pengajuan Tahun <?php echo date("Y"); ?>
                      </h3>


                      <div class="card-tools">
                          <ul class="pagination pagination-sm">
                              <?php
                                echo $this->pagination->create_links();
                                ?>
                              <!--  
                              <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                              <li class="page-item"><a href="#" class="page-link">1</a></li>
                              <li class="page-item"><a href="#" class="page-link">2</a></li>
                              <li class="page-item"><a href="#" class="page-link">3</a></li>
                              <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                             -->
                          </ul>
                      </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <ul class="todo-list" data-widget="todo-list">
                          <?php
                            $array_namapen = array();
                            foreach ($nama_publikasi as $key2 => $obj2) {
                                $id = $obj2->id;
                                $nama = $obj2->nama;
                                $array_namapub[$id] = array("nama_publikasi" => $nama);
                            }

                            $nm_pub = "";
                            foreach ($penelitian2 as $key => $obj) {

                                $kode = $obj->kode;
                                $id = $obj->id;
                                $id_kategori = $obj->id_kategori;
                                $st_publikasi = $obj->st_publikasi;
                                $tgl_pengaju = $obj->tanggal_pengaju;
                                $tgl_aju = date('d F Y', strtotime($tgl_pengaju));

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
                              <li>
                                  <!-- drag handle -->
                                  <span class="handle">
                                      <i class="fas fa-ellipsis-v"></i>
                                      <i class="fas fa-ellipsis-v"></i>
                                  </span>
                                  <!-- todo text -->
                                  <span class="text"><?= $judul ?></span>
                                  <!-- Emphasis label -->
                                  <small class="badge badge-danger"><i class="far fa-clock"></i> <?= $tgl_aju ?></small>
                                  <!-- General tools such as edit or delete-->
                                  <div class="tools">
                                      <a href='<?php echo base_url("Pengajuan/form/$id_kategori/$st_publikasi/$id_pengajuan"); ?>'><i class="fas fa-edit"></i></a>
                                  </div>
                              </li>
                          <?php
                            }
                            ?>
                      </ul>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                      <button type="button" class="btn btn-primary float-right" onclick="location.href='<?php echo base_url("Pengajuan"); ?>'"><i class="fas fa-plus"></i> Tambah Pengajuan</button>
                  </div>
              </div>
              <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

              <!-- solid sales graph -->
              <div class="card card-danger">
                  <div class="card-header">
                      <h3 class="card-title">Jenis Pengajuan</h3>

                      <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                          </button>
                      </div>
                  </div>
                  <div class="card-body">
                      <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                  <!-- /.card-body -->
              </div>

              <!-- /.card -->
          </section>
          <!-- right col -->
      </div>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- ChartJS -->
  !-- jQuery -->
  <script src="<?php echo base_url(); ?>files/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>files/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url(); ?>files/plugins/chart.js/Chart.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>files/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->

  <script>
      $(function() {
          //-------------
          //- DONUT CHART -
          //-------------
          // Get context with jQuery - using jQuery's .get() method.
          <?php
            $jmljur = $jml_jurnal;
            $jmlbuk = $jml_buku;
            $jmlsit = $jml_sitasi;
            $jmlpen = $jml_penseminar;
            $pros = $jml_prosiding;
            $bookc = $jml_bookchapter;

            $jj_set = "$jmljur, $jmlbuk, $jmlsit, $jmlpen, $pros, $bookc";
            ?>

          var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
          var donutData = {
              labels: [
                  'Jurnal',
                  'Buku',
                  'Sitasi Artikel',
                  'Penyertaan Seminar',
                  'Prosiding',
                  'Bookchapter'
              ],
              datasets: [{
                  data: [<?= $jj_set ?>],
                  backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#F5F5DC', '#7FFF00'],
              }]
          }
          var donutOptions = {
              maintainAspectRatio: false,
              responsive: true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          new Chart(donutChartCanvas, {
              type: 'doughnut',
              data: donutData,
              options: donutOptions
          })
      })
  </script>