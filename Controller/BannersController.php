<?php
App::uses('BannerAppController', 'Banner.Controller');
/**
 * Banners Controller
 *
 */
class BannersController extends BannerAppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->set('banners', $this->Banner->find('all'));
    }

    /**
     * admin_view method
     *
     * @param string $id Banner ID
     *
     * @throws NotFoundException
     * @return void
     */
    public function admin_view($id = null)
    {
        if (!$this->Banner->exists($id)) {
            throw new NotFoundException(__('Invalid banner'));
        }
        $options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
        $this->set('banner', $this->Banner->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->Banner->create();
            if ($this->Banner->save($this->request->data)) {
                $this->Session->setFlash(__('The banner has been saved.'));
                return $this->redirect(array('action' => 'view', $this->Banner->id));
            } else {
                $this->Session->setFlash(__('The banner could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * admin_select method
     *
     * @param string $id Banner ID
     *
     * @throws NotFoundException
     * @return void
     */
    public function admin_select($id = null)
    {
        if (!$this->Banner->exists($id)) {
            throw new NotFoundException(__('Invalid banner'));
        }

        $banner = $this->Banner->findById($id, array('published'));
        $this->Banner->id = $id;
        if ($this->Banner->saveField('published', !$banner['Banner']['published'])) {
            $this->Session->setFlash(__('The banner has been saved.'));
        } else {
            $this->Session->setFlash(__('The banner could not be saved. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    /**
     * admin_order method
     *
     * @return void
     */
    public function admin_order()
    {
		$this->layout = "ajax";
		$order = $_POST['banner'];
		$banners = array();
		foreach ($order as $position => $banner) {
			$banners[] = array(
				'id' => $banner,
				'position' => $position
			);
		}

		$status = $this->Banner->saveMany($banners, array("validate" => "first"));

		if ($status) {
			$status = "success";
		}

		$this->set('response', array('status' => $status));
    }

    /**
     * admin_edit method
     *
     * @param string $id Banner ID
     *
     * @throws NotFoundException
     * @return void
     */
    public function admin_edit($id = null)
    {
        if (!$this->Banner->exists($id)) {
            throw new NotFoundException(__('Invalid banner'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->Banner->set($this->request->data);
            if ($this->Banner->validates()) {
                if ($this->Banner->save($this->request->data)) {
                    $this->Session->setFlash(__('The banner has been saved.'));
                    return $this->redirect(array('action' => 'view', $id));
                } else {
                    $this->Session->setFlash(__('The banner could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The banner could not be saved. Please, try again.'));
            }

        } else {
            $options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
            $this->request->data = $this->Banner->find('first', $options);
        }
    }

    /**
     * admin_delete method
     *
     * @param string $id Banner ID
     *
     * @throws NotFoundException
     * @return void
     */
    public function admin_delete($id = null)
    {
        $this->Banner->id = $id;
        if (!$this->Banner->exists()) {
            throw new NotFoundException(__('Invalid banner'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Banner->saveField('removed', true)) {
            $this->Session->setFlash(__('The banner has been deleted.'));
        } else {
            $this->Session->setFlash(__('The banner could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
