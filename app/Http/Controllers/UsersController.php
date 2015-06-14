<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MobileApiException;
use Illuminate\Http\Request;

/**
 * Description of UsersController
 *
 * @author Artem
 */
class UsersController extends Controller
{
    
    public function index() {
        return response()->json(['asd' => 'qwe']);
    }
    
    public function login(Request $request) {
        try {
            $email = $request->input('email');
            $token = $request->input('token');
            
            $response = [
                'error' => MobileApiException::ErrorNoneToArray(),
                'data' => ['token' => $token, 'received' => $email]
            ];
            
        } catch (MobileApiException $ex) {
            $response = $ex->toArray();
        } catch (Exception $ex) {
            $response = MobileApiException::ServerErrorToArray($ex);
        } finally {
            return response()->json($response);
        }
    }
    
    public function logout() {
        return response()->json(['action' => 'logout']);
    }
    
    public function signUp(Request $request) {
        try {
            $data = $this->getData($request);
            
            $response = [
                'error' => MobileApiException::ErrorNoneToArray(),
                'data' => ['token', 'received' => $data]
            ];
            
        } catch (MobileApiException $ex) {
            $response = $ex->toArray();
        } catch (Exception $ex) {
            $response = MobileApiException::ServerErrorToArray($ex);
        } finally {
            return response()->json($response);
        }
    }
    
    public function edit($userId) {
        return response()->json(['action' => 'edit', 'id' => $userId]);
    }
    
    protected function getData($request) {
        if (!$request instanceof Request) {
            throw new MobileApiException("Bad request data", MobileApiException::ERROR_SERVER);
        }
        
        $email = $request->input('email');
        $password = $request->input('password');
        
        $nickname = $request->input('nick');
        $userPic = $request->input('picture');
        
        if (!isset($email) || $email === NULL) {
            throw new MobileApiException("Email is required", MobileApiException::ERROR_NOT_DATA_RECEIVED);
        }
        
        if (!isset($password) || $password === NULL) {
            throw new MobileApiException("Password is required", MobileApiException::ERROR_NOT_DATA_RECEIVED);
        }
        
        return compact('email', 'password', 'nickname', 'userPic');
    }
    
}
