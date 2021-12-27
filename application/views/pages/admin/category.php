<?php 
	
	if(!$this->session->has_userdata('id')){
		redirect('admin/login');
	}

    $menuData = $this->query->fetchAll('service_category');

?>
<style>
    div.cat-form{
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
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
                <div class="col-md-3">
                    <h5>Add a new category</h5>
                    <form id="serviceForm">
                        <div class="cat-form">
                            <div class="form-group">
                                <label>Category Name:</label>
                                <input class="form-control" name="name" placeholder="Enter category name" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S. No.</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; foreach($menuData as $menu){ $i++; ?>
                                    <tr id="menu_<?php echo $menu->id; ?>">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $menu->name; ?></td>
                                        <td>
                                            <a id="<?php echo $menu->id; ?>" class="btn btn-danger btn-sm btn-del">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var table = $('#datatable').dataTable();
    var count = <?php echo $i; ?>;

    $("#serviceForm").submit(function(event) {
	    event.preventDefault();
	}).validate({
	    rules: {
	     name: "required"
	    },
	    submitHandler: function(form) { 
	    	
	        $.ajax({
	        	url:'<?php echo base_url(); ?>add/servicecategory',
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

    $("#datatable").on("click", ".btn-del", function(){
        var id = $(this).attr('id');
        if (confirm("Do you really want to delete this category ?") == true) {
            var obj = {id:id};
            $.ajax({
                url:'<?php echo base_url(); ?>delete/servicecategory',
                type: 'POST',
                data: obj,
                dataType:'json',
                success:function(as){
                    if(as.status == true){
                        alert(as.message);
                        $('#datatable').DataTable().row("#menu_"+id).remove().draw();
                    }
                    else{
                        alert(as.message);
                    }
                }
            });
        } else {
            
        }
    });
</script>