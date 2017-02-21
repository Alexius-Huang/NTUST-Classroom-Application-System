<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      
      <div class="box-header">
        <h3 class="box-title">檢視與修改場地設定</h3>
      </div>

      <div class="box-body">
        
          <div class="form-group">
            <label for="place-name">新增場地</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
              <input id="classroom-name" name="name" class="form-control" placeholder="請輸入場地名稱" />
              <div class="input-group-btn">
                <button id="add-classroom" class="btn btn-primary">新增場地</button>
              </div>
            </div>
          </div>
      
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
            <?php foreach($classrooms as $classroom): ?>
              <tr id="row-<?php echo $classroom['id']; ?>">
                <td><?php echo $classroom['id']; ?></td>
                <td><?php echo $classroom['name']; ?></td>
                <td <?php if ($classroom['disabled'] == 0) { echo 'class="label-primary"'; } ?> id="state-<?php echo $classroom['id']; ?>">
                  <?php echo ($classroom['disabled'] == 0 ? render_icon('eye').' 已啟用' : render_icon('eye-slash').' 停用中'); ?>
                </td>
                <td>
                  <span data-id="<?php echo $classroom['id']; ?>"
                        data-type="switch"
                        data-state="<?php echo $classroom['disabled']; ?>"
                        data-classroom="<?php echo $classroom['name']; ?>"
                        class="btn btn-sm btn-<?php echo ($classroom['disabled'] == 0 ? 'danger' : 'primary'); ?>">
                    <?php echo ($classroom['disabled'] == 0 ? render_icon('toggle-on').' 停用' : render_icon('toggle-off').' 啟用') ?>
                  </span>
                </td>
                <td>
                  <span data-id="<?php echo $classroom['id']; ?>" data-type="edit-name" data-classroom="<?php echo $classroom['name']; ?>" class="btn btn-sm btn-primary"><?php echo render_icon('pencil'); ?> 場地更名</span>
                  <span data-id="<?php echo $classroom['id']; ?>" data-type="edit" class="btn btn-sm btn-primary"><?php echo render_icon('sliders'); ?> 詳細設定</span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <style>
          #dataset .btn { display: inline }
          th, td { text-align: center; }
        </style>
        <?php $this->load->view('admin/js/classroom_js.php'); ?>
      </div>
    </div>
  </div>
</div>