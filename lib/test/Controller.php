<?php

namespace test;

class Controller
{
	protected $tpl;
	protected $req;
	private $_action='/';

	public function __construct()
	{
		$this->tpl = S('Template');
		$this->req = S('Request');
		$this->_action = $this->req->getDir(0);

		if( ($this->_action == 'brand1') || ($this->_action == 'brand2') )
		{
			$this->tpl->setGlob('baseurl', '/'.$this->_action);
		}
		else
		{
			$this->tpl->setGlob('baseurl', '');
		}

		session_start();

		$this->_performChecks();
	}

	protected function _subscribe()
	{
		$_SESSION['subs'][$this->_action] = 1;
	}

	protected function _unsubscribe()
	{
		$_SESSION['subs'][$this->_action] = 0;
	}

	private function _isSubscribed()
	{
		return isset($_SESSION['subs'][$this->_action]) ? true : false;
	}

	private function _performChecks()
	{
		$action = S('Request')->getDir(0);
		if( $action == 'brand1' )
		{
			$action = S('Request')->getDir(1);
		}

		if( !$this->_isSubscribed() && ($action != 'subscribe') )
		{
			Response::redirect('/subscribe');
		}
	}
}
