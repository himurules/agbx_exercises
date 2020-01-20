<?php
/**
 * Created by PhpStorm.
 * User: himanshukotnala
 * Date: 2020-01-20
 * Time: 14:03
 */

namespace TDD;


class RepeatCharacters
{
    public function checkRepeatCharacters($strToCheck){
        $cleanStr = $this->_removeNonLetter($strToCheck);
        foreach(count_chars($cleanStr, 1) as $char => $count){
            if($count >1)
                return false;
        }
        return true;
    }

    private function _removeNonLetter($str){
        return preg_replace("/[^A-Za-z0-9 ]/", '', $str);
    }
}