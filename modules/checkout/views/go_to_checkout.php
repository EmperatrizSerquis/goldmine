<p class="price">$<?= $item_obj->item_price ?></p>

<form class="form-vertical">
    <?php
    if (count($item_colors)>0) {
    ?>
        <label>Color</label>
        <select id="item-color">
            <option value="">Select Color...</option>
            <?php
            foreach ($item_colors as $color_option) {
                echo '<option value="'.$color_option->item_color.'">'.$color_option->item_color.'</option>';
            }
            ?>
        </select>
    <?php
    }
    ?>

    <?php
    if (count($item_sizes)>0) {
    ?>
        <label>Size</label>
        <select id="item-size">
            <option value="">Select Size...</option>
            <?php
            foreach ($item_sizes as $size_option) {
                echo '<option value="'.$size_option->item_size.'">'.$size_option->item_size.'</option>';
            }
            ?>
        </select>
    <?php
    }
    ?>

    <label>Quantity</label>
    <select id="qty">
        <option value="0">Select Quantity...</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>


    <button onclick="addToBasket()" type="button" class="btn btn-gold btn-modal">Add To Basket</button>

    <div class="modal" id="modal">
        <div class="modal-content">
            <a href="#modals" class="modal-close">×</a>
            <h2 class="modal-headline">Your Basket</h2>
            <p id="basket-modal-msg"></p>

            <table class="table" id="user-basket-tbl"></table>

            <p style="text-align: right;">
                <button type="button" class="btn btn-secondary dismiss">Continue Shopping</button>
                <a href="<?= BASE_URL ?>checkout/go_to_checkout"><button type="button" id="checkout-btn" class="btn btn-success">Go To Checkout</button></a>
            </p>

        </div>
    </div>


<style>

.remove-item {
display: flex;
color: cornflowerblue;
cursor: pointer;
}

.thumb {
width: 120px;
}

.modal-basket-row td {
border: 1px #ccc solid;
}

.modal-basket-row td:nth-child(odd) {
text-align: center;
}

.modal-basket-row p {
margin: 0;
padding: 0;
line-height: 1.4em;
}

.modal-basket-row p:nth-child(4) {
margin-top: 1.6em;
}
</style>


    <p class="add-to-cart-info">This item is eligible for free delivery in Europe and the USA but never in Ireland.</p>
    <!-- PayPal Logo -->
    <table border="0" cellpadding="10" cellspacing="0" align="center">
        <tr>
            <td align="center"></td>
        </tr>
        <tr>
            <td align="center"><a href="https://www.paypal.com/uk/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/uk/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_SbyPP_mc_vs_ms_ae_UK.png" border="0" alt="PayPal Acceptance Mark"></a></td>
        </tr>
    </table>
    <input type="hidden" id="item-id" value="<?= $item_obj->id ?>">
</form>


