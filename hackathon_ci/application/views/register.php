<?php $this->load->view('templates/head');?>

<body>
<?php $this->load->view('templates/header');?>

	<div class="container">
		<div class="row col-lg-6">
			<form class="form-horizontal" action="" method="post">
				<h2>Create an Account</h2>
				<div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Email Address</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="inputEmail" placeholder="Email Address" value="">
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputPassword" class="col-lg-2 control-label">Password</label>
					<div class="col-lg-10">
						<input type="password" class="form-control" id="inputPassword" placeholder="Password" value="">
					</div>
				</div>
				
				<button type="button" class="btn btn-success" id="submitBtn">Create an Account</button>
				
			</form>
		</div>
    </div><!-- /.container -->
	
<?php $this->load->view('templates/footer');?>
<script src="<?php echo base_url(); ?>assets/js/sha256.js"></script>
<script>
	
	$("#submitBtn").click(function() {
		register();
	});
	
	function register() {
	
		var email = $("#inputEmail").val();
		var password = $("#inputPassword").val();
		
		if (email.length == 0) {
			$.jGrowl("Please enter email address", { header: "Missing Field" });
			return;
		}
		if (password.length == 0) {
			$.jGrowl("Please enter password", { header: "Missing Field" });
			return;
		}
		
		var phash = CryptoJS.SHA256(password);
		
		$.ajax({
		  type: "POST",
		  url: "<?php echo base_url('register/post'); ?>",
		  data: {email: email, password: phash.toString()},
		  success: function(data) {
		  },
		  complete: function(e, xhr, settings) {
			var data = ($.parseJSON(e.responseText));
			if (e.status == 200) {
				window.location.href = data.message;
			} else if (e.status == 400) {
				$.jGrowl(data.message, { header: data.error });
			}
		  },
		  dataType: 'json'
		});
	}
</script>

</body>
</html>