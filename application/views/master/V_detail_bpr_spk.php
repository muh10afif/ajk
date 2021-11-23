<div class="modal-header text-white" style="background-color: #02a4af">
    <h5 class="modal-title font-weight-bold" id="judul_modal">Detail <?= ucwords($nama_bpr) ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
    </button>
</div>

<div class="modal-body isi_modal">

    <table class="table table-bordered table-hover tabel_detail_spk" width="100%" cellspacing="0">
        <thead class="thead-light">
            <tr>
                <th width="5%">No</th>
                <th width="10%">No SPK</th>
                <th width="10%">Tanggal Dimulai</th>
                <th width="10%">Tanggal Berakhir</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($detail)) : ?>
                <?php $no=1; foreach ($detail as $d): ?>
                    <tr>
                        <td align="center"><?= $no ?>.</td>
                        <td><?= $d['no_spk'] ?></td>
                        <td align="center"><?= nice_date($d['tgl_mulai'], 'd-M-Y') ?></td>
                        <td align="center"><?= nice_date($d['tgl_berakhir'], 'd-M-Y') ?></td>
                    </tr>
                <?php $no++; endforeach; ?>
            <?php else : ?>
                <tr>
                    <td align="center" colspan="4">Data Kosong</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
    
<div class="modal-footer">
    <button type="button" class="btn text-white" style="background-color: #02a4af" data-dismiss="modal">Close</button>
</div>