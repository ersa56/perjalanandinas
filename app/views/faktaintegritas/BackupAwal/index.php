<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $data['title']; ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <?php Flasher::Message(); ?>
            </div>
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $data['title'] ?></h3>
                <div class="btn-group float-right">
                    <a href="<?= base_url; ?>/faktaintegritas/tambah" class="btn float-right btn-xs btn btn-primary">Tambah Data</a>
                    <a href="<?= base_url; ?>/faktaintegritas/laporan" class="btn float-right btn-xs btn btn-info" target="_blank">Laporan</a>
                    <a href="<?= base_url; ?>/faktaintegritas/lihatlaporan" class="btn float-right btn-xs btn btn-warning" target="_blank">Lihat Laporan</a>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url; ?>/faktaintegritas/cari" method="post">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="" name="key">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Cari Data</button>
                                    <a class="btn btn-outline-danger" href="<?= base_url; ?>/faktaintegritas">Reset</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Alamat</th>
                            <th>Hari</th>
                            <th>Nomor Telepon</th>
                            <th>Tanggal Berangkat</th>
                            <th>Tanggal Pulang</th>
                            <th>Tempat Tujuan</th>
                            <th>Upload File</th>
                            <th style="width: 150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data['tb_fakta_integritas'] as $row) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $row['alamat']; ?></td>
                                <td><?= $row['hari']; ?></td>
                                <td><?= $row['nomor_telepon']; ?></td>
                                <td><?= $row['tanggal_berangkat']; ?></td>
                                <td><?= $row['tanggal_pulang']; ?></td>
                                <td><?= $row['tempat_tujuan']; ?></td>
                                <td><?= $row['fileupload']; ?></td>
                                <td>
                                    <a href="<?= base_url; ?>/faktaintegritas/edit/<?= $row['id'] ?>" class="badge badge-info ">Edit</a>
                                    <a href="<?= base_url; ?>/faktaintegritas/hapus/<?= $row['id'] ?>" class="badge badge-danger" onclick="return confirm('Hapus data?');">Hapus</a>
                                </td>
                            </tr>
                        <?php $no++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->