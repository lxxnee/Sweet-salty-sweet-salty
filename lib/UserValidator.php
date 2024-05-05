<?php
namespace lib;

class UserValidator {
    public static function chkValidator(array $param_arr) {
        $arrErrorMsg = []; // 에러 메세지 보관용

        // 패턴 생성
        $patternEmail = "/^[0-9a-zA-Z](?!.*?[\-\_\.]{2})[a-zA-Z0-9\-\_\.]{3,63}@[0-9a-zA-Z](?!.*?[\-\_\.]{2})[a-zA-Z0-9\-\_\.]{3,63}\.[a-zA-Z]{2,3}$/";
        $patternPassword = "/^[a-zA-Z0-9!@]{8,20}$/";
        $patternName = "/^[가-힣]{1,50}$/";

        // 이메일 체크
        if(array_key_exists("u_email", $param_arr)) {
            if(preg_match($patternEmail, $param_arr["u_email"], $matches) === 0) {
                $arrErrorMsg[] = "이메일 형식이 맞지 않습니다.";
            }
        }

        // 패스워드 체크
        if(array_key_exists("u_pw", $param_arr)) {
            if(preg_match($patternPassword, $param_arr["u_pw"], $matches) === 0) {
                $arrErrorMsg[] = "비밀번호는 영어 대소문자 및 숫자, 특수문자(!,@)로 8~20로 작성해주세요.";
            }
        }

        // 이름 체크
        if(array_key_exists("u_name", $param_arr)) {
            if(preg_match($patternName, $param_arr["u_name"], $matches) === 0) {
                $arrErrorMsg[] = "이름은 한글만 입력해 주세요.";
            }
        }
        return $arrErrorMsg;
    }
}

