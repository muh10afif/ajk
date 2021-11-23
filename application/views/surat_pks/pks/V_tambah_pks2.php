<div class="row">
  <div class="col-md-12">
    <div class="card">
      <form id="form_bpr" method="post" action="<?=$link?>" autocomplete="off" enctype="multipart/form-data">
        <div class="col-md-12 p-3">
          <!-- <div class="form-group row">
            <label for="nomor_spk" class="col-sm-3 col-form-label">Nomor SPK</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" style="font-size: 14px;" name="nomor_spk" id="nomor_spk" placeholder="Nomor SPK">
            </div>
          </div> -->
          <div class="form-group row">
            <label for="nama_bpr" class="col-sm-3 col-form-label">Nama BPR</label>
            <div class="col-sm-9">
              <select style="font-size: 14px;" id="nama_bpr" name="nama_bpr" onchange="sendata(this.value)" class="form-control"></select>
            </div>
          </div>
          <div class="form-group row">
            <label for="no_spk" class="col-sm-3 col-form-label">Nomor Penawaran</label>
            <div class="col-sm-9">
              <input type="hidden" id="socid" name="socid" value="<?=isset($data[0]->id_soc)?$data[0]->id_soc:0?>">
              <input type="hidden" id="idnopenawar" name="idnopenawar" value="<?=isset($data[0]->id_penawaran)?$data[0]->id_penawaran:''?>">
              <input type="number" style="font-size: 14px;" id="no_penawaran" name="no_penawaran" class="form-control" placeholder="Nomor Penawaran" value="<?=isset($data[0]->nomor_penawaran)?$data[0]->nomor_penawaran:''?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="no_spk" class="col-sm-3 col-form-label">Dokumen Penawaran</label>
            <div class="col-sm-2">
              <input type="file" style="font-size: 14px;" id="dok_penawaran" onchange="nmfile(this.value)" name="dok_penawaran" value="<?=isset($data[0]->dokumen)?$data[0]->dokumen:''?>" hidden>
              <a href="javascript:void(0)" onclick="$('#dok_penawaran').click()" class="btn btn-primary">
                <i class="fa fa-folder" aria-hidden="true"></i>
                <span class="value-digit">Upload</span>
              </a>
            </div>
            <div class="col-sm-7">
              <input type="text" style="font-size: 14px;" id="namefile" name="namefile" class="form-control" value="<?=isset($data[0]->dokumen)?$data[0]->dokumen:''?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="no_spk" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="email" style="font-size: 14px;" id="email" name="email" class="form-control" placeholder="Email" value="<?=isset($data[0]->email)?$data[0]->email:''?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="no_spk" class="col-sm-3 col-form-label">Kontak</label>
            <div class="col-sm-9">
              <input type="text" style="font-size: 14px;" id="kontak" name="kontak" class="form-control" placeholder="Kontak" value="<?=isset($data[0]->kontak)?$data[0]->kontak:''?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
              <textarea type="text" class="form-control" style="font-size: 14px;" name="alamat" id="alamat" placeholder="Nama Alamat" rows="3"><?=isset($data[0]->alamat)?$data[0]->alamat:''?></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="alamat" class="col-sm-3 col-form-label">SOC</label>
            <div class="col-sm-9">
              <input type="text" style="font-size: 14px;" id="soc" name="soc" class="form-control" placeholder="SOC" value="">
            </div>
          </div>
          <!-- <div class="form-group row">
            <label for="socc" class="col-sm-3 col-form-label">SOC</label>
            <div class="col-sm-9">
              <input type="text" style="font-size: 14px;" id="socc" name="socc" class="form-control" placeholder="SOC">
            </div>
          </div> -->
        </div>
        <hr>
        <div class="col-md-12 p-3">
          <div class="form-group row">
            <label for="soc" class="col-sm-12 col-form-label"><center><u>Detail SOC</u></center></label>
          </div>
          <div class="form-group row">
            <label for="komiage" class="col-sm-3 col-form-label">Komisi Agent</label>
            <div class="col-sm-9">
              <input type="text" class="form-control percent" value="0%" maxlength="6" style="font-size: 14px;" name="komiage" id="komiage" placeholder="Komisi Agent (%)" value="<?=isset($data[0]->komisi_agent)?$data[0]->komisi_agent.'%':''?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="fepepo" class="col-sm-3 col-form-label">Feebase Pemegang Polis</label>
            <div class="col-sm-9">
              <input type="text" class="form-control percent" value="0%" maxlength="6" style="font-size: 14px;" name="fepepo" id="fepepo" placeholder="Feebase Pemegang Polis (%)" value="<?=isset($data[0]->feebase)?$data[0]->feebase.'%':''?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="overid" class="col-sm-3 col-form-label">Overiding</label>
            <div class="col-sm-9">
              <input type="text" class="form-control percent" value="0%" maxlength="6" style="font-size: 14px;" name="overid" id="overid" placeholder="Overiding (%)" value="<?=isset($data[0]->overiding)?$data[0]->overiding.'%':''?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="konebro" class="col-sm-3 col-form-label">Komisi Nett Broker</label>
            <div class="col-sm-9">
              <input type="text" class="form-control percent" value="0%" maxlength="6" style="font-size: 14px;" name="konebro" id="konebro" placeholder="Komisi Net Broker (%)" value="<?=isset($data[0]->komisi_net_broker)?$data[0]->komisi_net_broker.'%':''?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="judeso" class="col-sm-3 col-form-label">Jumlah Detail SOC</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" value="0%" style="font-size: 14px;" name="judeso" id="judeso" placeholder="Jumlah detail SOC" value="<?=isset($data[0]->jumlah_detail_soc)?$data[0]->jumlah_detail_soc.'%':''?>" readonly>
            </div>
          </div>
        </div>
        <hr>
        <div class="col-md-12 p-3">
          <div class="form-group row">
            <label for="nefebro" class="col-sm-3 col-form-label">Nett Fee Broker</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" style="font-size: 14px;" name="nefebro" id="nefebro" placeholder="Nett Fee Broker" value="<?=isset($data[0]->net_fee_broker)?$data[0]->net_fee_broker:''?>">
            </div>
          </div>
        </div>
        <div class="col-md-12 p-3">
          <div class="form-group text-right">
            <button type="submit" class="btn text-white" style="background-color: #02a4af" id="btn-simpan">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.history.back();">Batal</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">

  $('#soc').on('keyup', function () {

      var isi     = $(this).val();
      var judeso  = $('#judeso').val().replace('%','');
      
      var jml = isi - judeso;

      if (jml < 0) {
        $('#btn-simpan').attr('disabled', true);
        
      } else {
        if (isi == judeso) {
          $('#btn-simpan').attr('disabled', true);
        } else {
          if (judeso == 0) {
            $('#btn-simpan').attr('disabled', true);
          } else {
            $('#btn-simpan').attr('disabled', false);
          }
        }
      }

      $('#nefebro').val(jml);
  })

  $('#komiage').on('keyup', function () {
    
    var isi     = $('#soc').val();
    var judeso  = $('#judeso').val().replace('%','');
    
    var jml = isi - judeso;

    if (jml < 0) {
      $('#btn-simpan').attr('disabled', true);
    } else {
      if (isi == judeso) {
        $('#btn-simpan').attr('disabled', true);
      } else {
        if (judeso == 0) {
          $('#btn-simpan').attr('disabled', true);
        } else {
          $('#btn-simpan').attr('disabled', false);
        }
      }
    }

    $('#nefebro').val(jml);

  })
  $('#fepepo').on('keyup', function () {
    
    var isi     = $('#soc').val();
    var judeso  = $('#judeso').val().replace('%','');
    
    var jml = isi - judeso;

    if (jml < 0) {
      $('#btn-simpan').attr('disabled', true);
    } else {
      if (isi == judeso) {
        $('#btn-simpan').attr('disabled', true);
      } else {
        if (judeso == 0) {
          $('#btn-simpan').attr('disabled', true);
        } else {
          $('#btn-simpan').attr('disabled', false);
        }
      }
    }

    $('#nefebro').val(jml);

  })
  $('#overid').on('keyup', function () {
    
    var isi     = $('#soc').val();
    var judeso  = $('#judeso').val().replace('%','');
    
    var jml = isi - judeso;

    if (jml < 0) {
      $('#btn-simpan').attr('disabled', true);
    } else {
      if (isi == judeso) {
        $('#btn-simpan').attr('disabled', true);
      } else {
        if (judeso == 0) {
          $('#btn-simpan').attr('disabled', true);
        } else {
          $('#btn-simpan').attr('disabled', false);
        }
      }
    }

    $('#nefebro').val(jml);

  })

  $('#konebro').on('keyup', function () {
    
    var isi     = $('#soc').val();
    var judeso  = $('#judeso').val().replace('%','');
    
    var jml = isi - judeso;

    if (jml < 0) {
      $('#btn-simpan').attr('disabled', true);
    } else {
      if (isi == judeso) {
        $('#btn-simpan').attr('disabled', true);
      } else {
        if (judeso == 0) {
          $('#btn-simpan').attr('disabled', true);
        } else {
          $('#btn-simpan').attr('disabled', false);
        }
      }
    }

    $('#nefebro').val(jml);

  })

  $.ajax({
    type:"GET",
    url : "<?=base_url()?>index.php/C_register_user/bprdata",
    contentType:"application/json",
    dataType: "json",
    success:function(res) {
      let isi = '<option data-display="bpr">- BPR -</option>';
      for (var i = 0; i < res.length; i++) {
        if (<?=isset($data[0]->id_bpr)?$data[0]->id_bpr:0?> == res[i]['id_bpr']) {
          isi = isi+'<option value="'+res[i]['id_bpr']+'" selected>'+res[i]['nama_bpr']+'</option>';
        } else {
          isi = isi+'<option value="'+res[i]['id_bpr']+'">'+res[i]['nama_bpr']+'</option>';
        }
      }
      $("#nama_bpr").html(isi);
    }
  });


  document.querySelector('#komiage').addEventListener('input', function(e) {
    let int = e.target.value.slice(0, e.target.value.length - 1);
    sendpercent(int, e);
  });
  document.querySelector('#fepepo').addEventListener('input', function(e) {
    let int = e.target.value.slice(0, e.target.value.length - 1);
    sendpercent(int, e);
  });
  document.querySelector('#overid').addEventListener('input', function(e) {
    let int = e.target.value.slice(0, e.target.value.length - 1);
    sendpercent(int, e);
  });
  document.querySelector('#konebro').addEventListener('input', function(e) {
    let int = e.target.value.slice(0, e.target.value.length - 1);
    sendpercent(int, e);
  });

  function sendpercent(int, e) {
    if (int.includes('%')) {
      e.target.value = '%';
    } else if (int.length >= 3 && int.length <= 4 && !int.includes('.')) {
      e.target.value = int.slice(0, 2) + '.' + int.slice(2, 3) + '%';
      e.target.setSelectionRange(4, 4);
    } else if (int.length >= 5 & int.length <= 6) {
      let whole = int.slice(0, 2);
      let fraction = int.slice(3, 5);
      e.target.value = whole + '.' + fraction + '%';
    } else {
      e.target.value = int + '%';
      e.target.setSelectionRange(e.target.value.length - 1, e.target.value.length - 1);
    }
    getInt(e.target.value)
  }

  function getInt(val) {
    let komiage = $('#komiage').val();
    let fepepo  = $('#fepepo').val();
    let overid  = $('#overid').val();
    let konebro = $('#konebro').val();

    let ge = komiage != '%' ? komiage.split('%'):0;
    let po = fepepo  != '%' ? fepepo.split('%'):0;
    let id = overid  != '%' ? overid.split('%'):0;
    let ro = konebro != '%' ? konebro.split('%'):0;

    let ko = ge[0] != ''?parseFloat(ge[0]):0;
    let fe = po[0] != ''?parseFloat(po[0]):0;
    let ov = id[0] != ''?parseFloat(id[0]):0;
    let kn = ro[0] != ''?parseFloat(ro[0]):0;

    $('#judeso').val(ko+fe+ov+kn+"%");
  }

  function nmfile(nmf) {
    let last = nmf.split("\\");
    $('#namefile').val(last[last.length-1]);
  }

  function sendata(vale) {
    $.ajax({
      type:"GET",
      url : "<?=base_url()?>index.php/C_register_user/bprdata/"+vale,
      contentType:"application/json",
      dataType: "json",
      success:function(res) {
        $("#email").val(res[0]['email']);
        $("#kontak").val(res[0]['kontak']);
        $("#alamat").val(res[0]['alamat']);
        $("#no_penawaran").val(res[0]['nomor_penawaran']);

        nopenawaran(vale);
      }
    });
  }

  function nopenawaran(cekk) {
    $.ajax({
      type:"GET",
      url : "<?=base_url()?>index.php/C_pks/nomorpenawaran/"+cekk,
      contentType:"application/json",
      dataType: "json",
      success:function(res) {
        console.log(res[0])
        if (res != '') {
          if (res[0]['dokumen'] != null) {
            swal({
              title               : "Gagal",
              text                : 'Nomor Penawaran tidak bisa di gunakan',
              buttonsStyling      : false,
              confirmButtonClass  : "btn btn-primary",
              type                : 'error',
              showConfirmButton   : false,
              timer               : 1000
            });
            $('button[type="submit"]').prop('disabled', true);
            return false;
          } else {
            $("#idnopenawar").val(res[0]['id_penawaran']);
            $("#no_penawaran").val(res[0]['nomor_penawaran']);
            $('button[type="submit"]').prop('disabled', false);
          }
        } else {
          swal({
            title               : "Gagal",
            text                : 'Nomor Penawaran Belum di buat',
            buttonsStyling      : false,
            confirmButtonClass  : "btn btn-primary",
            type                : 'warning',
            showConfirmButton   : false,
            timer               : 1000
          });
          $('button[type="submit"]').prop('disabled', true);
          $("#idnopenawar").val('');
          $("#no_penawaran").val('');
          return false;
        }

      }
    });
  }

  // $('select[name="nama_bpr"]').change(function () {
    // console.log($(this).val());
  // });

  $('#form_bpr').on('submit', function () {
    var form_bpr = $('#form_bpr').serialize();
    var cek = form_bpr.split("&");
    var y = 0;
    for (var i = 0; i < cek.length; i++) {
      let isi = cek[i].split("");
      let yo = isi[isi.length - 1];
      if (yo == "=") { y++; }
    }
    if (y == 0) {
      swal({
          title       : 'Konfirmasi',
          text        : 'Yakin akan kirim data',
          type        : 'warning',

          buttonsStyling      : false,
          confirmButtonClass  : "btn btn-primary",
          cancelButtonClass   : "btn btn-warning mr-3",

          showCancelButton    : true,
          confirmButtonText   : 'Ya',
          confirmButtonColor  : '#3085d6',
          cancelButtonColor   : '#d33',
          cancelButtonText    : 'Batal',
          reverseButtons      : true
      }).then((result) => {
        if (result.dismiss === swal.DismissReason.cancel) {
          swal({
              title               : "Batal",
              text                : 'Anda membatalkan simpan data',
              buttonsStyling      : false,
              confirmButtonClass  : "btn btn-primary",
              type                : 'error',
              showConfirmButton   : false,
              timer               : 1000
          });

          return false;
        }
      });

    } else {
      swal({
          title               : "Peringatan",
          text                : 'Ada Data Yang tidak di Isi !',
          buttonsStyling      : false,
          type                : 'warning',
          showConfirmButton   : false,
          timer               : 1000
      });

      return false;
    }
  });
</script>
