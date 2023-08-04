<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title"> <?php echo $title_card; ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php
                if(session()->getFlashdata('success')){
                     ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Success</h5>
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php
                }
                ?>

            

                <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>/Provinsi/tambah"><i class="fa-solid fa-plus"></i>Tambah Provinsi</a>
            <table class=" table">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Id_provinsi</th>
                        <th>Provinsi</th>
                        <th>Kota</th>
                        <th>kecamatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        foreach ($data_Provinsi as $r){

                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $r['Id_provinsi']; ?></td>
                                <td><?php echo $r['Provinsi']; ?></td>
                                <td><?php echo $r['kota']; ?></td>
                                <td><?php echo $r['kecamatan']; ?></td>
                                <td><a class="btn btn- outline-success btn-sm" href="<?php echo base_url(); ?>/Provinsi/edit/<?php echo $r['Id_provinsi']; ?>"><i class="fa-regular fa-pen-to-square"></i></a> 
                                    <a class="btn btn- outline-danger btn-sm" href="#"onclick="return hapusConfig(<?php echo $r['Id_provinsi']; ?>);"><i class="fa-solid fa-trash"></i></a>
                                 </td>
                             </tr>
                        <?php
                             $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>
</div>

<script>
    function hapusConfig() {
         Swal.fire({
            title: 'Anda yakin akan menghapus data ini?',
            Text: " Data akan dihapus secara permanen",
            icon: 'warning',
            showCancelButtton: true,
            confireButtonColor: '#3005d6',
            cancelButtonColor: '#d33',
            confireButtontext: 'Ya, Hapus data!'
        }).then((resuls) => {
            if (resuls.isConfireed) {
                 window.location.href = '<?php echo base_url();?>/Provinsi/hapus' + id;
            }
        })
    }
</script>
<?php
echo $this->endsection();