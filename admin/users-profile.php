<?php include_once("includes/head.php")?>

<body>

  <!-- ======= Header ======= -->
  <?php include_once("includes/navbar.php")?>

  <!-- ======= Sidebar ======= -->
  <?php include_once("includes/sidebar.php")?>

  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <img src="images/<?=$admin['profile_image']?>" alt="Profile" class="rounded-circle">
              <h2 class="text-capitalize"><?=$admin['full_name']?></h2>
              <h3 class="text-capitalize"><?=$admin['designation']?></h3>
              <div class="social-links mt-2">
                <?php
                $socialLinkQuery = "SELECT * FROM sociallink";
                $runSQ = mysqli_query($db, $socialLinkQuery);
                while($socialLink = mysqli_fetch_assoc($runSQ)){
                  ?>
                  <a href="<?=$socialLink['site_link']?>" target="_blank" title="<?=$socialLink['site_title']?>"><?=$socialLink['site_icon']?></a>
                  <?php
                }
                ?>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?=$admin['about']?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row text-capitalize">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?=$admin['full_name']?></div>
                  </div>

                  <div class="row text-capitalize">
                    <div class="col-lg-3 col-md-4 label">Designation</div>
                    <div class="col-lg-9 col-md-8"><?=$admin['designation']?></div>
                  </div>

                  <div class="row text-capitalize">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8"><?=$admin['country']?></div>
                  </div>

                  <div class="row text-capitalize">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?=$admin['address']?></div>
                  </div>

                  <div class="row text-capitalize">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?=$admin['phone']?></div>
                  </div>

                  <div class="row text-lowercase">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$admin['email']?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="includes/update_info.php" method="post" enctype="multipart/form-data">
                    <div class="row mb-3 text-capitalize">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">profile image</label>
                      <div class="col-md-8 col-lg-9">
                        
                          <img src="images/<?=$admin['profile_image']?>" alt="Profile" name="previewProfileImage" id="previewProfileImage">
                          <div class="col col-lg-6 pt-2 d-flex justify-content-between">

                            <label class="btn btn-primary btn-sm" title="Change profile image">
                              <i class="bi bi-upload"></i>
                              <input type="file" name="profileImage" id="profileImage"  accept="image/*" style="display: none">
                            </label>
                            <a href="#" class="btn btn-danger btn-sm removeProfileImage" title="Remove profile image" name="removeProfileImage" onclick="alert('Profile Picture Removed Successfull')"><i class="bi bi-trash"></i></a>
                          </div>
                        
                      </div>
                    </div>

                    <div class="row mb-3 text-capitalize">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">full name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control text-capitalize" id="fullName" value="<?=$admin['full_name']?>" title="Name should not be blank" required>
                      </div>
                    </div>

                    <div class="row mb-3 text-capitalize">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?=$admin['about']?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3 text-capitalize">
                      <label for="adminDesignation" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-select text-capitalize form-control" aria-label="Default select example" name="adminDesignation" id="adminDesignation" required>
                          <option value="<?=$admin['designation']?>" selected><?=$admin['designation']?></option>
                          <option disabled></option>
                          <?php
                          $designations = getAllAdminDesignation($db);
                          foreach($designations as $designation){
                            ?>
                            <option value="<?=$designation['name']?>"><?=$designation['name']?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3 text-capitalize">
                      <label for="country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control text-capitalize" id="country" value="<?=$admin['country']?>">
                      </div>
                    </div>

                    <div class="row mb-3 text-capitalize">
                      <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control text-capitalize" id="address" value="<?=$admin['address']?>">
                      </div>
                    </div>

                    <div class="row mb-3 text-capitalize">
                      <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control text-capitalize" id="phone" value="<?=$admin['phone']?>">
                      </div>
                    </div>

                    <div class="row mb-3 text-capitalize">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control text-lowercase" id="email" value="<?=$admin['email']?>" title="You can't change email address !" required disabled>
                      </div>
                    </div>

                    <?php
                    $socialLinkQuery = "SELECT * FROM sociallink";
                    $runSQ = mysqli_query($db, $socialLinkQuery);
                    while($socialLink = mysqli_fetch_assoc($runSQ)){
                      ?>
                      <div class="row mb-3 text-capitalize">
                        <label for="<?=$socialLink['site_title']?>" class="col-md-4 col-lg-3 col-form-label"><?=$socialLink['site_title']?></label>
                        <div class="col-md-8 col-lg-9">
                          <input name="<?=$socialLink['site_title']?>" type="text" class="form-control text-lowercase fst-italic" id="<?=$socialLink['site_title']?>" value="<?=$socialLink['site_link']?>" disabled>
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                    <input type="hidden" name="admin_id" value="<?=$admin['id']?>">
                    <div class="text-center text-capitalize border-top mt-4 pt-3">
                      <button type="submit" class="btn btn-primary text-capitalize" name="updateInfo">Update Info</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>
          
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include_once("includes/footer.php")?>
  <!-- End Footer -->

  <!-- ======= FOOT ======= -->
  <?php include_once("includes/foot.php")?>
  <!-- End FOOT -->

</body>

</html>