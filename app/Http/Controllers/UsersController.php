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
use App\User;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Description of UsersController
 *
 * @author Artem
 */
class UsersController extends BaseController
{
    protected $testEmail = 'admin@example.com';
    protected $testPassword = '1111';
    
    public function index() {
        if ($user = Auth::user()) {
            return response()->json(['user' => $user]);
        }
        else {
            $this->createUser();
            $user = Auth::attempt(['email' => $this->testEmail, 'password' => $this->testPassword]);
            return response()->json(['user' => $user]);
        }
        
    }
    
    public function login(Request $request) {
        try {
            $email = $request->input('email');
            $password = $request->input('password');
            
            $user = Auth::attempt(['email' => $email, 'password' => $password], true); 
            
            $response = [
                'error' => MobileApiException::ErrorNoneToArray(),
                'result' => 'success'
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
        try {
            $this->checkAccess();
            
            Auth::logout();
            
            $response = MobileApiException::ErrorNoneToArray();
        } catch (MobileApiException $ex) {
            $response = $ex->toArray();
        } catch (\Exception $ex) {
            $response = MobileApiException::ServerErrorToArray($ex);
        } finally {
            return response()->json($response); 
        }
    }
    
    public function signUp(Request $request) {
        try {
            $user = $this->getData($request);
            
            $this->createUser($user);
            
            $response = [
                'error' => MobileApiException::ErrorNoneToArray(),
                'result' => 'success'
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
        try {
            $user = $this->checkAccess();
            
            
        } catch (MobileApiException $ex) {
            $response = $ex->toArray();
        } catch (Exception $ex) {
            $response = MobileApiException::ServerErrorToArray($ex);
        } finally {
            return response()->json(['action' => 'edit', 'id' => $userId]);
        }
    }
    
    protected function createUser(array $user = []) {
        if (empty($user)) {
            return User::create([
                'name' => 'admin',
                'email' => $this->testEmail,
                'password' => bcrypt($this->testPassword),
            ]);
        }
        else {
            return User::create([
                'name' => $user['nickname'],
                'email' => $user['email'],
                'password' => bcrypt($user['password'])
            ]);
        }
    }
    
}
