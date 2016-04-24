<?php
/*
	Author     : Fernando Herrero
	Mail       : fherrero[at]noticiasdenavarra.com
	Program    : pdf-cmyk.php
	License    : GPL v2
	Description: Allow to use CMYK color space:
                 SetDrawColor() => Set draw color to black
                 SetDrawColor(int gray) => value in % (0 = black, 100 = white)
                 SetDrawColor(int red, int green, int blue) => 0 to 255
                 SetDrawColor(int cyan, int magenta, int yellow, int black) => values in % (0 to 100)
                 SetFillColor and SetTextColor same as SetDrawColor
	Date       : 2004-01-22
*/
require('fpdi.php');

class cmykPDF extends fpdi {
/*
	function SetDrawColor($r, $g = -1, $b = -1) {
		//Set color for all stroking operations
		switch(func_num_args()) {
			case 1:
				$g = func_get_arg(0);
				$this->DrawColor = sprintf('%.3f G', $g / 100);
				break;
			case 3:
				$r = func_get_arg(0);
				$g = func_get_arg(1);
				$b = func_get_arg(2);
				$this->DrawColor = sprintf('%.3f %.3f %.3f RG', $r / 255, $g / 255, $b / 255);
				break;
			case 4:
				$c = func_get_arg(0);
				$m = func_get_arg(1);
				$y = func_get_arg(2);
				$k = func_get_arg(3);
				$this->DrawColor = sprintf('%.3f %.3f %.3f %.3f K', $c / 100, $m / 100, $y / 100, $k / 100);
				break;
			default:
				$this->DrawColor = '0 G';
		}
		if($this->page > 0)
			$this->_out($this->DrawColor);
	}

	function SetFillColor($r, $g = -1, $b = -1) {
		//Set color for all filling operations
		switch(func_num_args()) {
			case 1:
				$g = func_get_arg(0);
				$this->FillColor = sprintf('%.3f g', $g / 100);
				break;
			case 3:
				$r = func_get_arg(0);
				$g = func_get_arg(1);
				$b = func_get_arg(2);
				$this->FillColor = sprintf('%.3f %.3f %.3f rg', $r / 255, $g / 255, $b / 255);
				break;
			case 4:
				$c = func_get_arg(0);
				$m = func_get_arg(1);
				$y = func_get_arg(2);
				$k = func_get_arg(3);
				$this->FillColor = sprintf('%.3f %.3f %.3f %.3f k', $c / 100, $m / 100, $y / 100, $k / 100);
				break;
			default:
				$this->FillColor = '0 g';
		}
		$this->ColorFlag = ($this->FillColor != $this->TextColor);
		if($this->page > 0)
			$this->_out($this->FillColor);
	}

	function SetTextColor($r, $g = -1, $b = -1) {
		//Set color for text
		switch(func_num_args()) {
			case 1:
				$g = func_get_arg(0);
				$this->TextColor = sprintf('%.3f g', $g / 100);
				break;
			case 3:
				$r = func_get_arg(0);
				$g = func_get_arg(1);
				$b = func_get_arg(2);
				$this->TextColor = sprintf('%.3f %.3f %.3f rg', $r / 255, $g / 255, $b / 255);
				break;
			case 4:
				$c = func_get_arg(0);
				$m = func_get_arg(1);
				$y = func_get_arg(2);
				$k = func_get_arg(3);
				$this->TextColor = sprintf('%.3f %.3f %.3f %.3f k', $c / 100, $m / 100, $y / 100, $k / 100);
				break;
			default:
				$this->TextColor = '0 g';
		}
		$this->ColorFlag = ($this->FillColor != $this->TextColor);
	}
*/
}
?>
