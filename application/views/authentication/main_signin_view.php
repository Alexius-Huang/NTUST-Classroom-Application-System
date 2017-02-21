<!--#include file="meta.inc.html"-->
<title>登入 - 學生活動大樓教室借用系統</title>
<!--#include file="header.inc.html"-->
<section class="content-header">
  <h1>登入</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main_authentication/signin">學生活動大樓教室借用系統</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main_authentication/signin">登入</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-lg-6 col-md-8 col-sm-12 col-lg-offset-3 col-md-offset-2">
      <form id="form_login" action="<?php echo base_url(); ?>main_authentication/signin" role="form" method="post">
        <?php if ($signin_failure): ?>
          <div id="login_failure" class="alert alert-danger">
            <h4><i class="icon fa fa-user-times"></i> 登入失敗！</h4>
            請確認您輸入的登入資訊是否正確。
          </div>
        <?php endif; ?>
        <div class="box box-primary">
          <div class="box-body">
            <div class="col-md-12">
              <div class="form-group has-feedback">
                <input class="form-control" name="studentID" placeholder="請輸入您的學號" />
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input class="form-control has-feedback" name="password" type="password" placeholder="請輸入學生資訊系統密碼" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button id="signin-submit-btn" class="btn btn-primary">登入</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>