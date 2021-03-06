<?php
/* SVN FILE: $Id$ */
/**
 * [IpLimitter] 設定ページ
 *
 * PHP version 5
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2012, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2011 - 2012, Catchup, Inc.
 * @link			http://www.e-catchup.jp Catchup, Inc.
 * @package			ip_limitter.controllers
 * @since			Baser v 2.0.0
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			MIT lincense
 */
App::import('Controller', 'Plugins');
class IpLimitterConfigsController extends BcPluginAppController {
/**
 * コントローラー名
 * @var string
 * @access public
 */
	public $name = 'IpLimitterConfigs';
/**
 * モデル
 * @var array
 * @access public
 */
	public $uses = array('Plugin', 'IpLimitter.IpLimitterConfig');
/**
 * コンポーネント
 * 
 * @var array
 * @access public
 */
	public $components = array('BcAuth', 'Cookie', 'BcAuthConfigure');
/**
 * ぱんくずナビ
 *
 * @var string
 * @access public
 */
	public $crumbs = array(
		array('name' => 'プラグイン管理', 'url' => array('plugin' => '', 'controller' => 'plugins', 'action' => 'index')),
		array('name' => 'IPリミッター管理', 'url' => array('plugin' => 'ip_limitter', 'controller' => 'ip_limitter_configs', 'action' => 'index'))
	);
/**
 * IPリミッター設定
 */
	public function admin_index() {

		if(!$this->request->data) {
			$this->request->data = array('IpLimitterConfig' => $this->IpLimitterConfig->findExpanded());
		} else {
			$this->IpLimitterConfig->set($this->request->data);
			if($this->IpLimitterConfig->validates()) {
				$this->IpLimitterConfig->saveKeyValue($this->request->data);
				$this->setMessage('IPリミッターの設定を保存しました。', false, true);
				$this->redirect(array('action','index'));
			}
		}
		$this->pageTitle = 'IPリミッター設定';
		$this->help = 'ip_limitter_configs_index';
		$this->render('index');

	}

}