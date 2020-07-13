<?php
class PrintColorString {
	const	NORMAL = 0;
	const	VERTICAL = 2;
	const	UNDER = 4;
	const	BLINK = 5;
	const	REVERSE = 7;

	const	WHITE = 37;
	const	BLUE = 34;
	const	GREEN = 32;
	const	PURPLE = 35;
	const	RED = 31;
	const	CYAN = 36;
	const	YELLOW = 33;


	private $__type = self::NORMAL;
	private $__color = self::WHITE;
	private $__baseStr = "\033[%d;%dm";
	
	/*
	 * 色, 表示タイプ設定
	 */
	public function set($type, $color) {
		$this->__type = $type;
		$this->__color = $color;
	}
	/*
	 * 桁、行位置指定
	 */
	public function setPoint($row, $col) {
		printf("\033[%d;%dH", $row, $col);
	}
	/*
	 * カーソル制御	
	 */
	public function setCursol($onOff) {
		if ($onOff) {
			// 出す
			printf("\033[>5l");
		} else {
			// 消す 
			printf("\033[>5h");
		}
	}
	/*
	 * 文字列出力
	 */
	public function out($string, $type = null, $color = null) {
		if (is_null($type)) {
			$type = $this->__type;
		}
		if (is_null($color)) {
			$color = $this->__color;
		}

		printf($this->__baseStr, $type, $color);
		printf($string . "\n");
	}
}

$print = new PrintColorString();

$print->set(PrintColorString::UNDER, PrintColorString::BLUE);
$print->out("こんにちは");

$print->setPoint(5, 10);
$print->set(PrintColorString::VERTICAL, PrintColorString::CYAN);
$print->out("こんにちは");

$print->set(PrintColorString::BLINK, PrintColorString::PURPLE);
$print->out("こんにちは");

$print->set(PrintColorString::REVERSE, PrintColorString::YELLOW);
$print->out("こんにちは");

$print->set(PrintColorString::NORMAL, PrintColorString::WHITE);
$print->out("");

