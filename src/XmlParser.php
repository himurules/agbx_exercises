<?php
/**
 * Created by PhpStorm.
 * User: himanshukotnala
 * Date: 2020-01-20
 * Time: 15:08
 */

namespace TDD;
require_once dirname(dirname(__FILE__)). DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
use Symfony\Component\Yaml\Yaml;


class XmlParser
{
    protected $_xml = null;
    protected  $_filepath = null;
    public function __construct($filepath)
    {
        $this->_filepath = $filepath;
        $this->parseXml();
    }

    public function parseUniqueIds(){
        $ret = [];
        foreach($this->_xml->children() as $child){
            $ret[(string)$child->uniqueID] = $child->getName();
        }
        return $ret;
    }
    public function parseStatePrices(){
        $ret = [];
        foreach($this->_xml->children() as $child){
            if(isset($child->price)) {
                    $ret[(string)$child->address->state][] = (double)$child->price;
            }
        }

        foreach($ret as $key=>$value){
            $ret[$key] = round((array_sum($value)/count($value)),2);
        }
        return $ret;
    }

    public function xmlToYaml($yamlfileName){
        $array = $this->xmlToArray();
        //var_dump($array);
        $yaml = Yaml::dump($array);

        file_put_contents($yamlfileName, $yaml);
    }

    private function xmlToArray(){
        $json = json_encode($this->_xml);
        $array = json_decode($json, true);
        return $array;
    }

    private function parseXml(){
        $this->_xml = simplexml_load_file($this->_filepath);
    }
}

$xmlparser = new XmlParser('../sample-reaxml.xml');
$xmlparser->xmlToYaml('../sample.yaml');