<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'verification_code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 250, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'last_email_sent' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'verification_code' => 'Lorem ipsum dolor sit amet',
			'last_email_sent' => '2012-04-20 14:56:21',
			'created' => '2012-04-20 14:56:21',
			'modified' => '2012-04-20 14:56:21',
			'status' => 1
		),
		array(
			'id' => 2,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'verification_code' => 'Lorem ipsum dolor sit amet',
			'last_email_sent' => '2012-04-20 14:56:21',
			'created' => '2012-04-20 14:56:21',
			'modified' => '2012-04-20 14:56:21',
			'status' => 1
		),
		array(
			'id' => 3,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'verification_code' => 'Lorem ipsum dolor sit amet',
			'last_email_sent' => '2012-04-20 14:56:21',
			'created' => '2012-04-20 14:56:21',
			'modified' => '2012-04-20 14:56:21',
			'status' => 1
		),
		array(
			'id' => 4,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'verification_code' => 'Lorem ipsum dolor sit amet',
			'last_email_sent' => '2012-04-20 14:56:21',
			'created' => '2012-04-20 14:56:21',
			'modified' => '2012-04-20 14:56:21',
			'status' => 1
		),
		array(
			'id' => 5,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'verification_code' => 'Lorem ipsum dolor sit amet',
			'last_email_sent' => '2012-04-20 14:56:21',
			'created' => '2012-04-20 14:56:21',
			'modified' => '2012-04-20 14:56:21',
			'status' => 1
		),
		array(
			'id' => 6,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'verification_code' => 'Lorem ipsum dolor sit amet',
			'last_email_sent' => '2012-04-20 14:56:21',
			'created' => '2012-04-20 14:56:21',
			'modified' => '2012-04-20 14:56:21',
			'status' => 1
		),
		array(
			'id' => 7,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'verification_code' => 'Lorem ipsum dolor sit amet',
			'last_email_sent' => '2012-04-20 14:56:21',
			'created' => '2012-04-20 14:56:21',
			'modified' => '2012-04-20 14:56:21',
			'status' => 1
		),
		array(
			'id' => 8,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'verification_code' => 'Lorem ipsum dolor sit amet',
			'last_email_sent' => '2012-04-20 14:56:21',
			'created' => '2012-04-20 14:56:21',
			'modified' => '2012-04-20 14:56:21',
			'status' => 1
		),
		array(
			'id' => 9,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'verification_code' => 'Lorem ipsum dolor sit amet',
			'last_email_sent' => '2012-04-20 14:56:21',
			'created' => '2012-04-20 14:56:21',
			'modified' => '2012-04-20 14:56:21',
			'status' => 1
		),
		array(
			'id' => 10,
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'verification_code' => 'Lorem ipsum dolor sit amet',
			'last_email_sent' => '2012-04-20 14:56:21',
			'created' => '2012-04-20 14:56:21',
			'modified' => '2012-04-20 14:56:21',
			'status' => 1
		),
	);
}
