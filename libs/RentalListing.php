<?php
class RentalListing{
    private $rental_list_id;
    private $agent;
	private $property;
	private $suburb;
    private $rental_list_amout;
	private $disc_percent;
	private $total_listing;
	
	public function __construct(){
		$this->rental_list_id = 0;
		$this->agent = null;
		$this->property = null;
		$this->suburb = null;
		$this->rental_list_amout = 0;
		$this->disc_percent = 0;
		$this->total_listing = 0;
	}
	
	//SETTERS - MUTATORS
	
	/*
	set Rental Listing ID
	@param value
	@return void
	*/
	
	public function setRentalListingID($value){
		$this->rental_list_id = $value;
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
	set Suburb
	@param value
	@return void
	*/
	
	public function setSuburb($value){
		$this->suburb = $value;
	}
	
	/*
	set Rental Listing Amount
	@param value
	@return void
	*/
	
	public function setRentalListingAmount($value){
		$this->rental_list_amout = $value;
	}
	
	/*
	set Discount percentage
	@param value
	@return void
	*/
	
	public function setDiscountPercent($value){
		$this->disc_percent = $value;
	}
	
	/*
	set Total Listing
	@param value
	@return void
	*/
	
	public function setTotalListing($value){
		$this->total_listing = $value;
	}
	
	//GETTERS - ACCESSORS
	
	/*
	get Rental Listing ID
	@param void
	@return Rental Listing ID
	*/
	
	public function getRentalListingID(){
		return $this->rental_list_id;
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
	get Agent
	@param void
	@return Agent
	*/
	
	public function getAgent(){
		return $this->agent;
	}
	
	/*
	get Suburb
	@param void
	@return Suburb
	*/
	
	public function getSuburb(){
		return $this->suburb;
	}
	
	/*
	get Rental Listing Amount
	@param void
	@return Rental Listing Amount
	*/
	
	public function getRentalListingAmount(){
		return $this->rental_list_amout;
	}
	
	/*
	get Rental Amount Format
	@param void
	@return Rental Amount Format
	*/
	
	public function getAmountFormat(){
		$amount_format = number_format($this->rental_list_amout, 2);
		return $amount_format;
	}
	
	/*
	get Ten Percent Discount
	@param void
	@return Ten Percent Discount
	*/
	
	public function getTenPercentDiscount(){
		$discount_percent = 10;
		return $discount_percent;
	}
	
	/*
	get Twenty Percent Discount
	@param void
	@return Twenty Percent Discount
	*/
	
	public function getTwentyPercentDiscount(){
		$discount_percent = 20;
		return $discount_percent;
	}
	
	/*
	get Thirty Percent Discount
	@param void
	@return Thirty Percent Discount
	*/
	
	public function getThirtyPercentDiscount(){
		$discount_percent = 30;
		return $discount_percent;
	}
	
	/*
	get Fourty Percent Discount
	@param void
	@return Fourty Percent Discount
	*/
	
	public function getFourtyPercentDiscount(){
		$discount_percent = 40;
		return $discount_percent;
	}
	
	/*
	get Discount Percent
	@param void
	@return Discount Percent
	*/
	
	public function getDiscountPercent(){
		if($this->getTenPercentDiscount()){
			return $this->getTenPercentDiscount();
		}elseif ($this->getTwentyPercentDiscount()){
			return $this->getTwentyPercentDiscount();
		}elseif ($this->getThirtyPercentDiscount()){
			return $this->getThirtyPercentDiscount();
		}elseif ($this->getFourtyPercentDiscount()){
			return $this->getFourtyPercentDiscount();
		}else{
			return $this->disc_percent;
		}
	}
	
	/*
	get Discount Amount
	@param void
	@return Discount Amount
	*/
	
	public function getDiscountAmount(){
		$discount_percent = $this->getDiscountPercent() / 100;
        $discount_amount = $this->rental_list_amout * $discount_percent;
        $discount_amount = round($discount_amount, 2);
        $discount_amount = number_format($discount_amount, 2);
        return $discount_amount;
	}
	
	/*
	get Discount Rental Amount
	@param void
	@return Discount Rental Amount
	*/
	
	public function getDiscountRentalAmount(){
		$discount_price = $this->rental_list_amout - $this->getDiscountAmount();
        $discount_price = number_format($discount_price, 2);
        return $discount_price;
	}
	
	/*
	get Total Listing
	@param void
	@return Total Listing
	*/
	
	public function getTotalListing(){
		$this->total_listing;
	}
}
?>