<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman Laporan Kegiatan</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $data['title']; ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url; ?>/faktaintegritas/updateFaktaIntegritas" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['tb_fakta_integritas']['id']; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="masukkan Alamat..." name="alamat" value="<?= $data['tb_fakta_integritas']['alamat']; ?>">
                        <label>Hari</label>
                        <input type="date" class="form-control" placeholder="masukkan Hari..." name="hari" value="<?= $data['tb_fakta_integritas']['hari']; ?>">
                        <label>Nomor Telepon</label>
                        <input type="number" class="form-control" placeholder="masukkan Nomor Telepon..." name="nomor_telepon" value="<?= $data['tb_fakta_integritas']['nomor_telepon']; ?>">
                        <label>Tanggal Berangkat</label>
                        <input type="date" class="form-control" placeholder="masukkan Tanggal Berangkat..." name="tanggal_berangkat" value="<?= $data['tb_fakta_integritas']['tanggal_berangkat']; ?>">
                        <label>Tanggal Pulang</label>
                        <input type="date" class="form-control" placeholder="masukkan Tanggal Pulang..." name="tanggal_pulang" value="<?= $data['tb_fakta_integritas']['tanggal_pulang']; ?>">
                        <label>Tempat Tujuan</label>
                        <input type="text" class="form-control" placeholder="masukkan Tempat Tujuan..." name="tempat_tujuan" value="<?= $data['tb_fakta_integritas']['tempat_tujuan']; ?>">
                        <label>File Upload</label>
                        <input type="text" class="form-control" placeholder="masukkan Tanggal Pulang..." name="fileupload" value="<?= $data['tb_fakta_integritas']['fileupload']; ?>">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->