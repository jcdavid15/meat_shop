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

    <link rel="stylesheet" href="../styles/contactUs.css">
    <title>Contact Us</title>
</head>
<body>

    <?php include "./navbar.php" ?>

    <main>
        <div class="con-relative">
            <div class="img-con img-con-8">
              <img src="../assets/imgs/contact-us.avif" alt="">
            </div>
            <div class="con-abs">
             <div class="flex">
              <div class="header">Contact Us</div>
              <a href="#desc"><button id="desc">Get in Touch</button></a>
             </div>
            </div>
        </div>

        <div class="center">
            <div class="con">
                <div class="con-flex">
                    <div class="con-desc">
                        <h1>Need Assistance?</h1>
                        <div class="context">
                            We're here to assist you! Reach out to our 
                            team for expert guidance and personalized 
                            solutions tailored to your culinary needs. 
                            Whether you're looking for cooking tips, meat 
                            recommendations, or collaboration opportunities, 
                            our dedicated representatives are just a click 
                            or call away.
                        </div>
                    </div>
                    
                    <form action="">
                        <div class="form-div">
                            <label for="name">Name<span>*</span></label>
                            <input type="text" id="name" placeholder="Enter your name" required>
                        </div>

                        <div class="form-div">
                            <label for="email">Email<span>*</span></label>
                            <input type="email" id="email" placeholder="Enter your email" required>
                        </div>

                        <div class="form-div">
                            <label for="message">Message<span>*</span></label>
                            <textarea name="message" id="message" cols="30" rows="10" required></textarea>
                        </div>
                        <div style="display: flex; justify-content: end;">
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include "./footer.php" ?>

    <script src="../scripts/navbar.js"></script>
</body>
</html>