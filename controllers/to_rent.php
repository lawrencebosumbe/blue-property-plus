<?php

class To_Rent extends Controller {

	public function __construct() {
		parent::__construct();	
	}
	
	public function index() {	
		$this->view->render('to_rent/inc/header');
		$this->view->render('to_rent/index');
		$this->view->render('to_rent/inc/footer');
	}	

	//GAUTENG
	public function gauteng(){	
		$this->view->render('to_rent/gauteng/index');	
	}
	
	public function johannesburg(){	
		$this->view->render('to_rent/johannesburg/index');	
	}
		
	public function pretoria(){	
		$this->view->render('to_rent/pretoria/index');				
	}
		
	public function ekurhuleni(){	
		$this->view->render('to_rent/ekurhuleni/index');				
	}
		
	public function emfuleni(){	
		$this->view->render('to_rent/emfuleni/index');				
	}	
		
	public function lesedi(){	
		$this->view->render('to_rent/lesedi/index');				
	}	
		
	public function merafong(){	
		$this->view->render('to_rent/merafong/index');				
	}
		
	public function midvaal(){	
		$this->view->render('to_rent/midvaal/index');				
	}
		
	public function mogale(){	
		$this->view->render('to_rent/mogale/index');				
	}
		
	public function rand_west(){	
		$this->view->render('to_rent/rand_west/index');				
	}
	
	//EASTERN CAPE
	public function eastern_cape(){
		$this->view->render('to_rent/eastern_cape/index');
	}
	
	public function amahlathi(){	
		$this->view->render('to_rent/amahlathi/index');				
	}
	public function blue_crane_route(){	
		$this->view->render('to_rent/blue_crane_route/index');				
	}
	public function buffalo_city(){	
		$this->view->render('to_rent/buffalo_city/index');				
	}
	public function beyers_naude(){	
		$this->view->render('to_rent/beyers_naude/index');				
	}
	public function elundini(){	
		$this->view->render('to_rent/elundini/index');				
	}
	public function emalahleni(){	
		$this->view->render('to_rent/emalahleni/index');				
	}
	public function engcobo(){	
		$this->view->render('to_rent/engcobo/index');				
	}
	public function enoch_mgijima(){	
		$this->view->render('to_rent/enoch_mgijima/index');				
	}
	public function great_kei(){	
		$this->view->render('to_rent/great_kei/index');				
	}
	public function ingquza_hill(){	
		$this->view->render('to_rent/ingquza_hill/index');				
	}
	public function intsika_yethu(){	
		$this->view->render('to_rent/intsika_yethu/index');				
	}
	public function ixhuba_yethemba(){	
		$this->view->render('to_rent/ixhuba_yethemba/index');				
	}
	public function king_sabata(){	
		$this->view->render('to_rent/king_sabata/index');				
	}
	public function kouga(){	
		$this->view->render('to_rent/kouga/index');				
	}
	public function koukamma(){	
		$this->view->render('to_rent/koukamma/index');				
	}
	public function makana(){	
		$this->view->render('to_rent/makana/index');				
	}
	public function matatiele(){	
		$this->view->render('to_rent/matatiele/index');				
	}
	public function mbhashe(){	
		$this->view->render('to_rent/mbhashe/index');				
	}
	public function mbizana(){	
		$this->view->render('to_rent/mbizana/index');				
	}
	public function mhlontlo(){	
		$this->view->render('to_rent/mhlontlo/index');				
	}
	public function mnquma(){	
		$this->view->render('to_rent/mnquma/index');				
	}		
	public function ndlambe(){	
		$this->view->render('to_rent/ndlambe/index');				
	}
	public function nelson_mandela_bay(){	
		$this->view->render('to_rent/nelson_mandela_bay/index');				
	}
	public function ngqushwa(){	
		$this->view->render('to_rent/ngqushwa/index');				
	}
	public function nkonkobe(){	
		$this->view->render('to_rent/nkonkobe/index');				
	}
	public function ntabankulu(){	
		$this->view->render('to_rent/ntabankulu/index');				
	}
	public function nyandeni(){	
		$this->view->render('to_rent/nyandeni/index');				
	}
	public function port_st_johns(){	
		$this->view->render('to_rent/port_st_johns/index');				
	}
	public function raymond_mhlaba(){	
		$this->view->render('to_rent/raymond_mhlaba/index');				
	}
	public function sakhisizwe(){	
		$this->view->render('to_rent/sakhisizwe/index');				
	}
	public function senqu(){	
		$this->view->render('to_rent/senqu/index');				
	}
	public function sunday_river_valley(){	
		$this->view->render('to_rent/sunday_river_valley/index');				
	}
	
