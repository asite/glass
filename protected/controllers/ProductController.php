<?php

class ProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public $defaultAction = 'admin';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create', 'update' , 'cart', 'clearcart', 'removeitem', 'addorder'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Product;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Product'])) {
			$model->attributes = $_POST['Product'];
			if ($model->save()) {
				$this->redirect(array('cart'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$model->save();
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Displays tha cart page
	 * @param integer $pid - product's ID
	 */
	public function actionCart($pid = false, $mark = false, $model = false, $modification = false, $modifid = false)
	{
		if (Yii::app()->request->isAjaxRequest) { // учитывать AjaxValidation формы

		    $product = Product::getProd($pid);

		    $_SESSION['orders'][$pid] = array(
		    	'pid' => $pid,
		    	'mark' => $mark,
		    	'model' => $model,
		    	'modification' => $modification,
		    	'modifid' => $modifid,
		    	'price' => $product['price']
		    );

  			Yii::app()->end();
		}

		$model = new Order;

		$this->render('cart', array(
			'model' => $model,
		));
	}

	/**
	 * Очистка сессионных данных для корзины
	 */
	public function actionClearcart()
	{
		unset($_SESSION['orders']);
		$this->redirect(array('cart'));
	}

	/**
	 * Удаление товара из корзины
	 */
	public function actionRemoveitem($pid)
	{
		if (Yii::app()->request->isAjaxRequest == true) {
		    unset($_SESSION['orders'][$pid]);
		    
		    if (empty($_SESSION['orders'])) {
				unset($_SESSION['orders']);
		    }
		    
		    Yii::app()->end();
		}
	}

	/**
	 * Добавление заказа в базу
	 */
	public function actionAddorder()
	{
		$id = Order::getLastId();
exit(var_dump($_POST));
		if ($id)
		{
			$id = current($id) + 1;
		}
		else
		{
			$id = 1;
		}

		foreach ($_POST as $key => $value)
		{
			if (substr($key, 0, 3) === 'pid')
			{
				$product = Product::getProd($value);
				$model = new OrderList;

				$model->attributes = array(
					'order_id' => $id,
					'product_id' => $value,
					'product_price' => $product['price'],
					'modification_id' => $_SESSION['orders'][$value]['modifid'],
					'mounting' => '0'
				);
				$model->save();
			}
		}

		Order::createOrder(
			$id,
			$_POST['Order']['mounting'],
			$_POST['Order']['clientname'],
			$_POST['Order']['phone'],
			$_POST['Order']['address'],
			$_POST['Order']['date'],
			$_POST['Order']['time'],
			date('d.m.Y H:i:s', time())
		);

		$this->redirect(array('clearcart'));
	}
}
