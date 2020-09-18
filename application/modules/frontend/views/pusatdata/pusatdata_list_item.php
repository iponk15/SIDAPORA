<?php if (empty($records)) { ?>
    <div class="alert alert-warning">
        <strong>Mohon maaf !</strong> Untuk data item tidak ditemukan. Terima kasih
    </div>
<?php } else { ?>
    <div class="row margin-bottom-40">
        <div class="col-md-12 col-sm-12">
            <!-- <h2>List data dokumentasi</h2> -->
            <div class="content-page">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <i class="fa fa-building"></i> Nama Lembaga
                                </th>
                                <th class="hidden-xs">
                                    <i class="fa fa-briefcase"></i> Jenis Bantuan
                                </th>
                                <th>
                                    <i class="fa fa-bookmark"></i> Jumlah
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($records as $item) { ?>
                                <tr>
                                    <td>
                                        <?php echo $item->rekdet_lembaga ?>
                                    </td>
                                    <td class="hidden-xs">
                                        <?php echo $item->jnsbtn_nama ?>
                                    </td>
                                    <td>
                                        <?php echo $item->sartem_jml ?>
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>