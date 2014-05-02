<?php
App::uses('BannerAppModel', 'Banner.Model');
/**
 * Banner Model
 *
 */
class Banner extends BannerAppModel
{
    /**
     * Define Custom Find Type
     *
     * With this we'll have all published banners
     *
     * @var array
     */
    public $findMethods = array('published' =>  true);

    /**
     * Define Behaviors
     *
     * Translatable => means we can translate things!
     * Upload => The cover image for this cuisine
     *
     * @var array
     */
    public $actsAs = array(
        'Translate' => array(
            'title',
            'description'
        ),
        'Upload.Upload' => array(
            'image'
        )
    );

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'link' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'target' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'published' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'removed' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	/**
	 * beforeFind callback
	 *
	 * @param $query array
	 * @return mixed
	 */
	public function beforeFind($query) {

		if (!empty($query['conditions'])) {
			if (!is_array($query['conditions'])) {
				$query['conditions'] = array($query['conditions']);
			}
		} else {
			$query['conditions'] = array();
		}

		$query['conditions']['Banner.removed'] = false;

		if (!empty($query['order'])) {
			if (!is_array($query['order'])) {
				$query['order'] = array($query['order']);
			}
		} else {
			$query['order'] = array();
		}

		$query['order'][] = 'Banner.position ASC';

		return $query;
	}

    protected function _findPublished($state, $query, $results = array()) {
        if ($state === 'before') {
            $query['conditions']['Banner.published'] = true;
            return $query;
        }
        return $results;
    }

}
