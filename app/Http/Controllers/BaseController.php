<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\MobileApiException;

/**
 * Description of BaseController
 *
 * @author Artem
 */
class BaseController extends Controller
{
    
    protected function checkAccess() {
        if (!Auth::check()) {
            throw new MobileApiException("You're not authorized yet", MobileApiException::ERROR_NOT_AUTHORIZED);
        }
        
        return Auth::user();
    }
    
    protected function getData($request) {
        if (!$request instanceof Request) {
            throw new MobileApiException("Bad request data", MobileApiException::ERROR_SERVER);
        }
        
        $email = $request->input('email');
        $password = $request->input('password');
        
        $nickname = $request->input('nick');
        $userPic = Request::file('userPic');
        
        // TODO : delete var dump
        if (!is_null($userPic)) {
            var_dump($userPic);
            exit;
        }
        
        if (!isset($email) || $email === NULL) {
            throw new MobileApiException("Email is required", MobileApiException::ERROR_NOT_DATA_RECEIVED);
        }
        
        if (!isset($password) || $password === NULL) {
            throw new MobileApiException("Password is required", MobileApiException::ERROR_NOT_DATA_RECEIVED);
        }
        
        return compact('email', 'password', 'nickname', 'userPic');
    }
    
}
