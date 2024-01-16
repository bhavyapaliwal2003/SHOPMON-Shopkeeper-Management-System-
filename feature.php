<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta tags, title, and link to CSS files go here -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Feature Page</title>
  <!-- Include your CSS files -->
  <link href="assets/css/theme.css" rel="stylesheet" />



  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand" href="home.php" ><b class="text-danger fw-bold ">SHOPMON</b></a>        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto pt-2 pt-lg-0 font-base">
            <li class="nav-item px-2" ><a class="nav-link fw-bold active" aria-current="page" href="aboutus.php">About us</a></li>
            <li class="nav-item px-2"><a class="nav-link fw-bold" href="feature.php">Features</a></li>
            <li class="nav-item px-2" ><a class="nav-link fw-bold" href="pricing.php">Pricing</a></li>
          </ul>
          <form class="ps-lg-5">
          <button class="btn btn-link text-danger fw-bold order-1 order-lg-0" type="button" href="getstarted/login.php">Sign in</button><a class="btn hover-top btn-collab" href="getstarted/register.php">TRY FOR FREE</a>
          </form>
        </div>
      </div>
    </nav>
    <br>
    <section >
      <div class="container">
        <div class="row flex-center">
          <div class="col-md-6 col-lg-4 text-center mb-6 mb-md-0 order-0 order-md-1">
          <img class="pt-7 pt-md-0 w-100" src="assets/img/gallery/unlockinovation.jpeg" alt="hero-header" />
          </div>
          <div class="col-md-6 text-center text-md-start mb-6 offset-lg-1">
            <h6 class="fs-0 text-uppercase fw-bold text-primary">Amazing Feature</h6>
            <h6 class="fw-bold fs-3 fs-lg-5 lh-sm">Unlocking Innovation</h6>
            <p class="my-4 fs-1 pe-xl-8">Our app introduces an amazing feature that unlocks innovation and streamlines your workflow. Embrace efficiency and creativity in your projects like never before.</p>
            <a class="btn hover-top btn-collab" href="#" role="button">Learn more</a>
          </div>
        </div>

        <div class="row flex-center">
        <div class="container text-center">
    <h2 class="fs-2 fw-bold mb-4">Features</h2>
  </div>

  <!-- Invoice Management -->
  <div class="col-md-4 col-lg-3 mt-4 mt-lg-8 text-center text-md-start">
    <div class="badge bg-white p-3 rounded-3"><img class="w-100 h-100" src="assets\img\gallery\WhatsApp Image 2023-12-12 at 12.48.27 AM.jpeg" alt="Invoice Icon" /></div>
    <h4 class="mt-5 mb-3 fw-bold">Invoice Management</h4>
    <p class="fs-1 lh-sm">Effortlessly manage your invoices, track payments, and stay organized with our intuitive invoice management system.</p>
  </div>

  <!-- Inventory Management -->
  <div class="col-md-4 col-lg-3 mt-4 mt-lg-8 text-center text-md-start">
    <div class="badge bg-white p-3 rounded-3"><img class="w-100 h-100" src="assets\img\gallery\WhatsApp Image 2023-12-12 at 12.46.04 AM.jpeg" alt="Inventory Icon" /></div>
    <h4 class="mt-5 mb-3 fw-bold">Inventory Management</h4>
    <p class="fs-1 lh-sm">Streamline your inventory processes, track stock levels, and manage orders efficiently with our comprehensive inventory management system.</p>
  </div>
   <!-- Receivables Management Feature -->
   <div class="col-md-4 col-lg-3 mt-4 mt-lg-8 text-center text-md-start">
        <div class="badge bg-white p-3 rounded-3"><img class="w-100 h-100" src="assets\img\gallery\WhatsApp Image 2023-12-12 at 1.24.13 AM.jpeg" alt="Receivables Icon" /></div>
        <h4 class="mt-5 mb-3 fw-bold">Receivables Management</h4>
        <p class="fs-1 lh-sm">
          - Utilize Accounts Payable (AP) and Accounts Receivable (AR) functionalities.<br>
          - Enhance user experience and streamline business processes through automation.
        </p>
      </div>
<!-- FMGC Integration Feature -->
<div class="col-md-4 col-lg-3 mt-4 mt-lg-8 text-center text-md-start">
        <div class="badge bg-white p-3 rounded-3"><img class="w-100 h-100" src="assets\img\gallery\WhatsApp Image 2023-12-12 at 1.18.33 AM.jpeg" alt="FMGC Icon" /></div>
        <h4 class="mt-5 mb-3 fw-bold">FMGC Integration</h4>
        <p class="fs-1 lh-sm">
          - Specifically tailored for "Fast Moving Goods" (FMGC) businesses.<br>
          - Streamline inventory management and pricing in the retail sector.<br>
          - Ensure efficient production and distribution of commodities.
        </p>
      </div>



