<?php if ($notice_updated): ?>
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-fw fa-check"></i> 儲存成功！</h4>
    申請須知已儲存完畢。
</div>
<?php endif; ?>
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">編輯<strong>「場地借用」</strong>申請須知</h3>
      </div><!-- /.box-header -->
      <form role="form" action="<?php echo base_url(); ?>admin/notice_edit" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="classroom-textarea-zh-tw">正體中文</label>
            <textarea class="form-control" id="classroom-textarea-zh-tw" name="classroom-zh-tw" placeholder="請輸入中文版場地申請須知。" rows="24"><?php echo htmlentities($classroom_notice['zh-tw']); ?></textarea>
          </div><!-- /.form-group -->
          <div class="form-group">
            <label for="classroom-textarea-en-us">English</label>
            <textarea class="form-control" id="classroom-textarea-en-us" name="classroom-en-us" placeholder="請輸入英文版場地申請須知。" rows="24"><?php echo htmlentities($classroom_notice['en-us']); ?></textarea>
          </div><!-- /.form-group -->
        </div><!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-primary" type="submit"><?php echo render_icon('save'); ?> 儲存場地借用申請須知</button>
        </div><!-- /.box-footer -->
      </form><!-- /.form -->
    </div><!-- /.box -->
  </div>

  <?php $this->load->view('admin/js/notice_edit_js'); ?>
</div>