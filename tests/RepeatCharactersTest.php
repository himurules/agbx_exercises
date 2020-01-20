<?php
/**
 * Created by PhpStorm.
 * User: himanshukotnala
 * Date: 2020-01-20
 * Time: 14:04
 */

namespace TDD\Test;
require_once dirname(dirname(__FILE__)). DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\RepeatCharacters;


class RepeatCharactersTest extends TestCase
{
    protected $_receiptChars = null;

    public function setUp(){
        $this->_receiptChars = new RepeatCharacters();
    }

    /**
     * @dataProvider provideCharactersTest
     */
    public function testCheckRepeatCharacters($input, $expected){
        $output = $this->_receiptChars->checkRepeatCharacters($input);
        $this->assertSame(
            $expected,
            $output,
            'Expected output value for the input provided is '.$expected
        );
    }

    public function provideCharactersTest(){
        return [
            ['documentarily', true],
            ['aftershock', true],
            ['six-year-old', true],
            ['Double-down', false],
            ['epidemic', false]
        ];
    }

    public function tearDown(){
        unset($this->_receiptChars);
    }
}