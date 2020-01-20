<?php
/**
 * Created by PhpStorm.
 * User: himanshukotnala
 * Date: 2020-01-20
 * Time: 15:08
 */

namespace TDD;


class XmlParser
{
    public function parseXml($filePath){
        $ret = [];
        $xml = simplexml_load_file($filePath);
        foreach($xml->children() as $child){
            $return[(string)$child->uniqueID] = $child->getName();
        }
        return $ret;
    }
}

$xmlparser = new XmlParser();
$xmlparser->parseXml('../sample-reaxml.xml');