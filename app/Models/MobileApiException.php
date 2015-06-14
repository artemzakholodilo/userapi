<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

/**
 * Description of MobileApiException
 *
 * @author Artem
 */
class MobileApiException extends \Exception
{
    const ERROR_NONE = 0;
    const ERROR_NOT_AUTHORIZED = 1;
    const ERROR_NOT_DATA_RECEIVED = 2;
    const ERROR_INCORRECT_DATA = 3;
    
    const ERROR_UNKNOWN = 100;
    const ERROR_SERVER = 500;
    
    private $_errCode = self::ERROR_SERVER;
    
    public function __construct($message, $errCode) {
        parent::__construct($message, 0, NULL);
        $this->_errCode = intval($errCode);
    }
    
    public function toArray(){
        return [
            'error' => [
                'code' => $this->_errCode,
                'message' => $this->getMessage()
            ]
        ];
    }
    
    public static function ErrorNoneToArray(){
        return [
            'code' => self::ERROR_NONE,
            'message' => ''
        ];
    }
    
    public static function ServerErrorToArray(Exception $ex){
        self::_PrintError($ex);
        return [
            'error' => ['code' => self::ERROR_SERVER, 'message' => $ex->getMessage()]
        ];
    }
}
