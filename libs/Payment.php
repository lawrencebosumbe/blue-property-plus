<?php
	class Payment{
		private $payment_id;
		private $agent;
		private $property;
		private $sale_listing;
		private $rental_listing;
		private $amount;
		private $subtotal;
		private $total;
		private $vat;
		private $date;
		
		public function __construct(){
			$this->payment_id = 0;
			$this->agent = null;
			$this->property = null;
			$this->sale_listing = null;
			$this->rental_listing = null;
			$this->amount = 0;
			$this->subtotal = 0;
			$this->total = 0;
			$this->vat = 0;
			$this->date = "";
		}
		
		//SETTERS - MUTATORS
			
		/*
		set Payment ID
		@param value
		@return void
		*/
		
		public function setPayment($value){
			$this->payment_id = $value;
		}
		
		/*
		set Agent 
		@param value
		@return void
		*/
		
		public function setAgent($value){
			$this->agent = $value;
		}
		
		/*
		set Property 
		@param value
		@return void
		*/
		
		public function setProperty($value){
			$this->property = $value;
		}
		
		/*
		set Sale listing 
		@param value
		@return void
		*/
		
		public function setSaleListing($value){
			$this->sale_listing = $value;
		}
		
		/*
		set Rental listing 
		@param value
		@return void
		*/
		
		public function setRentalListing($value){
			$this->rental_listing = $value;
		}
		
		/*
		set Amount 
		@param value
		@return void
		*/
		
		public function setAmount($value){
			$this->amount = $value;
		}
		
		/*
		set Subtotal 
		@param value
		@return void
		*/
		
		public function setSubtotal($value){
			$this->subtotal = $value;
		}
		
		/*
		set Total 
		@param value
		@return void
		*/
		
		public function setTotal($value){
			$this->total = $value;
		}
		
		/*
		set VAT 
		@param value
		@return void
		*/
		
		public function setVAT($value){
			$this->vat = $value;
		}
		
		/*
		set date of payment 
		@param value
		@return void
		*/
		
		public function setPaymentDate($value){
			$this->date = $value;
		}
		
		//GETTERS
		
		/*
		get Payment ID 
		@param void
		@return Payment ID 
		*/
		
		public function getPaymentID(){
			return $this->payment_id;
		}
		
		/*
		get Agent 
		@param void
		@return Agent 
		*/
		
		public function getAgent(){
			return $this->agent;
		}
		
		/*
		get Property 
		@param void
		@return Property 
		*/
		
		public function getProperty(){
			return $this->property;
		}
		
		/*
		get Sale listing
		@param void
		@return Sale listing 
		*/
		
		public function getSaleListing(){
			return $this->sale_listing;
		}
		
		/*
		get Rental listing
		@param void
		@return Rental listing 
		*/
		
		public function getRentalListing(){
			return $this->rental_listing;
		}
		
		/*
		get Amount 
		@param void
		@return Amount 
		*/
		
		public function getAmount(){
			return $this->amount;
		}
		
		/*
		get Amount Format
		@param void
		@return Amount Format
		*/
		
		public function getAmountFormat(){
			$amount_format = number_format($this->amount, 2);
			return $amount_format;
		}
		
		/*
		get Subtotal 
		@param void
		@return Subtotal 
		*/
		
		public function getSubtotal(){
			return $this->subtotal;
		}
		
		/*
		get Total 
		@param void
		@return Subtotal 
		*/
		
		public function getTotal(){
			return $this->total;
		}
		
		/*
		get VAT 
		@param void
		@return VAT 
		*/
		
		public function getVAT(){
			return $this->vat;
		}
		
		/*
		get payment date 
		@param void
		@return VAT 
		*/
		
		public function getPaymentDate(){
			return $this->date;
		}
	}
?>