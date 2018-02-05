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
                <span> Academic Information </span>
              </div>

              <div class="section row" id="">
                <div class="col-md-6">
                  <label for="university" class="field prepend-icon">
                    <input type="text" name="university" id="university" class="gui-input" placeholder="University Name...">
                    <label for="university" class="field-icon">
                      <i class="fa fa-user"></i>
                    </label>
                  </label>
                </div>

                <div class="col-md-6">
                  <label for="career" class="field prepend-icon">
                    <input type="text" name="career" id="career" class="gui-input" placeholder="Career Name...">
                    <label for="career" class="field-icon">
                      <i class="fa fa-user"></i>
                    </label>
                  </label>
                </div>
              </div>
              
              <div class="section row" id="">
                <div class="col-md-6">
                  <label for="graduationYear" class="field prepend-icon">
                    <input type="text" id="graduationYear" name="graduationYear" class="gui-input hasDatepicker" placeholder="Graduation Year...">
                    <label class="field-icon">
                      <i class="fa fa-calendar-o"></i>
                    </label>
                  </label>
                </div>

                <div class="col-md-6">
                  <label for="file1" class="field file">
                  <span class="button btn-primary"> Choose File </span>
                  <input type="file" class="gui-file" name="upload1" id="file1" onChange="document.getElementById('uploader1').value = this.value;">
                  <input type="text" class="gui-input" id="uploader1" placeholder="Please select a file" readonly>
                </label>
                </div>
              </div>

              <div class="panel-footer text-right">
                <button type="submit" class="button btn-primary"> Done </button>
                <button type="reset" class="button"> Cancel </button>
              </div>
            </div>
          </form>
        </div>
      </div>
  </div>
</section>
