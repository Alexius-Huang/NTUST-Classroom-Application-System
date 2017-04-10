<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      
      <div class="box-header">
        <h3 class="box-title">檢視與修改器材設定</h3>
        <a href="<?php echo base_url(); ?>admin/device_new" class="btn btn-success pull-right"><?php echo render_icon('plus'); ?>新增器材</a>
      </div>

      <div class="box-body">
        <table id="dataset" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <?php foreach ($table_columns as $column): ?>
                <th><?php echo $column['name']; ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach($devices as $device): ?>
              <tr id="row-<?php echo $device['id']; ?>">
                <td><?php echo $device['id']; ?></td>
                <td><?php echo $device['name_zh-TW']; ?> (<?php echo $device['name_en-us'] ?>)</td>
                <td <?php if ($device['disabled'] == 0) { echo 'class="label-primary"'; } ?> id="state-<?php echo $device['id']; ?>">
                  <?php echo ($device['disabled'] == 0 ? render_icon('eye').' 已啟用' : render_icon('eye-slash').' 停用中'); ?>
                </td>
                <td>
                  <span data-id="<?php echo $device['id']; ?>"
                        data-type="switch"
                        data-state="<?php echo $device['disabled']; ?>"
                        data-total="<?php echo $device['total_count']; ?>"
                        data-max="<?php echo $device['max_lease_count']; ?>"
                        data-device="<?php echo $device['name_zh-TW']; ?> (<?php echo $device['name_en-us']; ?>)"
                        class="btn btn-sm btn-<?php echo ($device['disabled'] == 0 ? 'danger' : 'primary'); ?>">
                    <?php echo ($device['disabled'] == 0 ? render_icon('toggle-on').' 停用' : render_icon('toggle-off').' 啟用') ?>
                  </span>
                </td>
                <td>
                  <span data-id="<?php echo $device['id']; ?>" data-type="edit-name" data-zhTW="<?php echo $device['name_zh-TW']; ?>" data-enus="<?php echo $device['name_en-us']; ?>" class="btn btn-sm btn-primary"><?php echo render_icon('pencil'); ?> 器材更名</span>
                  <span data-id="<?php echo $device['id']; ?>" data-type="edit" class="btn btn-sm btn-primary"><?php echo render_icon('sliders'); ?> 詳細設定</span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <style>
          #dataset .btn { display: inline }
          th, td { text-align: center; }
        </style>
        <?php $this->load->view('admin/js/device_js.php'); ?>
      </div>
    </div>
  </div>
</div>