<!DOCTYPE html>

<html lang="en">
<head>

  <style>
    .custom-navbar {
background-color: #246575 !important;
}


.custom-navbar .nav-link,
.custom-navbar .navbar-brand,
.custom-navbar .navbar-toggler-icon {
color: white !important;
}

.custom-navbar .nav-link:hover {
color: #ecba81 !important; /* soft orange on hover, optional */
}

/* Optional: Style the toggler button icon */
.custom-navbar .navbar-toggler {
border-color: white !important;
}
.custom-navbar .navbar-toggler-icon {
background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
}

</style>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="Tooplate" name="author"/>
<title>Moso Interior - Product Listing Page</title>
<!-- CSS FILES -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<link href="css/bootstrap-icons.css" rel="stylesheet"/>

        <link href="css/owl.carousel.min.css" rel="stylesheet"/>
<link href="css/tooplate-moso-interior.css" rel="stylesheet"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!--

Tooplate 2133 Moso Interior

https://www.tooplate.com/view/2133-moso-interior

Bootstrap 5 HTML CSS Template

-->
</head>
<body class="shop-listing-page">
  
  <nav class="navbar navbar-expand-lg fixed-top shadow-lg custom-navbar">

    <div class="container">
        <p style=" color: white; font-family: 'Times New Roman', Times, serif;"><a class="navbar-brand" href="index.php">V&P Furniture </p></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php#section_2">About</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle click-scroll" href="#section_3" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>

                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                        <li><p style="color: black;"><a class="dropdown-item" href="shop-listing.php">Shop Listing</p></a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php#section_4">Contact Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="faqs.php">FAQs</a>
                </li>

                <li class="nav-item text-center">
                    <a class="nav-link click-scroll" href="myacc.php" style="color: black;">
                        <i class="fas fa-user"></i>

                    </a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>

         



    <section class="contact-section" id="section_5">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f9f9" fill-opacity="1" d="M0,96L40,117.3C80,139,160,181,240,186.7C320,192,400,160,480,149.3C560,139,640,149,720,176C800,203,880,245,960,250.7C1040,256,1120,224,1200,229.3C1280,235,1360,277,1400,298.7L1440,320L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path></svg>
        <div class="container">
            <div class="row">

<main>
  
<header class="site-header d-flex justify-content-center align-items-center">
<div class="container">
<div class="row">
<div class="col-lg-12 col-12">
<h1 class="text-white">Shop Listing</h1>
</div>
</div>
</div>
</header>
<style>
.bg-wrapper {
  background-color: #f6f6f6;
  border-radius: 30px;
}

.category-box {
  background-color: #a67c52;
}

.product-card {
  background-color: #f1f1f1;
  border-radius: 20px;
  transition: transform 0.2s;
}

.product-card:hover {
  transform: translateY(-5px);
}

.wishlist-icon {
  position: absolute;
  top: 10px;
  right: 10px;
  color: #a67c52;
  font-size: 1.2rem;
}

.overlay-icon {
  position: absolute;
  bottom: 10px;
  left: 10px;
  font-size: 1.2rem;
  color: #333;
}

@media (max-width: 767px) {
  .category-box {
    margin-bottom: 2rem;
  }
}


              </style>




<section class="shop-canva-style py-5">
<div class="container-fluid">
<div class="rounded-5 bg-wrapper p-5">
<div class="row">
<!-- Sidebar -->
<div class="col-md-3 mb-4">
<div class="category-box p-4 rounded-4 text-white">
<label class="form-label text-white" for="categorySelect">Product Category</label>
<select class="form-select" id="categorySelect">
  <option disabled selected>Select Category</option>
  <option value="Chair">Chair</option>
  <option value="Table">Table</option>
  <option value="Bed">Bed</option>
  <option value="All">Show All</option>
</select>

</div>
</div>
<!-- Product Grid -->
<div class="col-md-9">
<div class="row g-4">
<!-- Product 1 -->
<div class="col-md-4 col-sm-6">
  <a href="product.php?id=1" class="text-decoration-none text-dark">
    <div class="product-card rounded-4 p-3 position-relative text-center" data-category="Chair">
      <img src="images/woven.jpg" alt="Woven Chair" class="img-fluid mb-3" />
      <h6 class="mb-1">Woven Chair</h6>
      <p class="text-muted">₱29,000</p>
      <a href="addwishlist.php?product_id=1" class="wishlist-icon" title="Add to Wishlist">
        <i class="bi bi-heart-fill"></i>
      </a>
    </div>
  </a>
