<title>申請借用 - 學生活動中心場地借用系統</title>
<section class="content-header">
  <h1>申請借用</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main/apply_new/zh-TW">學生活動中心場地借用系統</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main/apply_new/zh-TW">申請借用</a></li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <form id="form_apply" role="form">
      
        <?php if ($apply_failure): ?>
          <div id="apply_failure" class="alert alert-danger">
            <h4><i class="icon fa fa-user-times"></i> 申請失敗！</h4>
            請確認您輸入的申請資訊是否正確。
          </div>
        <?php endif; ?>
        
        <div class="box box-primary">
          <div class="box-body">
            <div class="row">

              <!-- Select Classroom -->
              <div class="col-md-6 form-group">
                <label for="classroom">場地：</label>
                <div class="input-group">
                  <div class="input-group-addon"><?php echo render_icon('map-marker'); ?></div>
                  <select id="classroom" name="classroom_id" class="form-control">
                    <option value="0">請選擇場地</option>
                    <?php foreach ($classroom_available as $classroom): ?>
                      <option value="<?php echo $classroom['id']; ?>"><?php echo $classroom['name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <!-- Select Date -->
              <div class="col-md-6 form-group">
                <label for="date">日期：</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
                  <input id="date" name="date" class="form-control" required />
                </div>
              </div>

              <!-- Select Time -->
              <div class="col-md-12 form-group row">
                <div class="col-md-12">
                  <label>時段：（審核中時段將以藍色標記，紅色為不開放時段，橘色為該時段已有他人借用）</label>
                </div>
                <div class="col-md-12">
                  <div class="input-group btn-group" id="time-field" data-toggle="buttons">
                    <?php foreach($timeArray as $time => $interval): ?>
                      <label class="btn btn-flat btn-default" id="time<?php echo $time; ?>">
                        <input type="checkbox" name="times[]" id="time<?php echo $time; ?>" value="<?php echo $time; ?>" />
                        <span class="label-time-name"><?php echo $time; ?></span>
                        <span class="label-time-period"><?php echo $interval; ?></span>
                      </label>
                    <?php endforeach; ?>
                    <a class="btn btn-flat btn-info btn-select-none" id="cancel-all-time-btn">全部取消</a>
                  </div>
                </div>
              </div>

              <!-- Input Organization -->
              <div class="col-md-4 form-group">
                <label for="organization">單位（社團）名稱：</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-university"></i></div>
                  <input id="organization" name="organization" class="form-control" required />
                </div>
              </div>

              <!-- Input Applicant -->
              <div class="col-md-4 form-group">
                <label for="applicant">申請人姓名：</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></div>
                  <input id="applicant" name="applicant" class="form-control" required />
                </div>
              </div>

              <!-- Input Applicant Position -->
              <div class="col-md-4 form-group">
                <label for="applicant">申請人單位（社團）職稱：</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
                  <input id="applicant-position" name="applicant-position" class="form-control" required />
                </div>
              </div>

              <!-- Input Applicant's phone number -->
              <div class="col-md-6 form-group">
                <label for="phone">申請人聯絡電話：</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                  <input id="phone" name="phone" class="form-control" required />
                </div>
              </div>

              <!-- Input Venue's participant count number -->
              <div class="col-md-6 form-group">
                <label for="phone">場地人數：</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-users"></i></div>
                  <input id="participant-count" name="participant-count" class="form-control" required />
                </div>
              </div>

              <!-- Input apply purpose -->
              <div class="col-md-12 form-group">
                <label for="phone">場地借用目的（請簡述）：</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-tasks"></i></div>
                  <input id="purpose" name="purpose" class="form-control" required />
                </div>
              </div>
            </div>
          </div>

          <div class="box-footer">
            <button id="application-submit-btn" class="btn btn-primary">送出申請</button>
          </div>

          <?php $this->load->view('main/js/apply_new_js', array('lang' => $lang)); ?>
        </div>
      </form>
    </div>
  </div>
</section>
