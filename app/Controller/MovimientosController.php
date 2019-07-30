<?php
App::uses('AppController', 'Controller');
/**
 * Movimientos Controller
 *
 * @property Movimiento $Movimiento
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class MovimientosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

	public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('add','edit','delete');
        $this->Auth->deny('index','add','edit','delete');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Movimiento->recursive = 0;
		$this->set('movimientos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Movimiento->exists($id)) {
			throw new NotFoundException(__('Invalid movimiento'));
		}
		$options = array('conditions' => array('Movimiento.' . $this->Movimiento->primaryKey => $id));
		$this->set('movimiento', $this->Movimiento->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Movimiento->create();
			if ($this->Movimiento->save($this->request->data)) {
				return $this->Flash->success(__('The movimiento has been saved.'));
			} else {
				$this->Flash->error(__('The movimiento could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Movimiento->exists($id)) {
			throw new NotFoundException(__('Invalid movimiento'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Movimiento->save($this->request->data)) {
				$this->Flash->success(__('The movimiento has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The movimiento could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Movimiento.' . $this->Movimiento->primaryKey => $id));
			$this->request->data = $this->Movimiento->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Movimiento->id = $id;
		if (!$this->Movimiento->exists()) {
			throw new NotFoundException(__('Invalid movimiento'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Movimiento->delete()) {
			$this->Flash->success(__('The movimiento has been deleted.'));
		} else {
			$this->Flash->error(__('The movimiento could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
