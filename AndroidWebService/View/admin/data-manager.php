<?php include 'core/header.php'; ?>


<div class="content-wrapper">
	<div class="row">
		<script src="../assets/plugins/elfinder/js/elfinder.min.js"></script>
		<script type="text/javascript" charset="utf-8">
				$().ready(function() {
					var elf = $('#elfinder').elfinder({
						// lang: 'ru',             // language (OPTIONAL)
						url : '../assets/plugins/elfinder/php/connector.minimal.php'  // connector URL (REQUIRED)
					}).elfinder('instance');         
				});
		 </script>
		 <div class="col-md-12">
			<div id="elfinder"></div>
		 </div>
	</div>
</div>
<?php include 'core/footer.php'; ?>