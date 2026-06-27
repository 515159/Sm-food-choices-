<?php
include("connect.php");

// Fetch all food items grouped by category
$query = "SELECT * FROM food_items ORDER BY category, name";
$result = mysqli_query($conn, $query);
$food_items = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Group items by category
$categories = [];
foreach ($food_items as $item) {
    $cat = $item['category'];
    if (!isset($categories[$cat])) {
        $categories[$cat] = [];
    }
    $categories[$cat][] = $item;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>SM Food Choice</title>
    <link
      rel="shortcut icon"
      href="images/logonew.jpg"
      type="image/x-icon"
    />

    <!-- META -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    

    <!-- GOOGLE FONTS -->
    <link
      href="https://fonts.googleapis.com/css2?family=Marck+Script&family=Ubuntu:wght@400;500;700&display=swap"
      rel="stylesheet"
    />

    <!-- CDN FONTS  -->
    <link href="https://fonts.cdnfonts.com/css/elinga" rel="stylesheet" />

    <!-- FONTAWESOME -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
      integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ="
      crossorigin="anonymous"
    />

    <!-- BOOTSTRAP -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />

    <!-- CSS -->
    <link href="https://copyfonts.com/fonts/attari-salees.html" />
    <link rel="stylesheet" href="./styles.css" />
  </head>

  <body>
    <div id="loading">
      <img
        id="loading-image"
        src="https://user-images.githubusercontent.com/62802231/194802891-66d7c782-9765-419d-964b-b6bf6323b95a.gif"
        alt="Loading..."
      />
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container">
        <!-- CODE FOR NAVIGATION BAR -->
        <ul class="px-0 mx-0">
          <img
            src="images/LOGO SM.jpg"
            height="70px"
            width="70px"
            alt="navbar-logo"
          />
        </ul>
        <a class="navbar-brand" href="index.html">Smart-Meal Food Choice</a>
        <!--         <a style ="font-size :class="navbar-brand" href="#">FOODIE HEAVEN</a> -->
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link px-3" href="#"
                >Home <span class="sr-only">(current)</span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link px-4" href="#categorySection">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-4" href="#healthySection">Hygiene</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-4" href="contactus.html">Contact Us</a>
            </li>
          </ul>
        </div>
        <span
          class="shoppingCart"
          data-toggle="modal"
          data-target="#exampleModal"
        >
          <i class="fas fa-shopping-cart"></i>
          <span class="shoppingCartAfter">0</span>
        </span>
      </div>
    </nav>

    <a id="scrollToTop" class="btn"><i class="fas fa-caret-up"></i></a>

    <div class="container home-container">
      <section id="homeSection" class="d-flex justify-content-center">
        <div class="row homeRow">
          <div class="col-lg-6 homeTxtCol">
            <h1 class="homeHeading">
              Foodie's Special Cusine<br />
              <span data-text="CHOICE">CHOICE</span>
              <br />
              Anytime
            </h1>
            <br />
            <div class="homeBtnDiv">
              <a href="#categorySection" class="btn homeBtn">Order Now</a>
            </div>
          </div>
          <div class="col-lg-6 homeImgCol">
            <img class="homeImg" src="images/Noodle round anime.png" alt="momos" />
          </div>
        </div>
      </section>
    </div>

    <br />

    <section id="categorySection">
      <div class="container">
        <h1>
          <span><b>MENU</b></span>
        </h1>
        <div class="row gutters-40">
          <div class="col-lg-4 col-sm-4 col-4">
            <div class="product-box-layout4 momos">
              <div class="item-figure">
                <img
                  src="./images/starters.jpg"
                  alt="Category"
                  width="100%"
                  height="100%"
                />
              </div>
              <div class="item-content">
                <h2 class="card-title">Starters</h2>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-sm-4 col-4">
            <div class="product-box-layout4 chinese">
              <div class="item-figure">
                <img
                  src="./images/chinese.jpg.avif"
                  alt="Category"
                  width="100%"
                  height="100%"
                />
              </div>
              <div class="item-content">
                <h2 class="card-title">Chinese</h2>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-sm-4 col-4">
            <div class="product-box-layout4 beverages">
              <div class="item-figure">
                <img
                  src="./images/beverages-updated.webp"
                  alt="Category"
                  width="100%"
                  height="100%"
                />
              </div>
              <div class="item-content">
                <h2 class="card-title">Beverages</h2>
              </div>
            </div>
          </div>
        </div>

        <!-- MENU STARTS HERE -->
        <div class="menuDiv">
          <!-- MODAL -->
          <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <div class="row paymentInfoRow">
                      <div class="col paymentInfo">
                        <span class="checkIcon"
                          ><i class="fas fa-check-circle"></i
                        ></span>
                        Select Menu
                      </div>
                      <div class="col paymentInfo">
                        <span class="checkIcon"
                          ><i class="fa-brands fa-whatsapp"></i
                        ></span>
                        Place order via Whatsapp
                      </div>
                      <div class="col paymentInfo">
                        <span class="checkIcon"
                          ><i class="fa-brands fa-google-pay"></i>
                        </span>
                        Pay using Google Pay.
                      </div>
                    </div>

                    <hr class="cartHr" />

                    <div class="cartContentDiv">
                      <h1>Your Cart is Empty</h1>
                    </div>

                    <div class="userInfoDiv">
                      <div class="mb-3 px-2">
                        <label for="address">Address *</label> <br />
                        <textarea
                          type="text"
                          class="form-control"
                          id="address"
                        ></textarea>
                      </div>
                      <div class="mb-3 px-2">
                        <label for="note">Note (optional)</label> <br />
                        <textarea
                          type="text"
                          class="form-control"
                          id="note"
                        ></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="totalAmountDiv"></div>
                  <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="location.reload()"
                  >
                    Clear Cart
                  </button>
                  <a class="btn btn-primary" onclick="openWhatsapp()">
                    Order Now
                  </a>
                </div>
              </div>
            </div>
          </div>

          <?php
          // Generate dynamic menu sections by category
          if (!empty($categories)) {
              $categoryCount = 0;
              foreach ($categories as $categoryName => $items) {
                  $categoryCount++;
                  $categoryId = str_replace(' ', '', strtolower($categoryName));
          ?>
          <div id="<?php echo $categoryId; ?>">
            <div class="row menuHeading">
              <div class="col-12">
                <h1><?php echo htmlspecialchars($categoryName); ?></h1>
              </div>
              <span class="shoppingCart" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-shopping-cart"></i>
                <span class="shoppingCartAfter">0</span>
              </span>
            </div>
            <div class="row">
              <?php
              $itemCount = 0;
              foreach ($items as $item) {
                  $icon = $item['is_vegetarian'] ? 'veg.webp' : 'non-veg.webp';
                  $iconClass = $item['is_vegetarian'] ? 'vegIcon' : 'nonVegIcon';
              ?>
                <div class="col-lg-4 col-sm-6 col-12">
                  <div class="card">
                    <h2 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h2>
                    <div class="card-body">
                      <div class="row foodItem">
                        <div class="col-9 foodItemName">
                          <p>
                            <?php echo htmlspecialchars($item['name']); ?>
                            <span>
                              <img
                                class="<?php echo $iconClass; ?>"
                                src="./images/<?php echo $icon; ?>"
                                alt="<?php echo $item['is_vegetarian'] ? 'veg' : 'non-veg'; ?>-icon"
                              />
                            </span>
                          </p>
                          <p class="text-muted-small">
                            <i class="fas fa-rupee-sign"></i><?php echo number_format($item['price'], 0); ?>
                          </p>
                        </div>
                        <div class="col-3 addCol">
                          <span class="menuBtn minus"><i class="fas fa-minus"></i></span>
                          <span class="quantity">0</span>
                          <span class="menuBtn plus"><i class="fas fa-plus"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
            <div class="row checkOutRow">
              <button type="button" class="btn knowMoreBtn" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-shopping-cart"></i> Go to Cart
              </button>
            </div>
          </div>
          <?php
              }
          } else {
          ?>
          <div style="text-align: center; padding: 40px;">
            <h2>No items available yet</h2>
            <p>Check back soon for our menu updates!</p>
          </div>
          <?php
          }
          ?>
        </div>
      </div>
    </section>

    <section id="healthySection">
      <h1 class="hygiene-title">
        <span><b>HYGIENE</b></span>
      </h1>
      <div class="eatSure container">
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>80
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Paneer Momo
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>90
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Mushroom Momo
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>115
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Corn and Cheese Momo
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>130
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken Momo
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>90
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken Schezwan Momo
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>130
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken and Cheese Momo
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>140
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Fish Momo
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>130
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-12">
                <div class="card">
                  <h2 class="card-title">Fried Momos</h2>
                  <div class="card-body">
                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Veggie Fried Momo
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>125
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Paneer Fried Momo
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>135
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Mushroom Fried Momo
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>145
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Corn Cheese Fried Momo
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>160
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken Fried Momo
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>135
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken Schezwan Fried Momo
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>155
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken Cheese Fried Momo
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>170
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Fish Fried Momo
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>155
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row checkOutRow">
              <button
                type="button"
                class="btn knowMoreBtn"
                data-toggle="modal"
                data-target="#exampleModal"
              >
                <i class="fas fa-shopping-cart"></i> Go to Cart
              </button>
            </div>
          </div>

          <div id="chinese">
            <div class="row menuHeading">
              <div class="col-12">
                <h1>Chinese</h1>
              </div>
              <!-- Button trigger modal -->
              <span
                class="shoppingCart"
                data-toggle="modal"
                data-target="#exampleModal"
              >
                <i class="fas fa-shopping-cart"></i>
                <span class="shoppingCartAfter">0</span>
              </span>
            </div>
            <div class="row">
              <div class="col-lg-4 col-sm-6 col-12">
                <div class="card">
                  <h2 class="card-title">Rice and Noodles</h2>
                  <div class="card-body">
                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Veg Hakka Noodles
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>200
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chilli Garlic Noodles
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>210
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Steamed Rice<span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>190
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Corn Fried Rice
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>230
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken Hakka Noodles
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>220
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken Garlic Noodles
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>230
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken Fried Rice
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>230
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Mix Meat Fried Rice
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>300
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-sm-6 col-12">
                <div class="card">
                  <h2 class="card-title">Appetizers</h2>
                  <div class="card-body">
                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chilli Potato<span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>250
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Veg Spring Roll
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>270
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chilli Paneer
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>280
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken Spring Roll
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>300
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Crispy Honey Chicken<span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>350
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />
                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Cantonese Spring Rolls<span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>400
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Baked Chicken Wings<span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>420
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Crab Rangoon<span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>540
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>

                    <div class="row foodItem"></div>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card">
                  <h2 class="card-title">Main Course</h2>
                  <div class="card-body">
                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Veg Garlic Sauce<span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>350
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Veg Garlic Sauce
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>350
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Potato Garlic Sauce
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>350
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Mixed Vegetable Sauce
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>370
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Stir Fried Asian Green<span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>370
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />
                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Burnt Garlic Rice
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>395
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />
                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Creamy Noodles
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>250
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />
                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Shredded Chicken
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>640
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row checkOutRow">
              <button
                type="button"
                class="btn knowMoreBtn"
                data-toggle="modal"
                data-target="#exampleModal"
              >
                <i class="fas fa-shopping-cart"></i> Go to Cart
              </button>
            </div>
          </div>

          <div id="beverages">
            <div class="row menuHeading">
              <div class="col-12">
                <h1>Beverages</h1>
              </div>
              <!-- Button trigger modal -->
              <span
                class="shoppingCart"
                data-toggle="modal"
                data-target="#exampleModal"
              >
                <i class="fas fa-shopping-cart"></i>
                <span class="shoppingCartAfter">0</span>
              </span>
            </div>
            <div class="row">
              <div class="col-sm-6 col-12">
                <div class="card">
                  <h2 class="card-title">Soups</h2>
                  <div class="card-body">
                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Veg Manchow
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>150
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Sweet Corn
                          <span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>150
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Hot 'N' Sour<span>
                            <img
                              class="vegIcon"
                              src="./images/veg.webp"
                              alt="veg-icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>150
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken Manchow
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>170
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken Sweet Corn
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>170
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>
                          Chicken Hot 'N' Sour
                          <span>
                            <img
                              class="nonVegIcon"
                              src="./images/non-veg.webp"
                              alt="non-veg icon"
                            />
                          </span>
                        </p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>170
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-12">
                <div class="card">
                  <h2 class="card-title">Mocktails</h2>
                  <div class="card-body">
                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>Midnight Beauty</p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>120
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>Mojito</p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>150
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>Pink Lemonade</p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>140
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>Silver Lining</p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>140
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />

                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>Sweet Memories</p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>150
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                    <hr class="foodItemHr" />
                    <div class="row foodItem">
                      <div class="col-9 foodItemName">
                        <p>Virgin Mojito</p>
                        <p class="text-muted-small">
                          <i class="fas fa-rupee-sign"></i>230
                        </p>
                      </div>
                      <div class="col-3 addCol">
                        <span class="menuBtn minus"
                          ><i class="fas fa-minus"></i
                        ></span>
                        <span class="quantity">0</span>
                        <span class="menuBtn plus"
                          ><i class="fas fa-plus"></i
                        ></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row checkOutRow">
              <button
                type="button"
                class="btn knowMoreBtn"
                data-toggle="modal"
                data-target="#exampleModal"
              >
                <i class="fas fa-shopping-cart"></i> Go to Cart
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="healthySection">
      <h1 class="hygiene-title">
        <span><b>HYGIENE</b></span>
      </h1>
      <div class="eatSure container">
        <div class="row">
          <div class="col-sm-2 col-12">
            <img
              src="https://assets.faasos.io/ovenstory-react.in/production/eat-sure-mobile.png"
              alt="eat-sure logo"
            />
          </div>

          <div class="col-sm-2 col-6 borderLeft">
            <div class="icon-wrapper">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                id="Capa_1"
                enable-background="new 0 0 515.556 515.556"
                height="512px"
                viewBox="0 0 515.556 515.556"
                width="512px"
              >
                <g>
                  <path
                    d="m0 274.226 176.549 176.886 339.007-338.672-48.67-47.997-290.337 290-128.553-128.552z"
                    data-original="#000000"
                    class="active-path"
                    data-old_color="#000000"
                    fill="#FFFFFF"
                  ></path>
                </g>
              </svg>
            </div>
            <div class="text">Experienced and Hyginic Staff</div>
          </div>

          <div class="col-sm-2 col-6 borderLeft">
            <div class="icon-wrapper">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                id="Capa_1"
                enable-background="new 0 0 515.556 515.556"
                height="512px"
                viewBox="0 0 515.556 515.556"
                width="512px"
              >
                <g>
                  <path
                    d="m0 274.226 176.549 176.886 339.007-338.672-48.67-47.997-290.337 290-128.553-128.552z"
                    data-original="#000000"
                    class="active-path"
                    data-old_color="#000000"
                    fill="#FFFFFF"
                  ></path>
                </g>
              </svg>
            </div>
            <div class="text">All Quality Checks Approved</div>
          </div>

          <div class="col-sm-2 col-6 borderLeft">
            <div class="icon-wrapper">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                id="Capa_1"
                enable-background="new 0 0 515.556 515.556"
                height="512px"
                viewBox="0 0 515.556 515.556"
                width="512px"
              >
                <g>
                  <path
                    d="m0 274.226 176.549 176.886 339.007-338.672-48.67-47.997-290.337 290-128.553-128.552z"
                    data-original="#000000"
                    class="active-path"
                    data-old_color="#000000"
                    fill="#FFFFFF"
                  ></path>
                </g>
              </svg>
            </div>
            <div class="text">No Chemicals and artificial flavours</div>
          </div>

          <div class="col-sm-2 col-6 borderLeft">
            <div class="icon-wrapper">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                id="Capa_1"
                enable-background="new 0 0 515.556 515.556"
                height="512px"
                viewBox="0 0 515.556 515.556"
                width="512px"
              >
                <g>
                  <path
                    d="m0 274.226 176.549 176.886 339.007-338.672-48.67-47.997-290.337 290-128.553-128.552z"
                    data-original="#000000"
                    class="active-path"
                    data-old_color="#000000"
                    fill="#FFFFFF"
                  ></path>
                </g>
              </svg>
            </div>
            <div class="text">Quality Packaging <br /><br /></div>
          </div>

          
        </div>
      </div>

      <div class="container safetyMeasuresDiv">
        <p class="safetyMeasuresPara">
          We have always followed hygienity at SM Food Choice and we also took 
          <br />
          some of the good specific measures and followed them.
        </p>
        <div class="row safetyMeasures">
          <div class="col-sm-3 col-6">
            <img
              src="./svg/mask.svg"
              alt="Our Kitchen executives have been instructed to wear masks at all times."
            />
            <p>
              Our Kitchen executives have been instructed to wear masks at all
              times.
            </p>
          </div>

          <div class="col-sm-3 col-6">
            <img
              src="./svg/thermo.svg"
              alt="A daily log of our executives’ body temperatures is being maintained."
            />
            <p>
              Our management executives’ body temperatures is being checked <br />
              thoroughly.
            </p>
          </div>

          <div class="col-sm-3 col-6">
            <img
              src="./svg/sanitizer.svg"
              alt="Every kitchen executive sanitizes his/her hands every hour."
            />
            <p>
              All kitchen executives are sanitized and maintain neatness.
              <br /><br />
            </p>
          </div>

          <div class="col-sm-3 col-6">
            <img
              src="./svg/clean.svg"
              alt="Every kitchen surface is rigorously cleaned to ensure a clean and sanitized workstation."
            />
            <p>
              Kitchen surface is neatly cleaned to ensure a clean and
              sanitized workspace.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS SECTION -->
    <section id="healthySection" class="testimonials">
      <h1 class="hygiene-title">
        <span><b>REVIEWS</b></span>
      </h1>
      <div class="row d-flex justify-content-center">
        <div class="col-md-10 col-xl-8 text-center">
          <p class="mb-4 pb-2 mb-md-5 pb-md-0">SM Food Choice Reviews !</p>
        </div>
      </div>

      <div class="row text-center">
        <div class="col-md-4 mb-5 mb-md-0">
          <div class="d-flex justify-content-center mb-4">
            <img
              src="images/jung.jpg"
              class="rounded-circle shadow-1-strong"
              width="150"
              height="150"
              alt="person"
            />
          </div>
          <h5 class="mb-3">Jung Kook</h5>
          <p class="px-xl-3">
            <i class="fas fa-quote-left pe-2"></i>
            Amazing taste and worth for money.
          </p>
          <ul class="list-unstyled d-flex justify-content-center mb-0">
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
          </ul>
        </div>
        <div class="col-md-4 mb-5 mb-md-0">
          <div class="d-flex justify-content-center mb-4">
            <img
              src="images/kohli.jpg"
              class="rounded-circle shadow-1-strong"
              width="150"
              height="150"
              alt="person"
            />
          </div>
          <h5 class="mb-3">Virat Kohli</h5>
          <p class="px-xl-3">
            <i class="fas fa-quote-left pe-2"></i>Nice and tasty.
          </p>
          <ul class="list-unstyled d-flex justify-content-center mb-0">
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
            <li>
              <i class="fas fa-star-half-alt fa-sm text-warning"></i>
            </li>
          </ul>
        </div>
        <div class="col-md-4 mb-0">
          <div class="d-flex justify-content-center mb-4">
            <img
              src="images/allu.jpg"
              class="rounded-circle shadow-1-strong"
              width="150"
              height="150"
              alt="person"
            />
          </div>
          <h5 class="mb-3">Allu Arjun</h5>
          <p class="px-xl-3">
            <i class="fas fa-quote-left pe-2"></i>Love the spice, Just amazing
          </p>
          <ul class="list-unstyled d-flex justify-content-center mb-0">
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
            <li>
              <i class="fas fa-star fa-sm text-warning"></i>
            </li>
            <li>
              <i class="far fa-star fa-sm text-warning"></i>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <!-- FOOTER STARTS HERE -->

    <footer id="footer">
      <div class="container">
        <div class="row">
          <div class="col-9 footerHeadingCol">
            <h2>SM Food Choice</h2>
          </div>

          <div class="col-3 socialMedia">
            <a href="https://www.facebook.com/profile.php?id=100089664641257" class="socialMediaIcon">
              <span><i class="fab fa-facebook-f"></i></span
            ></a>
            <a href="https://twitter.com/manoj27" class="socialMediaIcon">
              <span><i class="fab fa-twitter"></i></span
            ></a>
            <a href="https://www.instagram.com/manoj_suri_2004/" class="socialMediaIcon">
              <span><i class="fab fa-instagram"></i></span
            ></a>
          
          </div>
        </div>

        <div class="row contactRow">
          <p>
            
            
            |
            <!-- <a class="footer_clickable" href="tel:+911234567890">Contact Us</a> -->
            <a class="footer_clickable" href="./contactus.html">Contact Us</a>
          </p>
        </div>

        <div class="row copyrightRow">
          
        </div>
      </div>
    </footer>

    <!-- BOOTSTRAP JS -->
    <script
      src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"
    ></script>
    <!-- FONT AWESOME JS -->
    <script
      src="https://kit.fontawesome.com/9f6e489cf7.js"
      crossorigin="anonymous"
    ></script>
    <!-- JQUERY CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- CUSTOM JS -->
    <script src="./index.js"></script>
  </body>

  <!-- BOOTSTRAP JS -->
  <script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"
  ></script>

  <!-- JQUERY CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- CUSTOM JS -->
  <script src="./index.js"></script>
  <script>
    $(window).on("load", function () {
      $("#loading").hide();
    });
  </script>
</html>
