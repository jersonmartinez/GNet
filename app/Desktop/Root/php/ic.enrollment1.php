<section id="content" class="table-layout animated fadeIn">
  <div class="tray tray-center">
      <div class="content-header">
        <h2>Enrollment</h2>
        <p class="lead">San Luis Beltran High School.</p>
      </div>

      <div class="admin-form theme-primary mw1000 center-block" style="padding-bottom: 175px;">
        <div class="panel heading-border">
          <form method="post" action="ic.enroll.php" id="admin-form">
            <div class="panel-body bg-light">
              <div class="section-divider mv40">
                <span> Student Information </span>
              </div>

              <div class="section row" id="spy1">
                <div class="col-md-6">
                  <label for="firstname" class="field prepend-icon">
                    <input type="text" name="firstname" id="firstname" class="gui-input" placeholder="First name...">
                    <label for="firstname" class="field-icon">
                      <i class="fa fa-user"></i>
                    </label>
                  </label>
                </div>

                <div class="col-md-6">
                  <label for="lastname" class="field prepend-icon">
                    <input type="text" name="lastname" id="lastname" class="gui-input" placeholder="Last name...">
                    <label for="lastname" class="field-icon">
                      <i class="fa fa-user"></i>
                    </label>
                  </label>
                </div>
              </div>
              
              <div class="section row" id="spy2">
                <div class="col-md-6">
                  <label for="address" class="field prepend-icon">
                  <input type="text" name="address" id="address" class="gui-input" placeholder="Address...">
                  <label for="address" class="field-icon">
                    <i class="fa fa-envelope"></i>
                  </label>
                </label>
                </div>
                <div class="col-md-6">
                  <label for="IDcard" class="field prepend-icon">
                  <input type="text" name="IDcard" id="IDcard" class="gui-input" placeholder="ID Number...">
                  <label for="IDcard" class="field-icon">
                    <i class="fa fa-user"></i>
                  </label>
                </label>
                </div>
              </div>

              <div class="section row" id="spy2">
                <div class="col-md-6">
                  <label for="useremail" class="field prepend-icon">
                  <input type="email" name="useremail" id="useremail" class="gui-input" placeholder="Email address">
                  <label for="useremail" class="field-icon">
                    <i class="fa fa-envelope"></i>
                  </label>
                </label>
                </div>

                <div class="col-md-6">
                  <label class="field select">
                    <select id="nationality" name="nationality">
                      <option value="">Select Nationality...</option>
                      <option value="EN">English</option>
                      <option value="FR">French</option>
                      <option value="SP">Spanish</option>
                      <option value="CH">Chinese</option>
                      <option value="JP">Japanese</option>
                    </select>
                    <i class="arrow double"></i>
                  </label>
                </div>
              </div>

              <div class="section-divider mv40">
                <span> Date of Birth </span>
              </div>

              <div class="section">
                <label for="datepicker1" class="field prepend-icon">
                  <input type="text" id="datepicker1" name="datepicker1" class="gui-input hasDatepicker" placeholder="Datepicker Popup">
                  <label class="field-icon">
                    <i class="fa fa-calendar-o"></i>
                  </label>
                </label>
              </div>

              <div class="section-divider mv40" id="spy5">
                <span> Sex </span>
              </div>

              <div class="section row">
                <div class="col-md-6 pad-r40 border-right">
                  <div class="option-group field">
                    <label for="male" class="option block option-primary mt10">
                      <input type="radio" name="gender" id="male" value="male">
                      <span class="radio"></span> Male
                    </label>

                  </div>
                </div>
                <div class="col-md-6 pad-r40 border-right">
                  <div class="option-group field">
                    <label for="female" class="option option-primary block">
                      <input type="radio" name="gender" id="female" value="female">
                      <span class="radio"></span> Female
                    </label>
                  </div>
                </div>
              </div>

              <div class="section-divider mv40">
                <span> Fill at least one </span>
              </div>

              <div class="section row">
                <div class="col-md-6">
                  <label for="mobile_phone" class="field prepend-icon">
                    <input type="tel" name="mobile_phone" id="mobile_phone" class="gui-input phone-group" placeholder="Mobile number">
                    <label for="mobile_phone" class="field-icon">
                      <i class="fa fa-mobile-phone"></i>
                    </label>
                  </label>
                </div>

                <div class="col-md-6">
                  <label for="home_phone" class="field prepend-icon">
                    <input type="tel" name="home_phone" id="home_phone" class="gui-input phone-group" placeholder="Home number">
                    <label for="home_phone" class="field-icon">
                      <i class="fa fa-phone"></i>
                    </label>
                  </label>
                </div>
              </div>
            </div>

            <div class="panel-footer text-right">
              <button type="submit" class="button btn-primary"> Next </button>
              <button type="reset" class="button"> Cancel </button>
            </div>
          </form>
        </div>
      </div>
  </div>
</section>
