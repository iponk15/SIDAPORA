<div class="row margin-bottom-40">
    <div class="col-md-12 col-sm-12">
        <!-- <h2>List data dokumentasi</h2> -->
        <div class="content-page">
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><i class="fa fa-building"></i> No</th>
                            <th class="text-center"><i class="fa fa-briefcase"></i> Cabor</th>
                            <th class="text-center"><i class="fa fa-bookmark"></i> Item Cabor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($records)) { ?>
                            <tr class="text-center">
                                <td colspan="3">
                                    <b><u><i>Data tidak ditemukan!</i> </u></b>
                                </td>
                            </tr>
                        <?php } else { ?>
                            <?php 
                                $no = 1; 
                                foreach ($records as $item) { 
                                    $list = getListItem(md56($item->sarbor_id));
                            ?>
                                        <tr>
                                            <td class="text-center""><?php echo $no ++; ?></td>
                                            <td><?php echo $item->sarbor_cabor ?></td>
                                            <td>
                                                <?php
                                                    foreach ($list as $lst) {
                                                        echo '<ul>
                                                                <li>'.$lst->sarbortem_item.' - '.$lst->sarbortem_jml.' '.$lst->sarbortem_satuan.'</li>
                                                            </ul>';
                                                    }      
                                                ?>
                                            </td>
                                        </tr>
                            <?php } ?>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>