</div>

<!-- Product 2 -->
<div class="col-md-4 col-sm-6">
  <a href="product.php?id=2" class="text-decoration-none text-dark">
    <div class="product-card rounded-4 p-3 position-relative text-center" data-category="Table">
      <img src="images/round.jpg" alt="Round Table" class="img-fluid mb-3" />
      <h6 class="mb-1">Round Table</h6>
      <p class="text-muted">₱61,000</p>
      <a href="addwishlist.php?product_id=2" class="wishlist-icon" title="Add to Wishlist">
        <i class="bi bi-heart-fill"></i>
      </a>
    </div>
  </a>
</div>


<!-- Product 3 -->
<div class="col-md-4 col-sm-6">
  <a href="product.php?id=3" class="text-decoration-none text-dark">
    <div class="product-card rounded-4 p-3 position-relative text-center" data-category="Chair">
      <img src="images/wooden.jpg" alt="Wooden Stool" class="img-fluid mb-3" />
      <h6 class="mb-1">Wooden Stool</h6>
      <p class="text-muted">₱26,000</p>
      <a href="addwishlist.php?product_id=3" class="wishlist-icon" title="Add to Wishlist">
        <i class="bi bi-heart-fill"></i>
      </a>
    </div>
  </a>
</div>


<!-- Product 4 -->
<div class="col-md-4 col-sm-6">
  <a href="product.php?id=4" class="text-decoration-none text-dark">
    <div class="product-card rounded-4 p-3 position-relative text-center" data-category="Chair">
      <img src="images/arm.jpg" alt="Armchair" class="img-fluid mb-3" />
      <h6 class="mb-1">Armchair</h6>
      <p class="text-muted">₱32,000</p>
      <a href="addwishlist.php?product_id=4" class="wishlist-icon" title="Add to Wishlist">
        <i class="bi bi-heart-fill"></i>
      </a>
      
    </div>
  </a>
</div>

<!-- Product 5 -->
<div class="col-md-4 col-sm-6">
  <a href="product.php?id=5" class="text-decoration-none text-dark">
    <div class="product-card rounded-4 p-3 position-relative text-center" data-category="Bed" >
      <img src="images/king.jpeg" alt="King Bed Frame" class="img-fluid mb-3" />
      <h6 class="mb-1">King Bed Frame</h6>
      <p class="text-muted">₱54,000</p>
      <a href="addwishlist.php?product_id=5" class="wishlist-icon" title="Add to Wishlist">
        <i class="bi bi-heart-fill"></i>
      </a>
      
      
    </div>
  </a>
</div>

<!-- Product 6 -->
<div class="col-md-4 col-sm-6">
  <a href="product.php?id=6" class="text-decoration-none text-dark">
    <div class="product-card rounded-4 p-3 position-relative text-center" data-category="Table">
      <img src="images/side.jpg" alt="Side Table" class="img-fluid mb-3" />
      <h6 class="mb-1">Side Table</h6>
      <p class="text-muted">₱28,000</p>
      <a href="addwishlist.php?product_id=6" class="wishlist-icon" title="Add to Wishlist">
        <i class="bi bi-heart-fill"></i>
      </a>
      
      
    </div>
  </a>
</div>


</footer>
<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/click-scroll.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/custom.js"></script>
<script>
  document.getElementById('categorySelect').addEventListener('change', function () {
    const selectedCategory = this.value;
    const productCards = document.querySelectorAll('.product-card');

    productCards.forEach(card => {
      const productCategory = card.getAttribute('data-category');

      if (selectedCategory === 'All' || selectedCategory === productCategory) {
        card.parentElement.style.display = 'block'; // Show the column (e.g., col-md-4)
      } else {
        card.parentElement.style.display = 'none'; // Hide it
      }
    });
  });
</script>

</body>
</html>
