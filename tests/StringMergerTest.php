<?php
/**
 * Created by PhpStorm.
 * User: himanshukotnala
 * Date: 2020-01-20
 * Time: 14:28
 */

namespace TDD\Test;
require_once dirname(dirname(__FILE__)). DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
use TDD\StringMerger;

use PHPUnit\Framework\TestCase;



class StringMergerTest extends TestCase
{
    protected $_stringMerger = null;

    public function setUp(){
        $this->_stringMerger = new StringMerger();
    }

    /**
     * @dataProvider provideMergerData
     */
    public function testMergeStrings($input1, $input2, $expected){
        $output = $this->_stringMerger->mergeStrings($input1, $input2);
        $this->assertEquals(
            $expected,
            $output,
            'Expected merged value is supposed to be '.$expected
        );
    }

    public function provideMergerData(){
        return [
            ['SCOTT', 'MORRISON', 'SMCOORTRTISON'],
            ['MICHAEL','JORDAN','MJIOCRHDAAENL']
        ];
    }

    public function tearDown()
    {
        unset($this->_stringMerger);
    }
}