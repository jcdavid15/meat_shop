<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/general.css">
    <link rel="stylesheet" href="./styles/navbar.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./styles/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Home</title>
</head>
<body>
    <nav>
      <div class="left">
        <a href="./index.php"><div class="img-con">
            <img src="./assets/imgs/logo.png" alt="">
        </div></a>
        <a href=""><div>Home</div></a>
        <a href="./components/aboutUs.php"><div>About Us</div></a>
        <a href="./components/contactUs.php"><div>Contact Us</div></a>
        <a href="./components/login.php"><div class="login">Log in</div></a>
      </div>

      <div id="bar">
        <i class="fa-solid fa-bars"></i>
      </div>


      <div class="right">
          <a href="./components/products.php"><div class="prod">Products</div></a>
          <?php if(!empty($_SESSION["user_id"])){ ?>
              <a href="./components/history.php"><div class="history">History</div></a>
          <?php }?>
          <a href="./components/cart.php"><i class="fa-regular fa-heart"></i></a>

          <?php if(!empty($_SESSION["user_id"])){ ?>
              <div class="dropdown">
                  <i class="fa-regular fa-user" onclick="toggleDropdown()"></i>
                  <div class="dropdown-content" id="dropdownContent">
                      <a href="./components/profile.php">Profile</a>
                      <a href="./components/logout.php">Log out</a>
                  </div>
              </div>
          <?php } else { ?>
              <a href="./components/login.php"><div class="login">Log in</div></a>
          <?php }?>
      </div>
    </nav>

    <main>
        <div class="center">
            <div class="con">
                <div class="center">
                    <div class="con-div-first">
                        <div class="context-div">
                            <h3>Best Quality Products</h3>
                            <p>
                                We're your one-stop shop for everything from sizzling steaks and succulent 
                                roasts to delicious ground meat and flavourful poultry. Our friendly butchers 
                                are experts in selecting the perfect cut for your needs, and can even prepare 
                                them to your specifications.
                            </p>
    
                            <div style="display: flex; justify-content: center;">
                                <button>
                                    <div><i class="fa-solid fa-cart-shopping"></i></div>
                                    SHOP NOW
                                </button>
                            </div>
                        </div>
                        <div class="img-con">
                            <img src="./assets/imgs/img-1.avif" alt="">
                        </div>
                    </div>
                </div>

                <div class="con-div-second">
                    <div class="container">
                        <div><i class="fa-solid fa-truck"></i></div>
                        <div class="title">Pick up at the shop</div>
                        <p>On time process</p>
                    </div>

                    <div class="container">
                        <div><i class="fa-solid fa-certificate"></i></div>
                        <div class="title">Certified Fresh</div>
                        <p>100% Guarantee</p>
                    </div>

                    <div class="container">
                        <div><i class="fa-regular fa-money-bill-1"></i></div>
                        <div class="title">Huge Savings</div>
                        <p>On time process</p>
                    </div>

                    <div class="container">
                        <div><i class="fa-solid fa-recycle"></i></div>
                        <div class="title">Easy Returns</div>
                        <p>No Questions Asked</p>
                    </div>
                </div>

                <div class="con-div-third">
                    <div class="center">
                        <h1>Best Selling Products</h1>
                    </div>
                    <div class="center">
                        <div class="flex">
                            <a href="./components/porkprod.php">
                                <div class="con-item">
                                    <div class="img-con">
                                        <img src="./assets/pork/img-1.jpeg" alt="">
                                    </div>
                                    <div class="details">
                                        <div class="title">
                                            Fresh Pork Chop
                                        </div>
                                        <p class="price">₱360.00 PHP</p>
                                    </div>
                                </div>
                            </a>
    
                            <a href="./components/porkprod.php">
                                <div class="con-item">
                                    <div class="img-con">
                                        <img src="./assets/pork/img-6.jpeg" alt="">
                                    </div>
                                    <div class="details">
                                        <div class="title">
                                            Pork Liempo
                                        </div>
                                        <p class="price">₱290.00 PHP</p>
                                    </div>
                                </div>
                            </a>
    
                            <a href="./components/porkprod.php">
                                <div class="con-item">
                                    <div class="img-con">
                                        <img src="./assets/pork/img-7.jpeg" alt="">
                                    </div>
                                    <div class="details">
                                        <div class="title">
                                            Pork Kasim
                                        </div>
                                        <p class="price">₱230.00 PHP</p>
                                    </div>
                                </div>
                            </a>

                            <a href="./components/porkprod.php">
                                <div class="con-item">
                                    <div class="img-con">
                                        <img src="./assets/pork/img-8.jpeg" alt="">
                                    </div>
                                    <div class="details">
                                        <div class="title">
                                            Pork Lomo
                                        </div>
                                        <p class="price">₱210.00 PHP</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="con-div-third">
                    <div class="center">
                        <h1>CUSTOMERS FAVORITE</h1>
                    </div>
                    <div class="center">
                        <div class="flex flex-second">
                            <div class="con-item">
                                <a href="./components/chickenprod.php">
                                    <div class="img-con">
                                        <img src="./assets/chicken/img-1.webp" alt="">
                                    </div>
                                </a>
                                <div class="details">
                                    <div class="title">
                                        Chicken Breast
                                    </div>
                                    <p class="price">₱310.00 PHP</p>
                                </div>
                                <div class="div-button">
                                    <a href="./components/chickenprod.php">
                                        <button>
                                            SHOP NOW
                                            <div><i class="fa-solid fa-arrow-right"></i></div>
                                        </button>
                                    </a>
                                </div>
                            </div>
    
                            <div class="con-item">
                                <a href="./components/products.php">
                                    <div class="img-con">
                                        <img src="./assets/beef/img-3.jpeg" alt="">
                                    </div>
                                </a>
                                <div class="details">
                                    <div class="title">
                                        Roast Beef
                                    </div>
                                    <p class="price">₱370.00 PHP</p>
                                </div>
                                <div class="div-button">
                                    <a href="./components/products.php">
                                        <button>
                                            SHOP NOW
                                            <div><i class="fa-solid fa-arrow-right"></i></div>
                                        </button>
                                    </a>
                                </div>
                            </div>
    
                            <div class="con-item">
                                <a href="./components/products.php">
                                    <div class="img-con">
                                        <img src="./assets/beef/img-1.webp" alt="">
                                    </div>
                                </a>
                                <div class="details">
                                    <div class="title">
                                        Fresh Beef Steak
                                    </div>
                                    <p class="price">₱370.00PHP</p>
                                </div>
                                <div class="div-button">
                                    <a href="./components/products.php">
                                        <button>
                                            SHOP NOW
                                            <div><i class="fa-solid fa-arrow-right"></i></div>
                                        </button>
                                    </a>
                                </div>
                            </div>
    
                            <div class="con-item">
                                <a href="./components/porkprod.php">
                                    <div class="img-con">
                                        <img src="./assets/pork/img-2.jpeg" alt="">
                                    </div>
                                </a>
                                <div class="details">
                                    <div class="title">
                                        Fresh Pork Ribs
                                    </div>
                                    <p class="price">₱340.00PHP</p>
                                </div>
                                <div class="div-button">
                                    <a href="./components/porkprod.php">
                                        <button>
                                            SHOP NOW
                                            <div><i class="fa-solid fa-arrow-right"></i></div>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <footer>
        <div class="img-con">
          <img src="./assets/imgs/logo.png" alt="">
        </div>
        <div class="footer-title">Manny And Susse Meatshop</div>
        <div class="footer-flex">
          <div><a href="./components/contactUs.php">Contact</a></div>
          <div><a href="./components/faqs.php">FAQs</a></div>
          <div><a href="./components/privacyPolicy.php">Privacy Policy</a></div>
          <div><a href="./components/terms.php">Terms & Condition</a></div>
          <div><a href="./components/aboutUs.php">About Us</a></div>
          <!-- <div><a href="./components/reviews.php">Reviews</a></div> -->
        </div>
        <div class="soc-flex">
          <div style="font-size: 14px;">©M&S meatshop 2024</div>
          <div class="soc-media-con">
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-square-x-twitter"></i></a>
          </div>
        </div>
      </footer>


    <script src="./scripts/navbar.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function toggleDropdown() {
        document.getElementById("dropdownContent").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.fa-user')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
</body>
</html>