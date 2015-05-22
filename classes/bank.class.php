<?php

/*
	* To change this license header, choose License Headers in Project Properties.
	* To change this template file, choose Tools | Templates
	* and open the template in the editor.
	*/

/**
	* Description of banker
	*
	* @author RGBallard
	*/
class	Bank
{
				public function view()
				{
								$dump = '<br>';
								
								$account = new Account();
								$account->deposit(45.00);
								$account->withdraw(20.45);
								
								$dump .= print_r($account, TRUE);
								
								return $dump . '<br>' . $account->get_balance() . '<br>' .  print_r($account->get_transactions(), TRUE);
				}
}


class Account
{
				private $balance;
				private $transactions;
				
				public function __construct($starting_balance=0.00)
				{
								$this->balance = $starting_balance;
				}
				
				public function deposit($amount)
				{
								$this->transactions[] = 'Deposited: ' . number_format($amount, 2);
								$this->balance = $this->balance + $amount;
				}
				
				public function withdraw($amount)
				{
								$this->transactions[] = 'Withdrawn: ' . number_format($amount, 2);
								$this->balance = $this->balance - $amount;
				}
				
				public function post_transaction(Transaction $transaction)
				{
								try 
								{
												$new_balance = $transaction->applyTo($this->balance);
												$this->transactions[] = $transaction;
												$this->balance = $new_balance;
								} 
								catch (Exception $ex) 
								{
												//apply fee
								}
				}
				
				public function get_balance()
				{
								return number_format($this->balance, 2);
				}
				
				public function get_transactions()
				{
								return $this->transactions;
				}
								
}

abstract class Transaction
{
			private $amount;
				
				public function __construct($amount)
				{
								$this->amount = $amount;
				}
				
				public function applyTo($balance)
				{
								
				}	
				
				abstract protected function isDebit(); 
				
}

interface AccountRepository
{
				
}