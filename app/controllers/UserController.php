<?php

class UserController extends BaseController{

	public function showRegister()
	{
		return View::make('register');
	}

	public function register()
	{
		$validator = Validator::make(Input::all(), array(
			'username'			=> 'required|unique:User',
			'password' 			=> 'required|same:confirmPassword',
			'confirmPassword'	=> 'required|same:password'
		));

		if ($validator->fails())
		{
			return Redirect::route('register-show')
					->withErrors($validator->errors()->add('location', 'register'))
					->withInput();
		}
		else
		{
			$username = Input::get('username');
			$password = Hash:: make(Input::get('password'));

			$create = User::create(array(
				'Username' 	=> $username,
				'Password' 	=> $password
			));

			if($create)
			{
				return Redirect::route('home');
			}
			else
			{
				return "failed register";
			}
		}
	}

	public function doLogin()
	{
		$validator = Validator::make(Input::all(), array(
			'username'	=> 'required',
			'password'	=> 'required'
		));

		if ($validator->fails())
		{
			return Redirect::route('home')
				->withErrors($validator->errors()->add('location', 'login'))
				->withInput();
		}
		else
		{
			$auth = Auth::attempt(array(
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password')
			), true);

			if($auth)
			{
				return Redirect::intended('/');
			}
			else
			{
				return Redirect::to('/')
					->with('errMessage',"Username/password invalid or not activated yet");
			}
		}
	}

	public function doLogout()
	{
		Auth::logout();
		return Redirect::route('home');
	}

}