<?php 


class Submission {
	private $email;
	private $first_name;
	private $last_name;
	private $pet_type;
	private $desc;
	private $pet_name;
	private $approved;
	private $image;
	private $opt_in;

	function __construct($e, $fn, $ln, $pt, $d, $pn, $a, $i, $oi) {
		$this->email = $e;
		$this->first_name = $fn;
		$this->last_name = $ln;
		$this->pet_type = $pt;
		$this->descrip = $d;
		$this->pet_name = $pn;
		$this->approved = $a;
		$this->image = $i;
		$this->opt_in = $oi;
	}

	function get_email() {
		return $this->email;
	}

	function get_first_name() {
		return $this->first_name;
	}

	function get_last_name() {
		return $this->last_name;
	}

	function get_pet_type() {
		return $this->pet_type;
	}

	function get_description() {
		return $this->descrip;
	}

	function get_pet_name() {
		return $this->pet_name;
	}

	function get_approved() {
		return $this->approved;
	}

	function get_image() {
		return $this->image;
	}

	function get_opt_in() {
		return $this->opt_in;
	}
}
?>
	