	public function umzimvubu(){	
		$this->view->render('to_rent/umzimvubu/index');				
	}
	
	public function walter_sisulu(){	
		$this->view->render('to_rent/walter_sisulu/index');				
	}
	
	//FREE STATE
	public function free_state(){	
		$this->view->render('to_rent/free_state/index');	
	}
	
	public function dihlabeng(){	
		$this->view->render('to_rent/dihlabeng/index');	
	}
	
	public function kopanong(){	
		$this->view->render('to_rent/kopanong/index');	
	}
	
	public function letsemeng(){	
		$this->view->render('to_rent/letsemeng/index');	
	}
	
	public function mafube(){	
		$this->view->render('to_rent/mafube/index');	
	}
	
	public function maluti_a_phofung(){	
		$this->view->render('to_rent/maluti_a_phofung/index');	
	}
	
	public function mangaung_metropolitan(){	
		$this->view->render('to_rent/mangaung_metropolitan/index');	
	}
	
	public function mantsopa(){	
		$this->view->render('to_rent/mantsopa/index');	
	}
	
	public function masilonyana(){	
		$this->view->render('to_rent/masilonyana/index');	
	}
	
	public function matjhabeng(){	
		$this->view->render('to_rent/matjhabeng/index');	
	}
	
	public function metsimaholo(){	
		$this->view->render('to_rent/metsimaholo/index');	
	}
	
	public function mohokare(){	
		$this->view->render('to_rent/mohokare/index');	
	}
	
	public function moqhaka(){	
		$this->view->render('to_rent/moqhaka/index');	
	}
	
	public function nala(){	
		$this->view->render('to_rent/nala/index');	
	}
	
	public function ngwathe(){	
		$this->view->render('to_rent/ngwathe/index');	
	}
	
	public function nketoana(){	
		$this->view->render('to_rent/nketoana/index');	
	}
	
	public function phumelela(){	
		$this->view->render('to_rent/phumelela/index');	
	}
	
	public function setseto(){	
		$this->view->render('to_rent/setseto/index');	
	}
	
	public function tokologo(){	
		$this->view->render('to_rent/tokologo/index');	
	}
	
	public function tswelopele(){	
		$this->view->render('to_rent/tswelopele/index');	
	}	
	
	//KWAZULU-NATAL
	public function kwazulu_natal(){	
		$this->view->render('to_rent/kwazulu_natal/index');	
	}
	
	public function abaqulusi(){
		$this->view->render('to_rent/abaqulusi/index');
	}		
				
	public function alfred_duma(){
		$this->view->render('to_rent/alfred_duma/index');
	}
		
	public function big_5_hlabisa(){
		$this->view->render('to_rent/big_5_hlabisa/index');
	}
		
	public function dannhause(){
		$this->view->render('to_rent/dannhause/index');
	}
		
	public function edumbe(){
		$this->view->render('to_rent/edumbe/index');
	}
		
	public function emadlangeni(){
		$this->view->render('to_rent/emadlangeni/index');
	}
		
	public function endumeni(){
		$this->view->render('to_rent/endumeni/index');
	}
		
	public function ethekwini(){
		$this->view->render('to_rent/ethekwini/index');
	}
		
	public function greater_kokstad(){
		$this->view->render('to_rent/greater_kokstad/index');
	}
		
	public function impendle(){
		$this->view->render('to_rent/impendle/index');
	}
		
	public function jozini(){
		$this->view->render('to_rent/jozini/index');
	}
		
	public function kwadukuza(){
		$this->view->render('to_rent/kwadukuza/index');
	}
		
	public function mandeni(){
		$this->view->render('to_rent/mandeni/index');
	}
		
	public function maphumulo(){
		$this->view->render('to_rent/maphumulo/index');
	}
		
	public function mkhambathini(){
		$this->view->render('to_rent/mkhambathini/index');
	}
		
	public function mpofana(){
		$this->view->render('to_rent/mpofana/index');
	}
		
	public function msinga(){
		$this->view->render('to_rent/msinga/index');
	}
		
	public function msunduzi(){
		$this->view->render('to_rent/msunduzi/index');
	}
		
	public function mthonjaneni(){
		$this->view->render('to_rent/mthonjaneni/index');
	}
		
	public function mtubatuba(){
		$this->view->render('to_rent/mtubatuba/index');
	}
		
	public function ndwedwe(){
		$this->view->render('to_rent/ndwedwe/index');
	}
		
	public function newcastle(){
		$this->view->render('to_rent/newcastle/index');
	}
		
	public function nkandla(){
		$this->view->render('to_rent/nkandla/index');
	}
		
