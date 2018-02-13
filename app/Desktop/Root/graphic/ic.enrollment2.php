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
                  <label for="receipt" class="field prepend-icon">
                    <input type="text" name="receipt" id="receipt" class="gui-input" placeholder="Receipt: 000-000000-000">
                    <label for="receipt" class="field-icon">
                      <i class="fa fa-credit-card"></i>
                    </label>
                  </label>
                </div>

                <div class="col-md-6">
                  <label for="carné" class="field prepend-icon">
                    <input type="text" name="carné" id="carné" class="gui-input" placeholder="16-00000-0">
                    <label for="carné" class="field-icon">
                      <i class="fa fa-user"></i>
                    </label>
                  </label>
                </div>
              </div>
                

              <div class="section row">
                <div class="col-md-6">
                  <label for="schoolYear" class="field prepend-icon">
                    <input type="text" id="schoolYear" name="schoolYear" class="gui-input hasDatepicker" placeholder="School Year">
                    <label class="field-icon">
                      <i class="fa fa-calendar-o"></i>
                    </label>
                  </label>
                  
                </div>
                <div class="col-md-6">
                  <label for="password" class="field prepend-icon">
                    <input type="password" name="password" id="password" class="gui-input" placeholder="*****************">
                    <label for="password" class="field-icon">
                      <i class="fa fa-lock"></i>
                    </label>
                  </label>
                </div>
              </div>

              <div class="section row" id="">
                <div class="col-md-4">
                  <label class="field select">
                    <select id="grade" name="grade">
                      <option value="">Grade</option>
                      <option value="">1</option>
                      <option value="">2</option>
                      <option value="">3</option>
                      <option value="">4</option>
                      <option value="">5</option>
                    </select>
                    <i class="arrow"></i>
                  </label>
                </div>

                <div class="col-md-4">
                  <label class="field select">
                    <select id="shift" name="shift">
                      <option value="">Shift</option>
                      <option value="">Morning</option>
                      <option value="">Afternoon</option>
                      <option value="">Saturday</option>
                      <option value="">Sunday</option>
                    </select>
                    <i class="arrow"></i>
                  </label>
                </div>

                <div class="col-md-4">
                  <label class="field select">
                    <select id="group" name="group">
                      <option value="">Group</option>
                      <option value="">A</option>
                      <option value="">B</option>
                      <option value="">C</option>
                    </select>
                    <i class="arrow"></i>
                  </label>
                </div>
              </div>

              

            <div class="panel-footer text-right">
              <button type="submit" class="button btn-primary"> Enroll </button>
              <button type="reset" class="button"> Cancel </button>
            </div>
          </form>
        </div>
      </div>
  </div>
</section>