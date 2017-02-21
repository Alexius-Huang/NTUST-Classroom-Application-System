<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
      <div class="box-body">
        <a class="btn btn-default" href="<?php echo base_url(); ?>admin/classroom">&laquo; 返回場地列表</a>
        <a class="btn btn-primary pull-right" href="<?php echo base_url().'admin/classroom_rule_create/'.$classroom['id']; ?>">新增規則至場地：<?php echo $classroom['name'] ?> &raquo</a>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">以下為所有「<?php echo $classroom['name']; ?>」場地的不開放規則</h3>
        <span data-classroom="<?php echo $classroom['name']; ?>" data-id="<?php echo $classroom['id']; ?>" class="btn btn-sm btn-danger pull-right" id="delete-all-rules"><?php echo render_icon('trash'); ?> 刪除此場地之所有規則</span>
      </div>
      <div class="box-body">
        <table id="rules" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="hidden-xs">ID</th>
              <th class="text-center"><span class="hidden-xs">規則</span>類型</th>
              <th class="text-center">日期</th>
              <th class="text-center">星期</th>
              <th class="text-center">時段</th>
              <th>刪除</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($classroom_rules as $rule): ?>
              <tr>
                <td><?php echo $rule['id']; ?></td>
                <td class="text-center"><?php echo classroom_rule_type($rule['type'], TRUE); ?></td>
                <td class="text-center"><?php echo classroom_rule_display_date($rule['start'], $rule['end']); ?></td>
                <td class="text-center"><?php echo classroom_rule_display_weekday($rule['weekday']); ?></td>
                <td class="text-center"><?php echo classroom_rule_display_time($rule); ?></td>
                <td>
                  <span
                    class="btn btn-xs btn-danger delete-classroom-rule"
                    data-id="<?php echo $rule['id']; ?>"
                    data-classroom="<?php echo $classroom['name']; ?>"
                    data-ruletype="<?php echo classroom_rule_type($rule['type']); ?>"
                    data-date="<?php echo classroom_rule_display_date($rule['start'], $rule['end']); ?>"
                    data-weekday="<?php echo classroom_rule_display_weekday($rule['weekday']); ?>"
                    data-time="<?php echo classroom_rule_display_time($rule); ?>"
                  ><?php echo render_icon('trash'); ?> 刪除此規則</span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <?php $this->load->view('admin/js/classroom_edit_js.php'); ?>
  </div>
</div> 
