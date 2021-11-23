<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <a href="<?= base_url('C_pks/tambah_klausal') ?>"><button class="btn float-right text-white" style="background-color: #02a4af">Tambah Data</button></a>
            
                <h4 id="judul" class="font-weight-bold">Klausal Asuransi</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-striped" id="tabel_asuransi" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Nama Asuransi</th>
                            <th width="20%">Jenis Produk</th>
                            <th width="7%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_lihat" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #02a4af">
        <h5 class="modal-title font-weight-bold" id="judul_modal">Lihat Klausal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
        </button>
      </div>
        <form id="form_bpr" autocomplete="off">

            <div class="modal-body">

            <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active font-weight-bold" id="syarat-tab" data-toggle="tab" href="#syarat" role="tab" aria-controls="syarat" aria-selected="true">Syarat Pertanggungan</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link font-weight-bold" id="kriteria-tab" data-toggle="tab" href="#kriteria" role="tab" aria-controls="kriteria" aria-selected="false">Kriteria Peserta</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link font-weight-bold" id="underwriting-tab" data-toggle="tab" href="#underwriting" role="tab" aria-controls="underwriting" aria-selected="false">Underwriting</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link font-weight-bold" id="tarif-tab" data-toggle="tab" href="#tarif" role="tab" aria-controls="tarif" aria-selected="false">Tarif Asusransi</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="syarat" role="tabpanel" aria-labelledby="syarat-tab">

                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Maksimal Plafond</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="maksimal_plafond" name="maksimal_plafond" class="form-control" placeholder="Masukkan Maksimal Plafond">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">X+N</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="x_plus_n" name="x_plus_n" class="form-control" placeholder="Masukkan X+N">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Free Cover</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="free_cover" name="free_cover" class="form-control" placeholder="Masukkan Free Cover">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Tenor Maksimal</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="tenor_maksimal" name="tenor_maksimal" class="form-control" placeholder="Masukkan Tenor Maksimal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">CBC</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="cbc" name="cbc" class="form-control" placeholder="Masukkan CBC">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Polis Induk</label>
                            <div class="col-sm-9">
                                <select name="sts_polis_induk" id="sts_polis_induk">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Sertifikat/Deklarasi</label>
                            <div class="col-sm-9">
                                <select name="sts_sertifikat" id="sts_sertifikat">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">PKS</label>
                            <div class="col-sm-9">
                                <select name="sts_pks" id="sts_pks">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Brokerage</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="brokerage" name="brokerage" class="form-control" placeholder="Masukkan Brokerage">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Cash Back</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="cash_back" name="cash_back" class="form-control" placeholder="Masukkan Cash Back">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Company Profile</label>
                            <div class="col-sm-9">
                                <select name="sts_company_profile" id="sts_company_profile">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade p-3" id="kriteria" role="tabpanel" aria-labelledby="kriteria-tab">

                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Jenis Kredit</label>
                            <div class="col-sm-9">
                                <select name="jenis_kredit" id="jenis_kredit">
                                    <option value="1">Jenis Kredit 1</option>
                                    <option value="2">Jenis Kredit 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">No. Perjanjian Kredit</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="no_perjanjian_kredit" name="no_perjanjian_kredit" class="form-control" placeholder="Masukkan No. Perjanjian Kredit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="nama" name="nama" class="form-control" placeholder="Masukkan Nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select name="jenis_kredit" id="jenis_kredit">
                                    <option value="1">Pria</option>
                                    <option value="2">Wanita</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">No Identitas Diri / KTP</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="no_identitas" name="no_identitas" class="form-control" placeholder="Masukkan Nomor Identitas">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" id="no_identitas" name="no_identitas" class="form-control datepicker2" placeholder="Masukkan Tanggal Lahir">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" style="font-size: 14px;" name="alamat2" id="alamat2" cols="30" rows="2" placeholder="Masukkan Alamat"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Plafond Kredit</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="plafond_kredit" name="plafond_kredit" class="form-control" placeholder="Masukkan Plafond Kredit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Jangka Waktu/Tenor (Bulan)</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="jangka_waktu_tenor" name="jangka_waktu_tenor" class="form-control" placeholder="Masukkan Jangka Waktu Tenor">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Mulai Kredit</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="mulai_kerdit" name="mulai_kerdit" class="form-control datepicker2" placeholder="Masukkan Mulai Kredit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Berakhir Kredit</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="berakhir_kerdit" name="berakhir_kerdit" class="form-control datepicker2" placeholder="Masukkan Berakhir Kredit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Rate</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="rate" name="rate" class="form-control" placeholder="Masukkan Rate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Premi</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="permi" name="permi" class="form-control" placeholder="Masukkan Premi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Jaminan</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="jaminan" name="jaminan" class="form-control" placeholder="Masukkan Jaminan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Jenis Jaminan</label>
                            <div class="col-sm-9">
                                <select name="jenis_jaminan" id="jenis_jaminan">
                                    <option value="1">Jaminan 1</option>
                                    <option value="2">Jaminan 2</option>
                                </select>
                            </div>
                        </div>
                    
                    </div>
                    <div class="tab-pane fade" id="underwriting" role="tabpanel" aria-labelledby="underwriting-tab">
                    
                    </div>
                    <div class="tab-pane fade" id="tarif" role="tabpanel" aria-labelledby="tarif-tab">
                    
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- <script>function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 34.397, lng: 150.644 },
        scrollwheel: false,
        zoom: 2
    });
}

</script>
<script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8Lo7ml-uJcGwnpY0JiSPv8IYG3nr5MTI&callback=initMap">
    </script>

<div>
  <div id="map" style="width: 500px; height: 400px;"></div>
</div> -->

<script>

    $(document).ready(function () {

        // 04-02-2021
        var tabel_asuransi = $('#tabel_asuransi').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>C_pks/tampil_data_asuransi",
                "type"  : "POST"
            },

            "columnDefs"        : [{
                "targets"   : [0,3],
                "orderable" : false
            }, {
                'targets'   : [0,3],
                'className' : 'text-center',
            }]

        })

        // 03-02-2021
        $('#lihat_klausal').on('click', function () {

            $('#modal_lihat').modal('show');
            
        })

        // 31-03-2021
        $('#tabel_asuransi').on('click', '.hapus', function () {

            var id_asuransi     = $(this).data('id');
            var id_jenis_produk = $(this).attr('id_jenis_produk');
            
            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data klausul?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-primary mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "<?= base_url() ?>C_pks/hapus_klausul",
                        method      : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        data        : {id_asuransi:id_asuransi, id_jenis_produk:id_jenis_produk},
                        dataType    : "JSON",
                        success     : function (data) {

                            tabel_asuransi.ajax.reload(null,false);   

                            swal({
                                title               : 'Hapus data',
                                text                : 'Data Klausul Berhasil Dihapus',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 1000
                            }); 

                            
                        },
                        error       : function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
                        }

                    })

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                            title               : 'Batal',
                            text                : 'Anda membatalkan hapus data klausul',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                }
            })


        })
        
    })

</script>