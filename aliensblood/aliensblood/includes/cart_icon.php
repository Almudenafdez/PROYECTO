<?php
session_start();
$total_items = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<a href="/cart/view.php" class="cart-icon">
  🛒 <span id="cart-count"><?= $total_items ?></span>
</a>
