<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
      <div class="box-body">
        <a class="btn btn-default" href="<?php echo base_url(); ?>admin/device">&laquo; 返回器材列表</a>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">新增器材</h3>
      </div>
      <div class="box-body">
        <form id="create-device-form" action="<?php echo base_url(); ?>admin/device_new" method="post">
          <div id="name-zh-TW-field" class="col-md-6 form-group rule-type fields field-name-zh-TW">
            <label for="name-zh-TW">器材中文名稱</label>
            <div class="input-group">
              <div class="input-group-addon"><?php echo render_icon('pencil'); ?></div>
              <input type="text" id="name-zh-TW" name="name_zh-TW" class="form-control" />
            </div>
          </div>

          <div id="name-en-us-field" class="col-md-6 form-group rule-type fields field-name-en-us">
            <label for="name-en-us">器材英文名稱</label>
            <div class="input-group">
              <div class="input-group-addon"><?php echo render_icon('pencil'); ?></div>
              <input type="text" id="name-en-us" name="name_en-us" class="form-control" />
            </div>
          </div>

          <div id="total-count-field" class="col-md-6 form-group rule-type fields field-total-count">
            <label for="total-count">器材總數量</label>
            <div class="input-group">
              <div class="input-group-addon"><?php echo render_icon('sort-numeric-asc'); ?></div>
              <input type="text" id="total-count" name="total_count" class="form-control" />
            </div>
          </div>

          <div id="max-lease-count-field" class="col-md-6 form-group rule-type fields field-max-lease-count">
            <label for="max-lease-count">單次最大借用數量</label>
            <div class="input-group">
              <div class="input-group-addon"><?php echo render_icon('tasks'); ?></div>
              <input type="text" id="max-lease-count" name="max_lease_count" class="form-control" />
            </div>
          </div>
          
          <div id="remark-field" class="col-md-12 form-group rule-type fields field-remark">
            <label for="remark">備註</label>
            <div class="input-group">
              <div class="input-group-addon"><?php echo render_icon('flag'); ?></div>
              <input type="text" id="remark" name="remark" class="form-control" />
            </div>
          </div>
          
        </form>
      </div>
    </div>

    <div class="box-footer">
      <button id="create-new-device" class="btn btn-primary"><?php echo render_icon('plus'); ?> 新增規則</button>
    </div>

    <?php $this->load->view('admin/js/device_new_js.php'); ?>
  </div>
</div> 
