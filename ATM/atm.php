<?php
session_start();
class ATM {
    private $pin = "260800";
    private $balance = 3000000;

    public function checkPin($inputPin) {
        return $inputPin == $this->pin;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            return true;
        }
        return false;
    }

    public function deposit($amount) {
        if ($amount > 0) {  
            $this->balance += $amount;
            return true;
        }
        return false;
    }
}
?>
