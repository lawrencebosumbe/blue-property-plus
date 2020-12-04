<?php
class SaleListing{
    private $sale_list_id;
    private $property;
	private $agent;
	private $suburb;
	private $disc_percent;
    private $sale_list_amount;
	private $total_list;
	
	public function __construct(){
		$this->sale_list_id = 0;
		$this->property = null;
		$this->agent = null;
		$this->suburb = null;
		$this->disc_percent = 0;
		$this->sale_list_amount = 0;
		$this->total_list = 0;
	}
	
	//SETTERS - MUTATORS
	
	/*
	set Sale Listing ID
	@param value
	@return void
	*/
	
	public function setSaleListingID($value){
		$this->sale_list_id = $value;
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
	set Agent
	@param value
	@return void
	*/
	
	public function setAgent($value){
		$this->agent = $value;
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
	set Discount percentage
	@param value
	@return void
	*/
	
	public function setDiscountPercent($value){
		$this->disc_percent = $value;
	}
	
	/*
	set Sale Listing Amount
	@param value
	@return void
	*/
	
	public function setSaleListingAmount($value){
		$this->sale_list_amount = $value;
	}
	
	/*
	set Total Listing
	@param value
	@return void
	*/
	
	public function setTotalListing($value){
		$this->total_list = $value;
	}
	
	//GETTERS - ACCESSORS
	
	/*
	get Sale Listing ID
	@param void
	@return Sale Listing ID
	*/
	
	public function getSaleListingID(){
		return $this->sale_list_id;
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
	get Sale Listing Amount
	@param void
	@return Sale Listing Amount
	*/
	
	public function getSaleListingAmount(){
		return $this->sale_list_amount;
	}
	
	/*
	get Sale Amount Format
	@param void
	@return Sale Amount Format
	*/
	
	public function getAmountFormat(){
		$amount_format = number_format($this->sale_list_amount, 2);
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
        $discount_amount = $this->sale_list_amount * $discount_percent;
        $discount_amount = round($discount_amount, 2);
        $discount_amount = number_format($discount_amount, 2);
        return $discount_amount;
	}
	
	/*
	get Discount Saling Amount
	@param void
	@return Discount Saling Amount
	*/
	
	public function getDiscountSalingAmount(){
		$discount_price = $this->sale_list_amount - $this->getDiscountAmount();
        $discount_price = number_format($discount_price, 2);
        return $discount_price;
	}
	
	/*
	get Total Listing
	@param void
	@return Total Listing
	*/
	
	public function getTotalListing(){
		$this->total_list;
	}
}
?>