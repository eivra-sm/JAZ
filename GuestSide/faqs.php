<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        .custom-navbar {
  background-color: #246575 !important;
}

    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="Tooplate">

    <title>V&P Furniture</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/owl.carousel.min.css" rel="stylesheet">

    <link href="css/tooplate-moso-interior.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
<!--

Tooplate 2133 Moso Interior

https://www.tooplate.com/view/2133-moso-interior

Bootstrap 5 HTML CSS Template

-->

</head>
<body>

    

        <nav class="navbar navbar-expand-lg fixed-top shadow-lg custom-navbar">

            <div class="container">
                <a class="navbar-brand" href="index.php" style="color: white; font-family: 'Times New Roman', Times, serif;">
                    V&P Furniture
                  </a>
                  

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <p style="color: white;"><a class="nav-link click-scroll" href="index.php#section_1">Home</p></a>
                        </li>

                        <li class="nav-item">
                            <p style="color: white;"><a class="nav-link click-scroll" href="index.php#section_2">About</p></a>
                        </li>

                        <li class="nav-item dropdown">
                            <p style="color: white;"><a class="nav-link dropdown-toggle click-scroll" href="index.php#section_3" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</p></a>

                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                               <li><a class="dropdown-item" href="shop-listing.php">Shop Listing</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <p style="color: white;"><a class="nav-link click-scroll" href="index.php#section_4">Contact Us</p></a>
                        </li>

                        <li class="nav-item">
                            <p style="color: white;"><a class="nav-link click-scroll" href="faqs.php">FAQs</p></a>
                        </li>

                        <li class="nav-item text-center">
                            <a class="nav-link click-scroll" href="logout.php" style="color: black;">
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

                <style>
                    .faq-section {
                      margin: 60px auto 100px;
                      max-width: 800px;
                      background: rgba(255, 255, 255, 0.2);
                      padding: 40px;
                      border-radius: 20px;
                      backdrop-filter: blur(10px);
                      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                    }
                  
                    .faq-section h2 {
                      font-size: 28px;
                      font-weight: bold;
                      margin-bottom: 30px;
                      text-align: center;
                    }
                  
                    .faq-item {
                      margin-bottom: 15px;
                      border-radius: 10px;
                      overflow: hidden;
                    }
                  
                    .faq-question {
                      background-color: #d4a373;
                      padding: 15px 20px;
                      font-weight: bold;
                      color: #fff;
                      cursor: pointer;
                      display: flex;
                      justify-content: space-between;
                      align-items: center;
                    }
                  
                    .faq-answer {
                      display: none;
                      background-color: #f5f5f5;
                      padding: 20px;
                      font-size: 15px;
                      line-height: 1.6;
                    }
                  
                    .faq-item.active .faq-answer {
                      display: block;
                    }
                  
                    .faq-toggle::after {
                      content: '>';
                      font-size: 18px;
                    }
                  </style>
                  
                  <div class="faq-section">
                    <h2>Frequently Ask Questions</h2>
                  
                    <div class="faq-item">
                      <div class="faq-question">
                        Shipping Method
                        <span class="faq-toggle"></span>
                      </div>
                      <div class="faq-answer">
                      Standard Shipping
                      </div>
                    </div>
                  
                    <div class="faq-item">
                      <div class="faq-question">
                        Payment Method
                        <span class="faq-toggle"></span>
                      </div>
                      <div class="faq-answer">
                        We accept Cash on Delivery and GCash for your convenience.
                      </div>
                    </div>
                  
                    <div class="faq-item">
                      <div class="faq-question">
                        Customization
                        <span class="faq-toggle"></span>
                      </div>
                      <div class="faq-answer">
                        Yes! You can customize furniture sizes and colors. Message us with your requirements.
                      </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                          How long will it take to be delivered?
                          <span class="faq-toggle"></span>
                        </div>
                        <div class="faq-answer">
                            It normally takes six to eight weeks if we know it will be difficult, but two to three weeks or fewer if it is simple, has already been done, and has a sketch.
                        </div>
                      </div>
                    
                  </div>
                  

</div>
</div>
            </section>


                 
            <script>
                const faqItems = document.querySelectorAll(".faq-item");
              
                faqItems.forEach(item => {
                  item.querySelector(".faq-question").addEventListener("click", () => {
                    item.classList.toggle("active");
                  });
                });
              </script>
</body>
</html>