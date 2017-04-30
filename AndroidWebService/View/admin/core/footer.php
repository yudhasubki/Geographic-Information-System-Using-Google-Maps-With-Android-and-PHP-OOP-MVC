<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> Beta
  </div>
  <strong>Copyright &copy; 2017 <a href="http://almsaeedstudio.com">Yudha Subki</a>.</strong>
</footer>

<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../assets/helper/jquery.validation.js"></script>
<script src="../assets/helper/jquery.additional.js"></script>

<!-- DataTables -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../assets/plugins/fastclick/fastclick.js"></script>
<!-- -->
<script src="../assets/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js"></script>
<script src="../assets/dist/js/tinymce.min.js"></script>
<script src="../assets/dist/js/jtable/jquery.jtable.min.js"></script>
<script src="../assets/helper/dataTable.js"></script>
<script>
      $('#tablePosisi').DataTable({
        "order":[[1,"asc"]]
      });
      $(function() {
        $("form[name='tambahData']").validate({
          rules: {
            kode_pengecer: "required",
            nama_pengecer: "required",
        	  lat:"required",
        	  lng:"required",
        	  alamat:"required",
        	  nama_perusahaan:"required",
        	  kode_pengecer:{
        		  required:true,
        		  maxlength:20,
              minlength:10
        	  },
        	  nama_pengecer:{
        		number:false,
        		required:true
        	  },
        	  alamat:{
        		  required:true,
        		  number:false,
              minlength:5
        	  },
        	  lat:{
        		  required:true,
        		  maxlength:12,
        	  },
        	  lng:{
        		  required:true,
        		  maxlength:12,
        	  },
              nama_pengecer: {
                required: true,
                minlength: 5,
              },
        	  nama_perusahaan:{
        		  required:true,
        		  minlength:5,
        	  }
          },
          // Specify validation error messages
          messages: {
            kode_pengecer: "Masukkan Angka dan minimal 10",
        	  nama_pengecer: "Minimal 5 Huruf ",
        	  lat: "Bertipe angka dan maksimum 12 angka",
        	  lng: "Beritpe angka dan maksimum 12 angka",
        	  nama_perusahaan: "Minimal 5 Huruf",
        	  alamat:"Minimal 5 "
          },
      	  highlight: function (element) {
                  $(element).closest('.form-group').addClass('has-error')
          },unhighlight: function(element) {
                  $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
          },
          submitHandler: function(form) {
            var lat = document.getElementById('lat').value;
            var lng = document.getElementById('lng').value;

            if(lat >= -90 && lat <= 90) {

            } else {
              alert("Error Must Be -90 to 90");
            }

            if(lng >= -180 && lng <= 180) {

            } else {
              console.log(lng);
              alert("Error Must Be -180 to 180");
            }
            form.submit();
          }
        });
      });
  
      //Validasi Data Karyawan
      $(function() {
        $("#tambahKaryawan").validate({
          rules: {
            username:{
              required:true,
              maxlength:10,
              minlength:4,
            },
            password:{
            required:true,
            minlength:6,
            },
            nama:{
              required:true,
              number:false,
              minlength:4,
              maxlength:25,
            },
            email:{
              required:true,
            },
            status:{
              required:true,
            },
            foto:{
              required:true,
              extension: "jpg|jpeg|png",
            },
          },
          // Specify validation error messages
          messages: {
            username: "Minimal 4 Huruf dan Maximal 10 Huruf",
            password: "Minimal 6 Huruf",
            nama:"Minimal 4 Huruf",
            email:"gunakan @ untuk email",
            status:"required",
            foto:"File must be JPEG or PNG, less than 1MB",
          },
          highlight: function (element) {
                  $(element).closest('.form-group').addClass('has-error');
          },unhighlight: function(element) {
                  $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
          },
          submitHandler: function(form) {
            form.submit();
          }
        });
      });

    $(function(){
    var d = new Date();
    var month = new Array();
    var dataActive = jQuery.parseJSON(<?php echo $pengecer->retailerActive() ?>);
    var dataNonActive = jQuery.parseJSON(<?php echo $pengecer->retailerNonActive() ?>);
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      {
        value: dataActive,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "Retailer Aktif"
      },
      {
        value: dataNonActive,
        color: "#f56954",   
        highlight: "#f56954",
        label: "Retailer NonAktif"
      }
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
  });
    
</script>
</body>
</html>
