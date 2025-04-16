<!-- navbar.php -->
<nav style="display: flex; align-items: center; justify-content: space-between; background: #fff; padding: 1rem 2rem; border-bottom: 2px solid #4a3c3c;">
  <div style="font-weight: bold; font-size: 1.5rem;">
    <span style="color: #f4cd45;">V&amp;P</span>
    <span style="color: #f44336;">Furni</span>
    <span style="color: #009688;">ture</span>
  </div>
  <ul style="list-style: none; display: flex; gap: 2rem; margin: 0; padding: 0;">
    <li><a href="index.php" style="text-decoration: none; color: #333;">Home</a></li>
    <li><a href="about.php" style="text-decoration: none; color: #333;">About</a></li>
    <li style="position: relative;">
      <a href="#" style="text-decoration: none; color: #333;">Shop ▾</a>
      <ul style="position: absolute; top: 100%; left: 0; background: #fff; list-style: none; padding: 0.5rem 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1); display: none;">
        <li><a href="shop-listing.php?category=all" style="text-decoration: none; color: #333; display: block; padding: 0.5rem 1rem;">All Products</a></li>
        <li><a href="shop-listing.php?category=table" style="text-decoration: none; color: #333; display: block; padding: 0.5rem 1rem;">Table</a></li>
        <li><a href="shop-listing.php?category=chair" style="text-decoration: none; color: #333; display: block; padding: 0.5rem 1rem;">Chair</a></li>
        <li><a href="shop-listing.php?category=bed" style="text-decoration: none; color: #333; display: block; padding: 0.5rem 1rem;">Bed</a></li>
      </ul>
    </li>
    <li><a href="contact.php" style="text-decoration: none; color: #333;">Contact Us</a></li>
    <li><a href="faqs.php" style="text-decoration: none; color: #333;">FAQs</a></li>
    <li><a href="account.php" style="text-decoration: none; color: #333;">My Account</a></li>
  </ul>
</nav>

<script>
  // Dropdown functionality
  document.querySelector('nav li:hover ul')?.style.setProperty('display', 'block');
</script>
