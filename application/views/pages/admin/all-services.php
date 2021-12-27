<?php 
	
	if(!$this->session->has_userdata('id')){
		redirect('admin/login');
	}

    $menuData = $this->query->fetchAll('menu');

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View all services</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View all services</li>
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
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Service Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; foreach($menuData as $menu){ $i++; ?>
                                    <tr id="menu_<?php echo $menu->id; ?>">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $menu->name; ?></td>
                                        <td>&#8377; <?php echo $menu->price; ?></td>
                                        <td><?php if($menu->category === "men"){ echo "Men"; }else if($menu->category === "women"){echo "Women";}else if($menu->category === "both"){echo "Both Men & Women";} ?></td>
                                        <td><?php if($this->query->fetchServiceCategoryById($menu->service_category) != NULL){ echo $this->query->fetchServiceCategoryById($menu->service_category)->name; }else{echo "N/A";} ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>admin/edit-service/<?php echo $menu->id; ?>">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>

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
    $("#datatable").DataTable();

    $("#datatable").on("click", ".btn-del", function(){
        var id = $(this).attr('id');
        if (confirm("Do you really want to delete this service ?") == true) {
            var obj = {id:id};
            $.ajax({
                url:'<?php echo base_url(); ?>delete/menuitem',
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