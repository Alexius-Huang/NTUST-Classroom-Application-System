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
        <span data-classroom="<?php echo $classroom['name']; ?>" class="btn btn-sm btn-danger pull-right" id="delete-all-rules"><?php echo render_icon('trash'); ?> 刪除此場地之所有規則</span>
      </div>
      <div class="box-body">
        
      </div>
    </div>

    <?php $this->load->view('admin/js/classroom_edit_js.php'); ?>
  </div>
</div> 
