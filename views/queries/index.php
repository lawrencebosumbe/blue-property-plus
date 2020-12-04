<h1>Number of Properties in Province</h1>
<?php
	$province_id = 1;
	$provinces = new ProvinceDB();
	$property = $provinces->getProvinceNumPropertiesForSale($province_id);
	
	if(!empty($property)){
		echo $property->getPropertyID();
	}
?>

<h1>Top property listing agency</h1>
<?php
	$ads = new AdsDB();
	$property = $ads->getAgencyNumPropertiesForSale();
	
	if(!empty($property)){
		echo $property->getPropertyID();
		//echo $property->getAgent()->getFirstname();
	}
?>