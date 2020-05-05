<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Designer Jewellery</a></li>
    <li><a href="#">Watches</a></li>
    <li>Citizen Eco-Drive AT9013-03H</li>
</ul>

<section class="item">
    <div>
        <?= $item_pic_html ?>
    </div>
    <div>
        <h1><?= $item_obj->item_title ?> </h1>
        <p><b>Item Code:</b>  <?= $item_obj->item_code ?></p>
        <p> <?= $in_stock_html ?></p>
        <p class="price"><span class="smaller">$</span>888.00</p>
        <?= nl2br($item_obj->description) ?>
    </div>
    <div class="add-to-cart">
      <?= Modules::run('add_to_cart/_draw_add_to_cart', $data) ?>
    </div>
</section>

<h2 class="center-sub-head">You May Also Like</h2>
<hr class="hr-4">

<section class="items other-items">
    <div class="card">
        <img src="images/sample_item_pics/offers/item1.jpg">
        <div class="card-body">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
            <a href="#" class="btn btn-secondary">View Item</a>
        </div>
    </div>
    <div class="card">
        <img src="images/sample_item_pics/offers/item2.jpg">
        <div class="card-body">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
            <a href="#" class="btn btn-secondary">View Item</a>
        </div>
    </div>
    <div class="card">
        <img src="images/sample_item_pics/offers/item3.jpg">
        <div class="card-body">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
            <a href="#" class="btn btn-secondary">View Item</a>
        </div>
    </div>
    <div class="card">
        <img src="images/sample_item_pics/offers/item4.jpg">
        <div class="card-body">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
            <a href="#" class="btn btn-secondary">View Item</a>
        </div>
    </div>
    <div class="card">
        <img src="images/sample_item_pics/offers/item5.jpg">
        <div class="card-body">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
            <a href="#" class="btn btn-secondary">View Item</a>
        </div>
    </div>
</section>
