<section class="your-basket">
  <h3>Your Basket</h3>
  <table class="table basket">
    <?php
    foreach ($rows as $ow) {
     ?>
     <tr>
       <td>PIC</td>
       <td>details</td>
       <td>Price</td>
     </tr>

     <?php } ?>
  </table>
</section>

<style media="screen">
  .your-basket {
    padding: 1em;
  }
  .basket {
    width: 70%;
    margin: 0 auto;
  }
</style>
