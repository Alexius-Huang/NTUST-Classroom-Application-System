<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_reject_info_to_device_apply_table extends CI_Migration {

  function up() {
    $fields = array(
      'reject_info_zh-TW' => array(
        'after'   => 'purpose',
        'null'    => TRUE,
        'default' => NULL,
        'type'    => 'TEXT'
      ),
      'reject_info_en-us' => array(
        'after'   => 'reject_info_zh-TW',
        'null'    => TRUE,
        'default' => NULL,
        'type'    => 'TEXT'
      )
    );
    $this->dbforge->add_column('DeviceApply', $fields);
    echo '<p>Migration Created : 20170424142800_add_reject_info_to_device_apply_table</p>';
  }

  function down() {
    $this->dbforge->drop_column('DeviceApply', 'end_date');
    echo '<p>Migration Dropped : 20170424142800_add_reject_info_to_device_apply_table</p>';
  }

}