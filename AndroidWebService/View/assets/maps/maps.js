
  var data = <?php echo $getJson; ?>;
  console.log(data.result[0].lat);

  var marker;
  var map;
  var pos;
  var InfoWindow;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -2.983807, lng: 104.8074},
      zoom: 15
    });

    for(i=0;i<data.result.length;i++){
      var myLatLng = new google.maps.LatLng(data.result[i].lat, data.result[i].lng);
      addMarker(myLatLng,"Data Pengecer",data.result[i].kode_pengecer,data.result[i].nama_pengecer,data.result[i].nama_perusahaan);
    }

    marker.setMap(map);

    currentLocation();
  }

  function addMarker(myLat,title,kode_pengecer,nama,perusahaan){
    var content = '<table>'+
                    '<tr>'+
                      '<td>Kode Pengecer </td>'+
                      '<td>'+ kode_pengecer + '<td>' +
                    '<tr>'+

                    '<tr>'+
                      '<td>Nama Pengecer </td>'+
                      '<td>'+ nama + '<td>' +
                    '<tr>'+

                    '<tr>'+
                      '<td>Nama Perusahaan </td>'+
                      '<td>'+ perusahaan + '<td>' +
                    '<tr>'+
                  '</table>';
    InfoWindow = new google.maps.InfoWindow({
      content:content,
    });

    marker = new google.maps.Marker({
      position: myLat,
      map:map,
      title:title,
      animation: google.maps.Animation.DROP,
    });

    marker.addListener('click',function(){
      InfoWindow.open(map,marker);
    });

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

                      InfoWindow.setPosition(pos);
                      InfoWindow.setContent('Location found.');
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

  function addTitle(kode_pengecer,nama,perusahaan){

  }
