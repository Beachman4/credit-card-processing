<?php
require __DIR__ . '../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    public function testNegativeBalance()
    {
        $file = __DIR__ . '/testNegativeBalance.txt';
        $script = __DIR__ . '/../run.php';
        $actual = shell_exec("php $script $file");
        $expected = "Anthony: $-1500\nLowell: $-6000\nQuinton: error\nTerry: $-3500\n";
        $this->assertEquals($expected, $actual);
    }

    public function testGreaterThanAllowedCharge()
    {
        $file = __DIR__ . '/testGreaterThanAllowedCharge.txt';
        $script = __DIR__ . '/../run.php';
        $actual = shell_exec("php $script $file");
        $expected = "Anthony: $4500\nLowell: $1900\nQuinton: error\nTerry: $1000\n";
        $this->assertEquals($expected, $actual);
    }

    public function testBasic()
    {
        $file = __DIR__ . '/testBasic.txt';
        $script = __DIR__ . '/../run.php';
        $actual = shell_exec("php $script $file");
        $expected = "Lowell: $-90\nQuinton: error\nTerry: $1300\n";
        $this->assertEquals($expected, $actual);
    }

    public function testInvalidCreditCards()
    {
        $file = __DIR__ . '/testInvalidCreditCards.txt';
        $script = __DIR__ . '/../run.php';
        $actual = shell_exec("php $script $file");
        $expected = "Anthony: error\nLowell: error\nQuinton: error\nTerry: error\n";
        $this->assertEquals($expected, $actual);
    }

    public function testRemoves()
    {
        $file = __DIR__ . '/testRemoves.txt';
        $script = __DIR__ . '/../run.php';
        $actual = shell_exec("php $script $file");
        $expected = "";
        $this->assertEquals($expected, $actual);
    }



}