	public function nkosazana_dlamini_zuma(){
		$this->view->render('to_rent/nkosazana_dlamini_zuma/index');
	}
		
	public function nkosi_langalibalele(){
		$this->view->render('to_rent/nkosi_langalibalele/index');
	}
		
	public function nongoma(){
		$this->view->render('to_rent/nongoma/index');
	}
		
	public function nquthu(){
		$this->view->render('to_rent/nquthu/index');
	}
		
	public function okhahlamba(){
		$this->view->render('to_rent/okhahlamba/index');
	}
		
	public function ray_nkonenyi(){
		$this->view->render('to_rent/ray_nkonenyi/index');
	}
		
	public function richmond(){
		$this->view->render('to_rent/richmond/index');
	}
		
	public function ubuhlebezwe(){
		$this->view->render('to_rent/ubuhlebezwe/index');
	}
		
	public function ulundi(){
		$this->view->render('to_rent/ulundi/index');
	}
		
	public function umdoni(){
		$this->view->render('to_rent/umdoni/index');
	}
		
	public function umfolozi(){
		$this->view->render('to_rent/umfolozi/index');
	}
		
	public function umhlabuyalingana(){
		$this->view->render('to_rent/umhlabuyalingana/index');
	}
		
	public function umhlathuze(){
		$this->view->render('to_rent/umhlathuze/index');
	}
		
	public function umlalazi(){
		$this->view->render('to_rent/umlalazi/index');
	}
		
	public function umngeni(){
		$this->view->render('to_rent/umngeni/index');
	}
		
	public function umshwathi(){
		$this->view->render('to_rent/umshwathi/index');
	}
		
	public function umvoti(){
		$this->view->render('to_rent/umvoti/index');
	}
		
	public function umzimkhulu(){
		$this->view->render('to_rent/umzimkhulu/index');
	}		
				
	public function umziwabantu(){
		$this->view->render('to_rent/umziwabantu/index');
	}
		
	public function umzumbe(){
		$this->view->render('to_rent/umzumbe/index');
	}
		
	public function uphongolo(){
		$this->view->render('to_rent/uphongolo/index');
	}
	
	//WESTERN CAPE
	public function western_cape(){
		$this->view->render('to_rent/western_cape/index');
	}

	public function cape_town(){	
		$this->view->render('to_rent/cape_town/index');	
	}
		
	public function breede_valley(){	
		$this->view->render('to_rent/breede_valley/index');	
	}
		
	public function drakenstein(){	
		$this->view->render('to_rent/drakenstein/index');	
	}
		
	public function stellenbosch(){	
		$this->view->render('to_rent/stellenbosch/index');	
	}
		
	public function witzenberg(){	
		$this->view->render('to_rent/witzenberg/index');	
	}
		
	public function langeberg(){	
		$this->view->render('to_rent/langeberg/index');	
	}
		
	public function george(){	
		$this->view->render('to_rent/george/index');	
	}
		
	public function cape_agulhas(){	
		$this->view->render('to_rent/cape_agulhas/index');	
	}
		
	public function bergrivier(){	
		$this->view->render('to_rent/bergrivier/index');	
	}
		
	public function swartland(){	
		$this->view->render('to_rent/swartland/index');	
	}
		
	public function beaufort_west(){	
		$this->view->render('to_rent/beaufort_west/index');	
	}
		
	public function laingsburg(){	
		$this->view->render('to_rent/laingsburg/index');	
	}
		
	public function hessequa(){	
		$this->view->render('to_rent/hessequa/index');	
	}
		
	public function overstrand(){	
		$this->view->render('to_rent/overstrand/index');	
	}
		
	public function cederberg(){	
		$this->view->render('to_rent/cederberg/index');	
	}
		
	public function oudtshoorn(){	
		$this->view->render('to_rent/oudtshoorn/index');	
	}
		
	public function prince_albert(){	
		$this->view->render('to_rent/prince_albert/index');	
	}
		
	public function kannaland(){	
		$this->view->render('to_rent/kannaland/index');	
	}
		
	public function swellendam(){	
		$this->view->render('to_rent/swellendam/index');	
	}
		
	public function matzikama(){	
		$this->view->render('to_rent/matzikama/index');	
	}
		
	public function mossel_bay(){	
		$this->view->render('to_rent/mossel_bay/index');	
	}
		
	public function bitou(){	
		$this->view->render('to_rent/bitou/index');	
	}
		
	public function knysna(){	
		$this->view->render('to_rent/knysna/index');	
	}
		
	public function theewaterskloof(){	
		$this->view->render('to_rent/theewaterskloof/index');	
	}
		
