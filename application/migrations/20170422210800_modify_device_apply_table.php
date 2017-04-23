<?php defined('BASEPATH') OR exit('No direct script access allowed!');

class Migration_Modify_device_apply_table extends CI_Migration {

  function up() {
    $fields = array(
      'end_date' => array(
        'after' => 'date',
        'type' => 'DATE'
      )
    );
    $this->dbforge->add_column('DeviceApply', $fields);
    echo '<p>Migration Created : 20170422210800_modify_device_apply_table</p>';
  }

  function down() {
    $this->dbforge->drop_column('DeviceApply', 'end_date');
    echo '<p>Migration Dropped : 20170422210800_modify_device_apply_table</p>';
  }

}