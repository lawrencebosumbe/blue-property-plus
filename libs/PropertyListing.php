<?php
	class PropertyListing{
		private $listing_id;
		private $no_listing;
		private $listing_amount;
		private $listing_desc;
		
		public function __construct(){
			$this->listing_id = 0;
			$this->no_listing = 0;
			$this->listing_amount = 0;
			$this->listing_desc = '';
		}
		
		//SETTERS - MUTATORS
		
		/*
		Set Listing ID
		@param value
		@return void
		*/
		
		public function setListingID($value){
			$this->listing_id = $value;
		}
		
		/*
		Set No Listing
		@param value
		@return void
		*/
		
		public function setNoListing($value){
			$this->no_listing = $value;
		}
		
		
		/*
		Set Listing Amount
		@param value
		@return void
		*/
		
		public function setListingAmount($value){
			$this->listing_amount = $value;
		}
		
		/*
		Set Listing Desc
		@param value
		@return void
		*/
		
		public function setListingDesc($value){
			$this->listing_desc = $value;
		}
		
		
		//GETTERS - ACCESSORS
		
		/*
		Get Listing ID
		@param void
		@return Listing ID
		*/
		
		public function getListingID(){
			return $this->listing_id;
		}
		
		/*
		Get No Listing
		@param void
		@return No Listing
		*/
		
		public function getNoListing(){
			return $this->no_listing;
		}
		
		
		/*
		Get Listing Amount
		@param void
		@return Listing Amount
		*/
		
		public function getListingAmount(){
			return $this->listing_amount;
		}
		
		/*
		Get Listing Desc
		@param void
		@return Listing Desc
		*/
		
		public function getListingDesc(){
			return $this->listing_desc;
		}
		
	}
?>