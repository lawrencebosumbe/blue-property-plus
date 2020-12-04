<?php 

	//Get Province ID 
	//$province_id = isset($_GET['province_id']) ? $_GET['province_id']: "";
		
	// Construct Province Object
	$provinces = new ProvinceDB();
	$province = new Province();

	//Construct, instatiate, objects			 		
	$municipalities = new MunicipalityDB();
	$municipality = new Municipality();
	
	//Get Munipality ID 
	$municipality_id = isset($_GET['municipality_id']) ? $_GET['municipality_id'] : 1;
	
	// Get Municipality ID 
	$ekurhuleni_id = isset($_GET['ekurhuleni_id']) ? $_GET['ekurhuleni_id'] : 1 ;
	$city_jhb_id = isset($_GET['city_jhb_id']) ? $_GET['city_jhb_id'] : 2 ;
	$city_pretoria_id = isset($_GET['city_pretoria_id']) ? $_GET['city_pretoria_id'] : 3 ;
	$emfuleni_id = isset($_GET['emfuleni_id']) ? $_GET['emfuleni_id'] : 4 ;
	$midvaal_id = isset($_GET['midvaal_id']) ? $_GET['midvaal_id'] : 5 ;
	$lesedi_id = isset($_GET['lesedi_id']) ? $_GET['lesedi_id'] : 6 ;
	$mogale_id = isset($_GET['mogale_id']) ? $_GET['mogale_id'] : 7 ;
	$merafong_id = isset($_GET['merafong_id']) ? $_GET['merafong_id'] : 8 ;
	$rand_west_id = isset($_GET['rand_west_id']) ? $_GET['rand_west_id'] : 9 ;
	
	//Set Municipality ID to be read
	$municipality->setMunicipalityID($municipality_id);
	
	//Read the details of a municipality to be read
	$municipality = $municipalities->getMunicipality($municipality_id);	
	
	// Get Appropriate Municipality 
	$ekurhuleni = new Municipality();
	$ekurhuleni = $municipalities->getMunicipality($ekurhuleni_id);
	
	$city_jhb = new Municipality();
	$city_jhb = $municipalities->getMunicipality($city_jhb_id);
	
	$city_pretoria = new Municipality();
	$city_pretoria = $municipalities->getMunicipality($city_pretoria_id);
	
	$emfuleni = new Municipality();
	$emfuleni = $municipalities->getMunicipality($emfuleni_id);
	
	$midvaal = new Municipality();
	$midvaal = $municipalities->getMunicipality($midvaal_id);
	
	$lesedi = new Municipality();
	$lesedi = $municipalities->getMunicipality($lesedi_id);
	
	$mogale = new Municipality();
	$mogale = $municipalities->getMunicipality($mogale_id);
	
	$merafong = new Municipality();
	$merafong = $municipalities->getMunicipality($merafong_id);
	
	$rand_west = new Municipality();
	$rand_west = $municipalities->getMunicipality($rand_west_id);
	
	$city = new City();
	$cities = new CityDB();
	
	$suburb = new Suburb();
	$suburbs = new SuburbDB();
	
	$property = new Property();	
	$properties = new PropertyDB();

	$post = new Post();
	$posts = new PostDB();
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<title>Gauteng</title>
<!--
 ---------------------------------------------------------------
       STYLES
 ---------------------------------------------------------------
 >
 
<!-- BOOTSTRAP -->
<link rel="stylesheet" href="../public/bootstrap/css/bootstrap.css">

<!-- HEADER -->
<link rel="stylesheet" href="../public/css1/header.css"/>

<!-- FOOTER -->
<link rel="stylesheet" href="../public/css1/footer.css"/>

<!-- BANNER -->
<link rel="stylesheet" href="../public/css1/province-banner.css"/>

<!-- JSSOR SLIDER -->
<link rel="stylesheet" href="../public/css1/jssor-slider.css"/>

<!-- ARROW BOX -->
<link rel="stylesheet" href="../public/css1/arrow-box.css"/>

<!-- MAIN -->
<link rel="stylesheet" href="../public/css1/styles.css"/>

<!-- MASTER STYLES -->   
<!--<link rel="stylesheet" href="../../css/master.css"/>-->

<!-- CAROUSEL SLIDER -->
<link rel="stylesheet" href="../public/carousel-slider/slitslider/css/custom.css"/>
<link rel="stylesheet" href="../public/carousel-slider/slitslider/css/style.css"/>

<!-- OWL CAROUSEL -->
<link rel="stylesheet" href="../public/carousel-slider/owl-carousel/owl.carousel.css"/>
<link rel="stylesheet" href="../public/carousel-slider/owl-carousel/owl.theme.css"/>

</head>