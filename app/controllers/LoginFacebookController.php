<?php

class LoginFacebookController extends \BaseController {

	private $fb;
	
	public function __construct(FacebookHelper $fb) {
	
		$this->fb = $fb;
	}
	
	public function login(){
		return Redirect::to($this->fb->getUrlLogin(Config::get('facebook.app_scope')));
	}
	
	public function callback(){
		
		// Imprimir el token que viene de facebook
		//dd(Input::all());
		
		if( !$this->fb->generateSessionFromRedirect()) {
			//tidak ada session
			return Redirect::to('/')->with('message','Error de conectarse con facebook');
		
		}
		
		//dd($this->fb->getGraph());
		
		$user_fb = $this->fb->getGraph();
		
		if (empty($user_fb)) {
			return Redirect::to('/')->with('message','Facebook');
		
		}
		
		$user = User::whereUidFB($user_fb->getProperty('id'))->first();
		
		if(empty($user)) {
			$user = new User;
			$user->email = $user_fb->getProperty('email');
			$user->name = $user_fb->getProperty('name');
			$user->birthday = date(strtotime($user_fb->getProperty('birthday')));
			$user->photo = 'http://graph.facebook.com/' . $user_fb->getProperty('id'). '/picture?type=large';
			$user->uid_fb = $user_fb->getProperty('id');

			$user->save();
		}
		
		$user->access_token_fb = $this->fb->getToken();
		$user->save();
		
		Auth::login($user);
		
		return Redirect::to('/')->with('message','Login');

	}

}
