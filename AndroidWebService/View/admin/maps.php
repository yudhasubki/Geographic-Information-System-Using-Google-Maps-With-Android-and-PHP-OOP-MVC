<?php
  include 'core/header.php';
  $pengecerModel = new DataPengecer();
  $pengecer = new Pengecer($koneksi,$pengecerModel);
  $getJson = $pengecer->getData($getKoneksi);

?>

<style>
#map,#map-plans {
      height: 600px;
      margin: 0px;
      padding: 20px
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <?php
                if($first_part == 'maps'){
                  echo 'PEMETAAN PENGECER';
                }
               ?>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
              <li class="active">Dashboard</li>
            </ol>
          </section>



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div id="map-plans" class="col-md-12">
          <div id="map"></div>
        </div>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script>
          var data = <?php echo $getJson; ?>;
          console.log(data.result[3].lat);
          var map;
          var pos;

          var InfoWindow;
          var Marker;
          function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: -2.983807, lng: 104.8074},
              zoom: 13
            });

            for(i=0;i<data.result.length;i++){

              var myLatLng = new google.maps.LatLng(data.result[i].lat, data.result[i].lng);
              addMarker(myLatLng,"Data Pengecer",data.result[i].kode_pengecer,data.result[i].nama_pengecer,data.result[i].nama_perusahaan);

            }

            for(i=0;i<data.result.length;i++){
              var myLatLng = new google.maps.LatLng(data.result[i].lat, data.result[i].lng);
              var pengecer = [
                {lat: -2.983807, lng:104.8074},
                myLatLng
              ];

              lineMap(pengecer);
            }

            currentLocation();

          }

          function lineMap(pengecer){
            var pengecerPath = new google.maps.Polyline({
              path: pengecer,
              geodesic: true,
              strokeColor: '#FF0000',
              strokeOpacity: 0.5,
              strokeWeight: 2
            });
            pengecerPath.setMap(map);
          }

          function addMarker(myLat,title,kode_pengecer,nama_pengecer,perusahaan){
            var content = '<center><img src="../assets/images/pusri.png" width="100px" heigh="100px"><center><br>'+
                          '<table>'+
                            '<tr>'+
                              '<td>Kode Pengecer </td>'+
                              '<td>'+ kode_pengecer + '<td>' +
                            '<tr>'+

                            '<tr>'+
                              '<td>Nama Pengecer </td>'+
                              '<td>'+ nama_pengecer + '<td>' +
                            '<tr>'+

                            '<tr>'+
                              '<td>Nama Perusahaan &nbsp;&nbsp; </td>'+
                              '<td>'+ perusahaan + '<td>' +
                            '<tr>'+
                          '</table>';

            var Info = new google.maps.InfoWindow({
              content:content,
            });

          var marker = new google.maps.Marker({
              position: myLat,
              map:map,
              title:title,
              animation: google.maps.Animation.DROP,
            });

            google.maps.event.addListener(marker,'click',function(){
              Info.open(map,marker);
            });
            marker.setMap(map);
          }

          function getLocation(){
            if(navigator.getlocation){
              navigator.geolotaion.getCurrentPosition();
            }
          }

          function currentLocation(){
                          // Try HTML5 geolocation.
                          if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                              pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                              };
                              map.setCenter(pos);
                            }, function() {
                              handleLocationError(true, infoWindow, map.getCenter());
                            });
                          } else {
                            // Browser doesn't support Geolocation
                            handleLocationError(false, infoWindow, map.getCenter());
                          }
          }

          function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                                  'Error: Service Gagal' :
                                  'Error: Browser Tidak Support Lakukan Update!.');
          }

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNlDfNXa9WaNugAM60s8wgnqz0WKnXxsI&callback=initMap" async defer></script>
        <br>
        <br>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
  include 'core/footer.php';
 ?>
