<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="../jquery/jquery.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="../styles/signup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Sign up</title>
</head>
<body>
    <?php include "./navbar.php" ?>
        <div class="center">
            <div class="container">
                <div class="title">Sign up</div>
                <div class="content">
                <form>
                    <div class="user-details">
                    <div class="input-box">
                        <span class="details">First name<span>*</span></span>
                        <input type="text" id="fname" placeholder="Enter first name">
                    </div>
                    <div class="input-box">
                        <span class="details">Middle name</span>
                        <input type="text" id="mname" placeholder="Enter middle name">
                    </div>
                    <div class="input-box">
                        <span class="details">Last name<span>*</span></span>
                        <input type="text" id="lname" placeholder="Enter last name">
                    </div>
                    <div class="input-box">
                        <span class="details">Email<span>*</span></span>
                        <input type="text" id="email" placeholder="Enter your email">
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number<span>*</span></span>
                        <input type="text" id="phoneNum" placeholder="Enter your number" oninput="validateInput(this)" pattern="\d*" maxlength="11">
                    </div>
                    <div class="input-box">
                        <span class="details">Address<span>*</span></span>
                        <input type="text" id="address" placeholder="Enter your address">
                    </div>
                    <div class="input-box">
                        <span class="details">Username<span>*</span></span>
                        <input type="text" id="uname" placeholder="Enter your username">
                    </div>
                    <div class="input-box">
                        <span class="details">Password<span>*</span></span>
                        <input type="password" id="password" placeholder="Enter your password">
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password<span>*</span></span>
                        <input type="password" id="confirmPass" placeholder="Confirm your password">
                    </div>
                    </div>
                    <div class="gender-details">
                    <input type="radio" value="Male" name="gender" id="dot-1">
                    <input type="radio" value="Female" name="gender" id="dot-2">
                    <input type="radio" value="Other" name="gender" id="dot-3">
                    <span class="gender-title">Gender</span>
                    <div class="category">
                        <label for="dot-1">
                        <span class="dot one"></span>
                        <span class="gender">Male</span>
                    </label>
                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span class="gender">Female</span>
                    </label>
                    <label for="dot-3">
                        <span class="dot three"></span>
                        <span class="gender">Prefer not to say</span>
                        </label>
                    </div>
                    </div>
                    <div class="button">
                    <input type="submit" value="Register">
                    </div>

            <div class="modal-body d-flex align-items-start" style="font-size: 14px;">
                <input name="terms" type="checkbox" required class="mr-2 mt-1" id="checkTerms">
                <label for="terms"> I have read and agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Terms and Conditions</a></label>
            </div>
                </form>
                </div>
            </div>
        </div>

<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 500px; overflow: auto">
                <div class="pb-2" style="line-height: 30px;">Welcome to Manny and Susse Meatshop. We ask that you carefully read these Terms and Conditions before placing any order with us. By making a purchase, you acknowledge and agree to the terms outlined here, which are designed to ensure a fair, efficient, and satisfactory experience for all customers.
                </div>
                <div class="pb-2" style="line-height: 30px;">First and foremost, we would like to inform you that we do not offer delivery services. All purchases made at Manny and Susse Meatshop must be picked up in-store during our operating hours. After placing an order, you will be informed of the scheduled pickup time. It is essential that orders are collected within the specified time frame to guarantee the freshness and quality of the products. This policy ensures that the high standards of our products are maintained from the moment they leave our shop until they reach your hands.</div>

                <div class="pb-2" style="line-height: 30px;">
                At Manny and Susse Meatshop we are committed to providing a clear and transparent system for purchasing our meat products. One of the key aspects of our operations is that all meat products are sold exclusively by kilograms (kg). This policy ensures consistency and simplicity for our customers, making it easier to understand and compare the pricing and quantity of our offerings.
                </div>

                <div class="pb-2" style="line-height: 30px;">We do not offer any sales based on other weight measurements, such as pounds, grams, or ounces. This exclusive focus on kilograms streamlines the buying process and aligns with international standards for food sales. By maintaining this approach, we eliminate any potential confusion that might arise from multiple weight categories and ensure that our customers always receive the correct portion size and price per kilogram.
                </div>

                <div class="pb-2" style="line-height: 30px;">Customers are required to purchase a minimum of 1/4 kilogram of meat, unless otherwise specified. This minimum order quantity allows us to manage our stock more effectively, minimize waste, and offer the freshest products possible. By setting this baseline, we can better serve our customers with both small and large orders, ensuring that every customer gets the quantity they need without compromising quality.</div>

                <div class="pb-2" style="line-height: 30px;">We also implement certain limitations on the size of individual orders. To accommodate as many customers as possible, we have set a maximum order limit of 10 kilograms per order. This rule helps ensure that we can serve a larger number of customers with the freshest products each day. Orders exceeding this limit will not be processed.</div>

                <div class="pb-2" style="line-height: 30px;">In addition, we maintain a strict no refund policy. Due to the perishable nature of our meat products, once a purchase has been made and processed, all sales are final. We do not offer refunds, returns, or exchanges for any reason. We urge customers to double-check their orders before finalizing the transaction to avoid any mistakes. Once an order is confirmed, we are not responsible for any changes, errors, or requests for modifications. This policy is in place to ensure the smooth operation of our business and to avoid unnecessary waste or confusion regarding returned goods.
                </div>

                <div class="pb-2" style="line-height: 30px;">
                The order process at Manny and Susse Meatshop is simple and straightforward. Orders can be placed either in-store or through the official methods provided on our website. Payments are made at the time of pickup, and we accept both cash and G-cash for customer convenience. However, we ask that all orders be verified before finalization, as changes cannot be made once the order is submitted.
                </div>

                <div class="pb-2" style="line-height: 30px;">
                We also emphasize that product availability is subject to stock levels, which may vary on a daily basis. As a result, we reserve the right to cancel or modify orders in the event that a particular item becomes unavailable. We appreciate your understanding and cooperation in these instances, as we are committed to providing the freshest products.
                </div>

                <div class="pb-2" style="line-height: 30px;">
                At Manny and Susse Meatshop, we take great pride in the quality and freshness of our meat. Every effort is made to ensure that the products you receive meet the highest standards. We encourage customers to inspect their orders at the time of pickup to guarantee satisfaction. Once an order has left our premises, it is the responsibility of the customer to store and handle the products in a safe and proper manner. We cannot be held liable for any spoilage or damage caused by improper handling after the product has been collected.
                </div>

                <div class="pb-2" style="line-height: 30px;">
                Lastly, we reserve the right to modify or update these Terms and Conditions as needed. Any changes will be posted on our website, and by continuing to use our services, you agree to abide by the updated terms. We advise customers to review these terms periodically to stay informed about any updates.
                </div>

                <div class="pb-2" style="line-height: 30px;">
                Thank you for choosing Manny and Susse Meatshop and accepting to these Terms & Conditions. Your understanding and cooperation enable us to provide an effortless and pleasurable purchasing experience for all.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <?php include "./footer.php" ?>

  <script src="../scripts/navbar.js"></script>
  <script src="../jquery/signup.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>