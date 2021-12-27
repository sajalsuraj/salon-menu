<?php 
	
	if($this->session->has_userdata('id') == true){
		redirect('admin/home');
	}

?>
<style>
    .lockscreen-name {
        font-weight: 600;
        text-align: center;
    }
</style>
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        Curls & Waves Salon
    </div>
    <!-- User name -->
    <div class="lockscreen-name">Kumar Gautam</div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="<?php echo base_url(); ?>assets/images/profile.jpg" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form id="loginForm" class="lockscreen-credentials">
            <div class="input-group">
                <input type="hidden" name="username" value="admin" />
                <input type="password" name="password" class="form-control" placeholder="password">

                <div class="input-group-append">
                    <button type="submit" class="btn">
                        <i class="fas fa-arrow-right text-muted"></i>
                    </button>
                </div>
            </div>
        </form>
        <!-- /.lockscreen credentials -->
    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        Enter your password to retrieve your session
    </div>
</div>
<script>
    $("#loginForm").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     password: "required"
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>get/login',
	        	type: 'POST',
                data: $('form').serialize(),
                dataType:'json',
                success:function(as){
                	if(as.status == true){
                		location.href="home";
                	}
                	else if(as.status == false){
                		alert("Wrong Email or Password");
                	}
                }
	        });
	    }
	});
</script>