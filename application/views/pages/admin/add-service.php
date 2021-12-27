<?php 
	
	if(!$this->session->has_userdata('id')){
		redirect('admin/login');
	}

    $categoryData = $this->query->fetchAll('service_category');

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add a service</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add a service</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">New Service</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="serviceForm">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Service Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter service name">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" class="form-control" placeholder="Enter price">
                                </div>

                                <div class="form-group">
                                    <label for="category">Select category</label>
                                    <select name="category" class="form-control">
                                        <option disabled selected>Select a category</option>
                                        <option value="men">Men</option>
                                        <option value="women">Women</option>
                                        <option value="both">Both Men & Women</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="service_category">Select service category</label>
                                    <select name="service_category" class="form-control">
                                        <option disabled selected>Select a service category</option>
                                        <?php foreach($categoryData as $cat){ ?>
                                        <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#serviceForm").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     name: "required",
         price: "required",
         category: "required",
         service_category: "required"
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>add/menuitem',
	        	type: 'POST',
                data: $('form').serialize(),
                dataType:'json',
                success:function(as){
                	if(as.status == true){
                        alert(as.message);
                		location.reload();
                	}
                	else if(as.status == false){
                		alert(as.message);
                	}
                }
	        });
	    }
	});
</script>