<style>
    .tab-content h4{
        float: left;
        font-size: 12px;
        font-weight: 600;
    }

    .tab-content span{
        float: right;
    }

    .item-menu{
        margin-bottom: 15px;
    }
    h3.cat-name{
        text-align: left;
        padding-left: 10px;
        margin-bottom: 20px;
        color:#000;
    }
    .nav-tabs {
        display: flex;
        justify-content: center;
    }
</style>
<div class="container" style="margin-bottom: 25px;">
    <!--Row-->
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1 class="title"> Menu</h1>
            <p class="beige">Variety of styles</p>
        </div>
    </div>
    <!--End row-->
</div>
<?php
$categories = $this->query->fetchAll('service_category');
$finalMenu = [];
$menMenu = [];
$womenMenu = [];
foreach ($categories as $category) {
    $menuObj = (object) [];
    $menMenuObj = (object) [];
    $womenMenuObj = (object) [];

    $menuCategories = $this->query->fetchMenuByServiceId($category->id);
    $menuObj->category_name = $category->name;
    $menuObj->menuData = $menuCategories;
    $finalMenu[] = $menuObj;

    $menuCategories = $this->query->fetchMenuByServiceIdAndType($category->id, 'men');
    $menMenuObj->category_name = $category->name;
    $menMenuObj->menuData = $menuCategories;
    $menMenu[] = $menMenuObj;

    $menuCategories = $this->query->fetchMenuByServiceIdAndType($category->id, 'women');
    $womenMenuObj->category_name = $category->name;
    $womenMenuObj->menuData = $menuCategories;
    $womenMenu[] = $womenMenuObj;
}

?>
<div class="menu">
    <div class="container">
        <!--Row-->
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Men</a></li>
                <li><a data-toggle="tab" href="#menu1">Women</a></li>
                <li><a data-toggle="tab" href="#menu2">All</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <?php foreach($menMenu as $men){ ?>
                        <div class="col-md-12">
                            <?php if(count($men->menuData) > 0){ ?><h3 class="cat-name"><?php echo $men->category_name; ?></h3><?php } ?>
                            <?php 
                                foreach($men->menuData as $service){?>
                                    <div class="col-md-6 col-xs-12 item-menu">
                                        <h4><?php echo $service->name; ?></h4>
                                        <span>₹ <?php echo $service->price; ?></span>
                                    </div>
                                <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <?php foreach($womenMenu as $women){ ?>
                        <div class="col-md-12">
                            <?php if(count($women->menuData) > 0){ ?><h3 class="cat-name"><?php echo $women->category_name; ?></h3><?php } ?>
                            <?php 
                                foreach($women->menuData as $service){?>
                                    <div class="col-md-6 col-xs-12 item-menu">
                                        <h4><?php echo $service->name; ?></h4>
                                        <span>₹ <?php echo $service->price; ?></span>
                                    </div>
                                <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <?php foreach($finalMenu as $menu){ ?>
                        <div class="col-md-12">
                            <?php if(count($menu->menuData) > 0){ ?><h3 class="cat-name"><?php echo $menu->category_name; ?></h3><?php } ?>
                            <?php 
                                foreach($menu->menuData as $service){?>
                                    <div class="col-md-6 col-xs-12 item-menu">
                                        <h4><?php echo $service->name; ?></h4>
                                        <span>₹ <?php echo $service->price; ?></span>
                                    </div>
                                <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>