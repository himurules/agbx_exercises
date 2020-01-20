<?php
/**
 * Created by PhpStorm.
 * User: himanshukotnala
 * Date: 2020-01-20
 * Time: 14:26
 */

namespace TDD;


class StringMerger
{
    public function mergeStrings($string1, $string2){

        $organized = $this->_organizeString($string1, $string2);

        $output = "";
        $tail = substr($organized[0],strlen($organized[1]));
        for($i=0;$i<strlen($organized[1]);$i++){
            $output .= $string1[$i].$string2[$i];
        }
        $output .= $tail;
        return $output;
    }

    private function _organizeString($string1, $string2){
        $organized = [];
        if(strlen($string1)>= strlen($string2)){
            $organized[] = $string1;
            $organized[] = $string2;
        }else{
            $organized[] = $string2;
            $organized[] = $string1;
        }
        return $organized;
    }
}