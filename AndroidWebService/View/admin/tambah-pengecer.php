<?php
if(isset($_POST['submit'])){

  $kode_pengecer = $_POST['kode_pengecer'];
  $nama_pengecer = $_POST['nama_pengecer'];
  $nama_perusahaan = $_POST['nama_perusahaan'];
  $alamat = $_POST['alamat'];
  $late = $_POST['lat'];
  $long = $_POST['lng'];
  $status = 0;
  $tambahData = $pengecer->saveData($getKoneksi,$kode_pengecer,$nama_pengecer,$nama_perusahaan,$alamat,$late,$long);
    if($tambahData){
      echo '<script>window.alert("Berhasil Menyimpan Data");window.location=("data-pengecer")</script>';
    }else{
        echo '<script>window.alert("Error");window.location=("data-pengecer")</script>';
    }
  }

 ?>
<div class="row">
  <div class="col-md-12">

  <div class="box box-danger">

    <div class="box-header with-border">
      <h3 class="box-title">Tambah Data</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
        <form action="" method="POST" id="tambahForm" name="tambahData">
          <div class="form-group">
            <label>Kode Pengecer</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-code"></i>
              </div>
              <input type="text" name="kode_pengecer" id="kode_pengecer" class="form-control" placeholder="kode...">
            </div>
          </div>

          <div class="form-group">
            <label>Nama Pengecer</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
              <input type="text" name="nama_pengecer" id="nama_pengecer" class="form-control" placeholder="nama...">
            </div>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Alamat</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-compass"></i>
              </div>
              <input type="text" name="alamat" id="alamat" class="form-control" placeholder="alamat...">
            </div>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Perusahaan</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-building"></i>
              </div>
              <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" placeholder="perusahaan...">
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <!-- /.form-group -->
            <div class="form-group">
              <label>Lat</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-map-marker"></i>
                </div>
                <input type="number" name="lat" id="lat" class="form-control" placeholder="lat...">
              </div>
            </div>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <!-- /.form-group -->
            <div class="form-group">
              <label>Long</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-map-marker"></i>
                </div>
                <input type="number" name="lng" id="lng" class="form-control" placeholder="long...">
              </div>
            </div>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <!-- /.form-group -->
            <div class="form-group">
              <div class="input-group">
                <button type="submit" class="btn btn-primary box submit" name="submit"><i class="fa fa-download"></i> Save</button>
              </div>
            </div>
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    </form>
  <!-- /.box-body -->
  <div class="box-footer">
    Visit <a href="https://pusri.co.id/">PT Pupuk Sriwidjaja</a>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
  toHtmlNumericInput('lat');
  toHtmlNumericInput('lng');
function toHtmlNumericInput(inputElementId, useCommaAsDecimalSeparator) {
            var textbox = document.getElementById(inputElementId);
            textbox.addEventListener("keydown", function _OnNumericInputKeyDown(e) {
                var key = e.which || e.keyCode; // http://keycode.info/
                if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                    // alphabet
                    key >= 65 && key <= 90 ||
                    // spacebar
                    key == 32) {
                    e.preventDefault();
                    return false;
                }
                if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                    // numbers
                    key >= 48 && key <= 57 ||
                    // Numeric keypad
                    key >= 96 && key <= 105 ||
                    // allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // allow: Ctrl+C
                    (key == 67 && e.ctrlKey === true) ||
                    // Allow: Ctrl+X
                    (key == 88 && e.ctrlKey === true) ||
                    // allow: home, end, left, right
                    (key >= 35 && key <= 39) ||
                    // Backspace and Tab and Enter
                    key == 8 || key == 9 || key == 13 ||
                    // Del and Ins
                    key == 46 || key == 45) {
                    return true;
                }
                var v = this.value;
                if (key == 109 || key == 189) {
                    if (v[0] === '-') {
                        return false;
                    }
                }
                if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                    key == 190 || key == 188 || key == 110) {
                    if (/[\.,]/.test(v)) {
                        return false;
                    }
                }
            });
            
        }
  
</script>