	public function saldanha_bay(){	
		$this->view->render('to_rent/saldanha_bay/index');	
	}
	
	//LIMPOPO
	public function limpopo(){	
		$this->view->render('to_rent/limpopo/index');	
	}
	
	public function blouberg(){	
		$this->view->render('to_rent/blouberg/index');	
	}
	
	public function phalaborwa(){	
		$this->view->render('to_rent/phalaborwa/index');	
	}
	
	public function maruleng(){	
		$this->view->render('to_rent/maruleng/index');	
	}
	
	public function makhuduthamaga(){	
		$this->view->render('to_rent/makhuduthamaga/index');	
	}
	
	public function thulamela(){	
		$this->view->render('to_rent/thulamela/index');	
	}
	
	public function mogalakwena(){	
		$this->view->render('to_rent/mogalakwena/index');	
	}
	
	public function lepelle_nkumpi(){	
		$this->view->render('to_rent/lepelle_nkumpi/index');	
	}
	
	public function giyani(){	
		$this->view->render('to_rent/giyani/index');	
	}
	
	public function elias_motsoaledi(){	
		$this->view->render('to_rent/elias_motsoaledi/index');	
	}
	
	public function collins_chabane(){	
		$this->view->render('to_rent/collins_chabane/index');	
	}
	
	public function bela_bela(){	
		$this->view->render('to_rent/bela_bela/index');	
	}
	
	public function thabazimbi(){	
		$this->view->render('to_rent/thabazimbi/index');	
	}
	
	public function molemole(){	
		$this->view->render('to_rent/molemole/index');	
	}
	
	public function letaba(){	
		$this->view->render('to_rent/letaba/index');	
	}
	
	public function ephraim_mogale(){	
		$this->view->render('to_rent/ephraim_mogale/index');	
	}
	
	public function makhado(){	
		$this->view->render('to_rent/makhado/index');	
	}
	
	public function lephalale(){	
		$this->view->render('to_rent/lephalale/index');	
	}
	
	public function polokwane(){	
		$this->view->render('to_rent/polokwane/index');	
	}
	
	public function tzaneen(){	
		$this->view->render('to_rent/tzaneen/index');	
	}
	
	public function fetakgomo(){	
		$this->view->render('to_rent/fetakgomo/index');	
	}
	
	public function musina(){	
		$this->view->render('to_rent/musina/index');	
	}
	
	public function modimolle(){	
		$this->view->render('to_rent/modimolle/index');	
	}
	
	//MPUMALANGA
	public function mpumalanga(){	
		$this->view->render('to_rent/mpumalanga/index');	
	}
	
	public function bushbuckridge(){	
		$this->view->render('to_rent/bushbuckridge/index');	
	}
	
	public function chief_albert_luthuli(){	
		$this->view->render('to_rent/chief_albert_luthuli/index');	
	}
	
	public function lekwa(){	
		$this->view->render('to_rent/lekwa/index');	
	}
	
	public function emakhazeni(){	
		$this->view->render('to_rent/emakhazeni/index');	
	}
	
	public function emalaleni(){	
		$this->view->render('to_rent/emalaleni/index');	
	}
	
	public function victor_khanye(){	
		$this->view->render('to_rent/victor_khanye/index');	
	}
	
	public function mbombela(){	
		$this->view->render('to_rent/mbombela/index');	
	}
	
	public function dipaleseng(){	
		$this->view->render('to_rent/dipaleseng/index');	
	}
	
	public function mkhondo(){	
		$this->view->render('to_rent/mkhondo/index');	
	}
	
	public function nkomazi(){	
		$this->view->render('to_rent/nkomazi/index');	
	}
	
	public function pixley_ka_isaka_seme(){	
		$this->view->render('to_rent/pixley_ka_isaka_seme/index');	
	}
		
	public function msukaligwa(){	
		$this->view->render('to_rent/msukaligwa/index');	
	}
	
	public function steve_tshwete(){	
		$this->view->render('to_rent/steve_tshwete/index');	
	}
	
	public function thaba_chewu(){	
		$this->view->render('to_rent/thaba_chewu/index');	
	}
	
	public function govan_mbeki(){	
		$this->view->render('to_rent/govan_mbeki/index');	
	}
	
	public function js_moroka(){	
		$this->view->render('to_rent/js_moroka/index');	
	}
	
	public function thembisile_hani(){	
		$this->view->render('to_rent/thembisile_hani/index');	
	}

	
	//NORTH WEST
	public function north_west(){	
		$this->view->render('to_rent/north_west/index');	
	}
	