<script>

    var validationErrors = [];

    function addToBasket() {

        if (localStorage.userBasket === undefined) {
            var userBasket = [];
        } else {
            var userBasket = JSON.parse(localStorage.getItem('userBasket'));
        }

        var itemId = document.getElementById('item-id').value;
        var qty = document.getElementById('qty').value;

        if (qty == 0) {
            validationErrors.push("You did not select a quantity.\n");
        }

        var itemTitle = document.getElementsByTagName('h1')[0].innerHTML;
        var itemPrice = document.getElementsByClassName('price')[0].innerText;
        var itemPic = document.getElementById('item-pic').src;
        var itemThumbnail = itemPic.replace('store_items_pics', 'store_items_pics_thumbnails');

        var basketRow = {
            itemId,
            qty,
            itemTitle,
            itemPrice,
            itemPic,
            itemThumbnail
        }

        if (document.getElementById('item-color')) {
            var itemColor = document.getElementById('item-color').value;

            if (itemColor == '') {
                validationErrors.push('You did not select an item color.\n');
            }

            basketRow.itemColor = itemColor;
        }

        if (document.getElementById('item-size')) {
            var itemSize = document.getElementById('item-size').value;

            if (itemSize == '') {
                validationErrors.push('You did not select an item size.\n');
            }

            basketRow.itemSize = itemSize;
        }

        userBasket.push(basketRow);

        localStorage.setItem('userBasket', JSON.stringify(userBasket));

    }

    function populateUserBasketTbl() {

        //check to see if we have localStorage with a userBasket
        if (localStorage.userBasket === undefined) {
            var basketModalMsg = 'You currently have no items in your basket.';
            document.getElementById('basket-modal-msg').innerHTML = basketModalMsg;
            document.getElementById('checkout-btn').style.display = 'none';
            document.getElementById("user-basket-tbl").innerHTML = '';

        } else {

            var userBasket = JSON.parse(localStorage.getItem('userBasket'));
            var userBasketTblContents = '';

            for (var i = 0; i < userBasket.length; i++) {

                var price = userBasket[i]['itemPrice'];
                price = price.replace('$', '');
                var rowPrice = price*userBasket[i]['qty'];

                userBasketTblContents+= '<tr class="modal-basket-row">';
                userBasketTblContents+= '<td class="thumb"><img src="' + userBasket[i]['itemThumbnail'] + '"></td>';
                userBasketTblContents+= '<td>';
                userBasketTblContents+= '<p>' + userBasket[i]['itemTitle'] + '</p>';
                userBasketTblContents+= '<p>Item Price: ' + userBasket[i]['itemPrice'] + '</p>';
                userBasketTblContents+= '<p>Qty: ' + userBasket[i]['qty'] + '</p>';
                userBasketTblContents+= '<p class="remove-item" onmouseup="removeItem(' + i + ')">Remove <i class="material-icons">delete</i></p>';
                userBasketTblContents+= '</td>';
                userBasketTblContents+= '<td class="price">$' + rowPrice + '</td>';
                userBasketTblContents+= '</tr>';

            }

            document.getElementById("user-basket-tbl").innerHTML = userBasketTblContents;
            document.getElementById('basket-modal-msg').innerHTML = '';
            document.getElementById('checkout-btn').style.display = 'inline-block';

        }

        updateBasketSummary();

    }

    function updateBasketSummary() {

        if (localStorage.userBasket === undefined) {
            var basketSummaryMsg = 'Your Shopping Basket Is Empty';
        } else {
            //get the number of items in the basket
            var numItemsInBasket = 0;

            var userBasket = JSON.parse(localStorage.getItem('userBasket'));
            for (var i = 0; i < userBasket.length; i++) {
                numItemsInBasket = numItemsInBasket + parseInt(userBasket[i]['qty']);
            }

            if (numItemsInBasket == 1) {
                var basketSummaryMsg = 'You have one item in your basket';
            } else {
                var basketSummaryMsg = 'You have ' + numItemsInBasket + ' items in your basket';
            }

        }

        document.getElementById('basket-summary').innerHTML = basketSummaryMsg;

    }

    function removeItem(i) {

        var userBasket = JSON.parse(localStorage.getItem('userBasket'));

        // how to remove an item from an array in javascripts
        userBasket.splice(i, 1);

        if (userBasket.length == 0) {
            localStorage.removeItem('userBasket');
        } else {
            //we still have item(s) in the basket, after the remove
            var userBasketNew = JSON.stringify(userBasket);
            localStorage.setItem('userBasket', userBasketNew);
        }

        populateUserBasketTbl();

    }

    updateBasketSummary();

</script>









<script>
"use strict";
(function(global) {

// Modal
var modal = document.querySelector(".modal");
var modalContent = document.querySelector(".modal-content");
var btnModal = document.querySelectorAll(".btn-modal");
var dismissBtn = document.querySelector(".dismiss");
var closeModal = document.querySelector(".modal-close");

btnModal.forEach((btn) => {
btn.addEventListener("click", () => {

//display the modal
if (validationErrors.length == 0) {

if(modalContent.classList.contains("slide-down")) {
    modalContent.classList.remove("slide-down");
}
modal.style.display = "block";
modalContent.style.display = "block";
populateUserBasketTbl();

} else {
//validation error(s)!
var errorMsg = '';

for (var i = 0; i < validationErrors.length; i++) {
    errorMsg+= validationErrors[i];
}

//reset the validationErrors
validationErrors = [];
alert(errorMsg);
}

});
});

if(dismissBtn) {
dismissBtn.addEventListener("click", () => {
modalContent.classList.add("slide-down");
setTimeout(() => {
modal.style.display = "none";
}, 1000);
});
}

if(closeModal) {
closeModal.addEventListener("click", () => {
modalContent.classList.add("slide-down");
setTimeout(() => {
modal.style.display = "none";
}, 1000);
});
}

if(modal) {
modal.addEventListener("click", (e) => {

if(!modalContent.contains(e.target)) {
modalContent.classList.add("slide-down");
setTimeout(() => {
    modal.style.display = "none";
}, 1000);
}

});
}

})(window);
</script>
