<?php
class BannerSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $banners = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'Registry ID'),
		'image' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Image file name', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Banner name', 'charset' => 'utf8'),
		'position' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 1, 'comment' => 'Banner position'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Banner text', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'utf8_general_ci', 'comment' => 'Banne description', 'charset' => 'utf8'),
		'link' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Banner target link', 'charset' => 'utf8'),
		'target' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 6, 'collate' => 'utf8_general_ci', 'comment' => 'Opens in a new window ?', 'charset' => 'utf8'),
		'published' => array('type' => 'boolean', 'null' => false, 'default' => null, 'comment' => 'Is the banner published'),
		'removed' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'Was the banner removed'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => 'Date the banner was created'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => 'Date the banner was modified'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

}