	public function kgetlengrivier(){	
		$this->view->render('to_rent/kgetlengrivier/index');	
	}
	
	public function rustenburg(){	
		$this->view->render('to_rent/rustenburg/index');	
	}
	
	public function greater_taung(){	
		$this->view->render('to_rent/greater_taung/index');	
	}
	
	public function naledi(){	
		$this->view->render('to_rent/naledi/index');	
	}
	
	public function ratlou(){	
		$this->view->render('to_rent/ratlou/index');	
	}
	
	public function madibeng(){	
		$this->view->render('to_rent/madibeng/index');	
	}
	
	public function matlosana(){	
		$this->view->render('to_rent/matlosana/index');	
	}
	
	public function kagisano_molopo(){	
		$this->view->render('to_rent/kagisano_molopo/index');	
	}
	
	public function ditsobotla(){	
		$this->view->render('to_rent/ditsobotla/index');	
	}
	
	public function tswaing(){	
		$this->view->render('to_rent/tswaing/index');	
	}
	
	public function moretele(){	
		$this->view->render('to_rent/moretele/index');	
	}
	
	public function jb_marks(){	
		$this->view->render('to_rent/jb_marks/index');	
	}
	
	public function lekwa_teemane(){	
		$this->view->render('to_rent/lekwa_teemane/index');	
	}
	
	public function mafikeng(){	
		$this->view->render('to_rent/mafikeng/index');	
	}
	
	public function moses_kotane(){	
		$this->view->render('to_rent/moses_kotane/index');	
	}
	
	public function maquassi_hills(){	
		$this->view->render('to_rent/maquassi_hills/index');	
	}
	
	public function mamusa(){	
		$this->view->render('to_rent/mamusa/index');	
	}
	
	public function ramotshere_moiloa(){	
		$this->view->render('to_rent/ramotshere_moiloa/index');	
	}
	
	//NORTHERN CAPE
	public function northern_cape(){	
		$this->view->render('to_rent/northern_cape/index');	
	}
	
	public function dikgatlong(){	
		$this->view->render('to_rent/dikgatlong/index');	
	}
	
	public function segonyana(){	
		$this->view->render('to_rent/segonyana/index');	
	}
	
	public function kamiesberg(){	
		$this->view->render('to_rent/kamiesberg/index');	
	}
	
	public function richtersveld(){	
		$this->view->render('to_rent/richtersveld/index');	
	}
	
	public function siyancuma(){	
		$this->view->render('to_rent/siyancuma/index');	
	}
	
	public function umsobomvu(){	
		$this->view->render('to_rent/umsobomvu/index');	
	}
	
	public function kai_garib(){	
		$this->view->render('to_rent/kai_garib/index');	
	}
	
	public function magareng(){	
		$this->view->render('to_rent/magareng/index');	
	}
	
	public function gamagara(){	
		$this->view->render('to_rent/gamagara/index');	
	}
	
	public function karoo_hoogland(){	
		$this->view->render('to_rent/karoo_hoogland/index');	
	}
	
	public function emthanjeni(){	
		$this->view->render('to_rent/emthanjeni/index');	
	}
	
	public function siyathemba(){	
		$this->view->render('to_rent/siyathemba/index');	
	}
	
	public function tsantsabane(){	
		$this->view->render('to_rent/tsantsabane/index');	
	}
	
	public function kgatelopele(){	
		$this->view->render('to_rent/kgatelopele/index');	
	}
	
	public function phokwane(){	
		$this->view->render('to_rent/phokwane/index');	
	}
	
	public function joe_morolong(){	
		$this->view->render('to_rent/joe_morolong/index');	
	}
	
	public function kareeberg(){	
		$this->view->render('to_rent/kareeberg/index');	
	}
	
	public function thembelihle(){	
		$this->view->render('to_rent/thembelihle/index');	
	}
	
	public function kheis(){	
		$this->view->render('to_rent/kheis/index');	
	}
	
	public function sol_plaatje(){	
		$this->view->render('to_rent/sol_plaatje/index');	
	}
	
	public function hantam(){	
		$this->view->render('to_rent/hantam/index');	
	}
	
	public function nama_khoi(){	
		$this->view->render('to_rent/nama_khoi/index');	
	}
	
	public function renosterberg(){	
		$this->view->render('to_rent/renosterberg/index');	
	}
	
	public function ubuntu(){	
		$this->view->render('to_rent/ubuntu/index');	
	}
	
	public function dawid_kruiper(){	
		$this->view->render('to_rent/dawid_kruiper/index');	
	}
	
	public function khai_ma(){	
		$this->view->render('to_rent/khai_ma/index');	
	}
}