</div>

      </div>
      <!-- end of .container-->
    </section>

    
   

    <!-- Contact Us Section -->
    <section class="py-6" style="background:linear-gradient(180deg, #FFFEFC -54.51%, #FFF8F0 99.98%);">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 offset-lg-3 text-center">
            <h2 class="fs-2 fw-bold text-primary">Contact Us</h2>
            <p class="my-4 fs-1">Have questions or need assistance? Contact our support team.</p>
          </div>
        </div>
        <div class="row flex-center">
          <div class="col-md-8 col-lg-6">
            <form>
              <div class="mb-3">
                <label for="contactName" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="contactName" placeholder="Enter your name">
              </div>
              <div class="mb-3">
                <label for="contactEmail" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="contactEmail" placeholder="Enter your email">
              </div>
              <div class="mb-3">
                <label for="contactMessage" class="form-label">Your Message</label>
                <textarea class="form-control" id="contactMessage" rows="4" placeholder="Enter your message"></textarea>
              </div>
              <button type="submit" class="btn btn-collab">Send Message</button>
            </form>
          </div>
        </div>
      </div>
    </section>
    <section class="py-md-0">
        <div class="bg-holder" style="background-image:url(assets/img/gallery/cta-2-bg.png);background-position:center;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-5 col-lg-3 text-center"><img class="mt-n8 d-none d-md-block w-100" src="assets/img/gallery/cta-2.png" alt="cta" /></div>
            <div class="col-md-7 col-lg-8 offset-lg-1">
              <h1 class="fw-bold fs-4 fs-lg-6 mb-4 text-white"> Start using our site today, <br class="d-none d-xxl-block" />enjoy the complete fun</h1>
            </div>
          </div>
        </div>
      </section>
  <!-- Subscription Section -->
</section>
  <div class="container">
          <div class="row flex-center mt-5">
            <div class="col-lg-6">
              <h4 class="fw-bold">For more, Subscribe now</h4>
              <p class="fs-1">Stay updated and work accordingly </p>
            </div>
            <div class="col-lg-6 d-flex justify-content-lg-end mb-4">
              <form class="row row row-cols-lg-auto align-items-center">
                <div class="col-8 col-sm-9">
                  <label class="visually-hidden" for="colFormLabel">Username</label>
                  <div class="input-group">
                    <input class="form-control" id="colFormLabel" type="email" placeholder="Enter email address" />
                  </div>
                </div>
                <div class="col-4 col-sm-3 text-end">
                  <button class="btn btn-collab" type="submit">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <hr class="text-200" />
          <div class="row justify-content-lg-between circle-blend-right circle-danger">
            <div class="col-6 col-sm-4 col-lg-auto mb-3">
              <h6 class="my-4 fw-bold fs-0">WHY US</h6>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Channel</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Engagement</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Scale</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Watch Demo</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-auto mb-3">
              <h6 class="my-4 fw-bold fs-0">PRODUCT</h6>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Features</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Integrations</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Enterprise</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Solutions</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-auto mb-3">
              <h6 class="my-4 fw-bold fs-0">RESOURCES</h6>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Partners</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Developers</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Apps</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Blogs</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-auto mb-3">
              <h6 class="my-4 fw-bold fs-0">COMPANY</h6>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">About Us</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Leadership</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Investor Relations</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">News</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-auto mb-3">
              <h6 class="my-4 fw-bold fs-0">PRICING</h6>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Plans</a></li>
                <li class="mb-2"><a class="text-1100 text-decoration-none" href="#!">Paid vs. Free</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-auto mb-3">
              <h6 class="my-4 fw-bold fs-0">FOLLOW</h6>
              <ul class="list-unstyled list-inline my-3">
                <li class="list-inline-item me-3"><a class="text-decoration-none" href="#!"><img class="list-social-icon" src="assets/img/icons/facebook.svg" alt="" /></a></li>
                <li class="list-inline-item me-3"><a class="text-decoration-none" href="#!"><img class="list-social-icon" src="assets/img/icons/twitter.svg" alt="" /></a></li>
                <li class="list-inline-item me-3"><a class="text-decoration-none" href="#!"><img class="list-social-icon" src="assets/img/icons/instagram.svg" alt="" /></a></li>
                <li class="list-inline-item"><a class="text-decoration-none" href="#!"><img class="list-social-icon" src="assets/img/icons/snapchat.svg" alt="" /></a></li>
              </ul>
            </div>
          </div>
          <hr class="text-200 mb-0" />
          <div class="row justify-content-md-between justify-content-evenly py-3">
            <div class="col-12 col-sm-8 col-md-6 col-lg-auto text-center text-md-start">
              <p class="fs-0 my-2 text-400">All rights Reserved <span class="fw-bold text-500">&copy; SHOPMON</span></p>
            </div>
            
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@200;300;400;500;600;700&amp;family=Montserrat:wght@200;300&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@200;300;400;500;600;700&amp;family=Montserrat:wght@200;300;400;500;600;700&amp;display=swap" rel="stylesheet">
  </body>

</html>