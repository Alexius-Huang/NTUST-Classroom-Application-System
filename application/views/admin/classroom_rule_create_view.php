<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
      <div class="box-body">
        <a class="btn btn-default" href="<?php echo base_url(); ?>admin/classroom">&laquo; 返回場地列表</a>
        <?php if ($classroom != '全部的場地'): ?>
          <a class="btn btn-primary pull-right" href="<?php echo base_url().'admin/classroom_edit/'.$classroom['id']; ?>">檢視此場地所有規則 &raquo</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <?php if ($classroom != '全部的場地'): ?>
        <h3 class="box-title">新增不開放規則至場地「<?php echo $classroom['name']; ?>」</h3>
        <?php else: ?>
        <h3 class="box-title">新增不開放規則至全部的場地</h3>
        <?php endif; ?>
        <p>若規則有衝突到場地申請，則<span style="color: red">自動駁回所有衝突之場地申請項目</span></p>
      </div>
      <div class="box-body">
        
        <?php if ($classroom != '全部的場地'): ?>
        <form id="create-new-rule-form" action="<?php echo base_url(); ?>admin/classroom_rule_create/<?php echo $classroom['id']; ?>" method="post">
        <?php else: ?>
        <form id="create-new-rule-form" action="<?php echo base_url(); ?>admin/classroom_rule_create_to_all" method="post">
        <?php endif; ?>  
          
          <div class="col-md-12 form-group fields field-rule-type">
            <label>規則類型</label>
            <div class="input-group btn-group" data-toggle="buttons">
              <label class="btn btn-default active">
                <input type="radio" name="rule-type" value="0" checked />
                <?php echo render_icon("calendar-o"); ?> 單日不開放
              </label>
              <label class="btn btn-default">
                <input type="radio" name="rule-type" value="1" />
                <?php echo render_icon('calendar'); ?> 連續不開放
              </label>
              <label class="btn btn-default">
                <input type="radio" name="rule-type" value="2" />
                <?php echo render_icon('calendar-check-o'); ?> 依星期不開放
              </label>
            </div>
          </div>
          <div id="date-field" class="col-md-12 form-group rule-type fields field-date">
            <label for="date">日期</label>
            <div class="input-group">
              <div class="input-group-addon"><?php echo render_icon('calendar'); ?></div>
              <input id="date" name="date" class="form-control" />
            </div>
          </div>
          <div id="start-date-field" class="col-md-6 form-group rule-type fields field-date-start">
            <label for="date-start">開始日期</label>
            <div class="input-group">
              <div class="input-group-addon"><?php echo render_icon('calendar'); ?></div>
              <input id="date-start" name="date-start" class="form-control" />
            </div>
          </div>
          <div id="end-date-field" class="col-md-6 form-group rule-type fields field-date-end">
            <label for="date-end">結束日期</label>
            <div class="input-group">
              <div class="input-group-addon"><?php echo render_icon('calendar'); ?></div>
              <input id="date-end" name="date-end" class="form-control" />
            </div>
          </div>
          <div id="weekday-field" class="col-md-12 form-group rule-type fields field-weekdays">
            <label>選擇星期</label>
            <div class="input-group btn-group" data-toggle="buttons">
              <?php $renderWeekday = array('日', '一', '二', '三', '四', '五', '六'); ?>
              <?php for ($i = 0; $i <= 6; $i++): ?>
                <label class="btn btn-default">
                  <input type="checkbox" name="weekday[]" value="<?php echo $renderWeekday[$i]; ?>" /> <?php echo $renderWeekday[$i]; ?>
                </label>
              <?php endfor; ?>
              <a id="weekday-cancel-all" class="btn btn-info btn-select-none">全部取消</a>
            </div>
          </div>
          <div id="time-field" class="col-md-12 form-group rule-type fields field-times">
            <label>選擇時段</label>
            <div class="input-group btn-group" data-toggle="buttons">
              <?php foreach (CLASSROOM_TIME_ARRAY_KEYS as $time): ?>
                <label class="btn btn-default">
                  <input type="checkbox" name="time[]" value="<?php echo $time; ?>" /> <?php echo $time; ?>
                </label>
              <?php endforeach; ?>
              <a id="time-cancel-all" class="btn btn-info btn-select-none">全部取消</a>
            </div>
          </div>

          <div id="purpose-field" class="col-md-12 form-group">
            <label>原由</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></div>
              <input id="purpose" name="purpose" class="form-control" required />
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="box-footer">
      <button id="create-new-rule" class="btn btn-primary"><?php echo render_icon('plus'); ?> 新增規則</button>
    </div>

    <?php $this->load->view('admin/js/classroom_rule_create_js.php'); ?>
  </div>
</div> 
