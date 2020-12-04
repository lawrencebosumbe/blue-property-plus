<?php

class On_Show extends Controller {

	public function __construct() {
		parent::__construct();	
	}
	
	public function index() {	
		$this->view->render('on_show/inc/header');
		$this->view->render('on_show/index');
		$this->view->render('on_show/inc/footer');
	}	

	//GAUTENG
	public function gauteng(){	
		$this->view->render('on_show/gauteng/index');	
	}
	
	public function johannesburg(){	
		$this->view->render('on_show/johannesburg/index');	
	}
		
	public function pretoria(){	
		$this->view->render('on_show/pretoria/index');				
	}
		
	public function ekurhuleni(){	
		$this->view->render('on_show/ekurhuleni/index');				
	}
		
	public function emfuleni(){	
		$this->view->render('on_show/emfuleni/index');				
	}	
		
	public function lesedi(){	
		$this->view->render('on_show/lesedi/index');				
	}	
		
	public function merafong(){	
		$this->view->render('on_show/merafong/index');				
	}
		
	public function midvaal(){	
		$this->view->render('on_show/midvaal/index');				
	}
		
	public function mogale(){	
		$this->view->render('on_show/mogale/index');				
	}
		
	public function rand_west(){	
		$this->view->render('on_show/rand_west/index');				
	}
	
	//EASTERN CAPE
	public function eastern_cape(){	
		$this->view->render('on_show/eastern_cape/index');				
	}
	
	public function amahlathi(){	
		$this->view->render('on_show/amahlathi/index');				
	}
	
	public function blue_crane_route(){	
		$this->view->render('on_show/blue_crane_route/index');				
	}
	public function buffalo_city(){	
		$this->view->render('on_show/buffalo_city/index');				
	}
	public function beyers_naude(){	
		$this->view->render('on_show/beyers_naude/index');				
	}
	public function elundini(){	
		$this->view->render('on_show/elundini/index');				
	}

	public function engcobo(){	
		$this->view->render('on_show/engcobo/index');				
	}
	public function enoch_mgijima(){	
		$this->view->render('on_show/enoch_mgijima/index');				
	}
	public function great_kei(){	
		$this->view->render('on_show/great_kei/index');				
	}
	public function ingquza_hill(){	
		$this->view->render('on_show/ingquza_hill/index');				
	}
	public function intsika_yethu(){	
		$this->view->render('on_show/intsika_yethu/index');				
	}
	public function ixhuba_yethemba(){	
		$this->view->render('on_show/ixhuba_yethemba/index');				
	}
	public function king_sabata(){	
		$this->view->render('on_show/king_sabata/index');				
	}
	public function kouga(){	
		$this->view->render('on_show/kouga/index');				
	}
	public function koukamma(){	
		$this->view->render('on_show/koukamma/index');				
	}
	public function makana(){	
		$this->view->render('on_show/makana/index');				
	}
	public function matatiele(){	
		$this->view->render('on_show/matatiele/index');				
	}
	public function mbhashe(){	
		$this->view->render('on_show/mbhashe/index');				
	}
	public function mbizana(){	
		$this->view->render('on_show/mbizana/index');				
	}
	public function mhlontlo(){	
		$this->view->render('on_show/mhlontlo/index');				
	}
	public function mnquma(){	
		$this->view->render('on_show/mnquma/index');				
	}		
	public function ndlambe(){	
		$this->view->render('on_show/ndlambe/index');				
	}
	public function nelson_mandela_bay(){	
		$this->view->render('on_show/nelson_mandela_bay/index');				
	}
	public function ngqushwa(){	
		$this->view->render('on_show/ngqushwa/index');				
	}
	public function nkonkobe(){	
		$this->view->render('on_show/nkonkobe/index');				
	}
	public function ntabankulu(){	
		$this->view->render('on_show/ntabankulu/index');				
	}
	public function nyandeni(){	
		$this->view->render('on_show/nyandeni/index');				
	}
	public function port_st_johns(){	
		$this->view->render('on_show/port_st_johns/index');				
	}
	public function raymond_mhlaba(){	
		$this->view->render('on_show/raymond_mhlaba/index');				
	}
	public function sakhisizwe(){	
		$this->view->render('on_show/sakhisizwe/index');				
	}
	public function senqu(){	
		$this->view->render('on_show/senqu/index');				
	}
	public function sunday_river_valley(){	
		$this->view->render('on_show/sunday_river_valley/index');				
	}
	
	public function umzimvubu(){	
		$this->view->render('on_show/umzimvubu/index');				
	}
	
	public function walter_sisulu(){	
		$this->view->render('on_show/walter_sisulu/index');				
	}
	
	//FREE STATE
	public function free_state(){	
		$this->view->render('on_show/free_state/index');	
	}
	
	public function dihlabeng(){	
		$this->view->render('on_show/dihlabeng/index');	
	}
	
	public function kopanong(){	
		$this->view->render('on_show/kopanong/index');	
	}
	
	public function letsemeng(){	
		$this->view->render('on_show/letsemeng/index');	
	}
	
	public function mafube(){	
		$this->view->render('on_show/mafube/index');	
	}
	
	public function maluti_a_phofung(){	
		$this->view->render('on_show/maluti_a_phofung/index');	
	}
	
	public function mangaung_metropolitan(){	
		$this->view->render('on_show/mangaung_metropolitan/index');	
	}
	
	public function mantsopa(){	
		$this->view->render('on_show/mantsopa/index');	
	}
	
	public function masilonyana(){	
		$this->view->render('on_show/masilonyana/index');	
	}
	
	public function matjhabeng(){	
		$this->view->render('on_show/matjhabeng/index');	
	}
	
	public function metsimaholo(){	
		$this->view->render('on_show/metsimaholo/index');	
	}
	
	public function mohokare(){	
		$this->view->render('on_show/mohokare/index');	
	}
	
	public function moqhaka(){	
		$this->view->render('on_show/moqhaka/index');	
	}
	
	public function nala(){	
		$this->view->render('on_show/nala/index');	
	}
	
	public function ngwathe(){	
		$this->view->render('on_show/ngwathe/index');	
	}
	
	public function nketoana(){	
		$this->view->render('on_show/nketoana/index');	
	}
	
	public function phumelela(){	
		$this->view->render('on_show/phumelela/index');	
	}
	
	public function setseto(){	
		$this->view->render('on_show/setseto/index');	
	}
	
	public function tokologo(){	
		$this->view->render('on_show/tokologo/index');	
	}
	
	public function tswelopele(){	
		$this->view->render('on_show/tswelopele/index');	
	}
	
	//KWAZULU NATAL
	public function kwazulu_natal(){	
		$this->view->render('on_show/kwazulu_natal/index');	
	}
	
	public function abaqulusi(){
		$this->view->render('on_show/abaqulusi/index');
	}		
				
	public function alfred_duma(){
		$this->view->render('on_show/alfred_duma/index');
	}
		
	public function big_5_hlabisa(){
		$this->view->render('on_show/big_5_hlabisa/index');
	}
		
	public function dannhause(){
		$this->view->render('on_show/dannhause/index');
	}
		
	public function edumbe(){
		$this->view->render('on_show/edumbe/index');
	}
		
	public function emadlangeni(){
		$this->view->render('on_show/emadlangeni/index');
	}
		
	public function endumeni(){
		$this->view->render('on_show/endumeni/index');
	}
		
	public function ethekwini(){
		$this->view->render('on_show/ethekwini/index');
	}
		
	public function greater_kokstad(){
		$this->view->render('on_show/greater_kokstad/index');
	}
		
	public function impendle(){
		$this->view->render('on_show/impendle/index');
	}
		
	public function jozini(){
		$this->view->render('on_show/jozini/index');
	}
		
	public function kwadukuza(){
		$this->view->render('on_show/kwadukuza/index');
	}
		
	public function mandeni(){
		$this->view->render('on_show/mandeni/index');
	}
		
	public function maphumulo(){
		$this->view->render('on_show/maphumulo/index');
	}
		
	public function mkhambathini(){
		$this->view->render('on_show/mkhambathini/index');
	}
		
	public function mpofana(){
		$this->view->render('on_show/mpofana/index');
	}
		
	public function msinga(){
		$this->view->render('on_show/msinga/index');
	}
		
	public function msunduzi(){
		$this->view->render('on_show/msunduzi/index');
	}
		
	public function mthonjaneni(){
		$this->view->render('on_show/mthonjaneni/index');
	}
		
	public function mtubatuba(){
		$this->view->render('on_show/mtubatuba/index');
	}
		
	public function ndwedwe(){
		$this->view->render('on_show/ndwedwe/index');
	}
		
	public function newcastle(){
		$this->view->render('on_show/newcastle/index');
	}
		
	public function nkandla(){
		$this->view->render('on_show/nkandla/index');
	}
		
	public function nkosazana_dlamini_zuma(){
		$this->view->render('on_show/nkosazana_dlamini_zuma/index');
	}
		
	public function nkosi_langalibalele(){
		$this->view->render('on_show/nkosi_langalibalele/index');
	}
		
	public function nongoma(){
		$this->view->render('on_show/nongoma/index');
	}
		
	public function nquthu(){
		$this->view->render('on_show/nquthu/index');
	}
		
	public function okhahlamba(){
		$this->view->render('on_show/okhahlamba/index');
	}
		
	public function ray_nkonenyi(){
		$this->view->render('on_show/ray_nkonenyi/index');
	}
		
	public function richmond(){
		$this->view->render('on_show/richmond/index');
	}
		
	public function ubuhlebezwe(){
		$this->view->render('on_show/ubuhlebezwe/index');
	}
		
	public function ulundi(){
		$this->view->render('on_show/ulundi/index');
	}
		
	public function umdoni(){
		$this->view->render('on_show/umdoni/index');
	}
		
	public function umfolozi(){
		$this->view->render('on_show/umfolozi/index');
	}
		
	public function umhlabuyalingana(){
		$this->view->render('on_show/umhlabuyalingana/index');
	}
		
	public function umhlathuze(){
		$this->view->render('on_show/umhlathuze/index');
	}
		
	public function umlalazi(){
		$this->view->render('on_show/umlalazi/index');
	}
		
	public function umngeni(){
		$this->view->render('on_show/umngeni/index');
	}
		
	public function umshwathi(){
		$this->view->render('on_show/umshwathi/index');
	}
		
	public function umvoti(){
		$this->view->render('on_show/umvoti/index');
	}
		
	public function umzimkhulu(){
			$this->view->render('on_show/umzimkhulu/index');
	}		
				
	public function umziwabantu(){
		$this->view->render('on_show/umziwabantu/index');
	}
		
	public function umzumbe(){
		$this->view->render('on_show/umzumbe/index');
	}
		
	public function uphongolo(){
		$this->view->render('on_show/uphongolo/index');
	}
	
	//WESTERN CAPE
	public function western_cape(){
		$this->view->render('on_show/western_cape/index');
	}

	public function cape_town(){	
		$this->view->render('on_show/cape_town/index');	
	}
		
	public function breede_valley(){	
		$this->view->render('on_show/breede_valley/index');	
	}
		
	public function drakenstein(){	
		$this->view->render('on_show/drakenstein/index');	
	}
		
	public function stellenbosch(){	
		$this->view->render('on_show/stellenbosch/index');	
	}
		
	public function witzenberg(){	
		$this->view->render('on_show/witzenberg/index');	
	}
		
	public function langeberg(){	
		$this->view->render('on_show/langeberg/index');	
	}
		
	public function george(){	
		$this->view->render('on_show/george/index');	
	}
		
	public function cape_agulhas(){	
		$this->view->render('on_show/cape_agulhas/index');	
	}
		
	public function bergrivier(){	
		$this->view->render('on_show/bergrivier/index');	
	}
		
	public function swartland(){	
		$this->view->render('on_show/swartland/index');	
	}
		
	public function beaufort_west(){	
		$this->view->render('on_show/beaufort_west/index');	
	}
		
	public function laingsburg(){	
		$this->view->render('on_show/laingsburg/index');	
	}
		
	public function hessequa(){	
		$this->view->render('on_show/hessequa/index');	
	}
		
	public function overstrand(){	
		$this->view->render('on_show/overstrand/index');	
	}
		
	public function cederberg(){	
		$this->view->render('on_show/cederberg/index');	
	}
		
	public function oudtshoorn(){	
		$this->view->render('on_show/oudtshoorn/index');	
	}
		
	public function prince_albert(){	
		$this->view->render('on_show/prince_albert/index');	
	}
		
	public function kannaland(){	
		$this->view->render('on_show/kannaland/index');	
	}
		
	public function swellendam(){	
		$this->view->render('on_show/swellendam/index');	
	}
		
	public function matzikama(){	
		$this->view->render('on_show/matzikama/index');	
	}
		
	public function mossel_bay(){	
		$this->view->render('on_show/mossel_bay/index');	
	}
		
	public function bitou(){	
		$this->view->render('on_show/bitou/index');	
	}
		
	public function knysna(){	
		$this->view->render('on_show/knysna/index');	
	}
		
	public function theewaterskloof(){	
		$this->view->render('on_show/theewaterskloof/index');	
	}
		
	public function saldanha_bay(){	
		$this->view->render('on_show/saldanha_bay/index');	
	}	
	
	//LIMPOPO
	public function limpopo(){	
		$this->view->render('on_show/limpopo/index');	
	}
	
	public function blouberg(){	
		$this->view->render('on_show/blouberg/index');	
	}
	
	public function phalaborwa(){	
		$this->view->render('on_show/phalaborwa/index');	
	}
	
	public function maruleng(){	
		$this->view->render('on_show/maruleng/index');	
	}
	
	public function makhuduthamaga(){	
		$this->view->render('on_show/makhuduthamaga/index');	
	}
	
	public function thulamela(){	
		$this->view->render('on_show/thulamela/index');	
	}
	
	public function mogalakwena(){	
		$this->view->render('on_show/mogalakwena/index');	
	}
	
	public function lepelle_nkumpi(){	
		$this->view->render('on_show/lepelle_nkumpi/index');	
	}
	
	public function giyani(){	
		$this->view->render('on_show/giyani/index');	
	}
	
	public function elias_motsoaledi(){	
		$this->view->render('on_show/elias_motsoaledi/index');	
	}
	
	public function collins_chabane(){	
		$this->view->render('on_show/collins_chabane/index');	
	}
	
	public function bela_bela(){	
		$this->view->render('on_show/bela_bela/index');	
	}
	
	public function thabazimbi(){	
		$this->view->render('on_show/thabazimbi/index');	
	}
	
	public function molemole(){	
		$this->view->render('on_show/molemole/index');	
	}
	
	public function letaba(){	
		$this->view->render('on_show/letaba/index');	
	}
	
	public function ephraim_mogale(){	
		$this->view->render('on_show/ephraim_mogale/index');	
	}
	
	public function makhado(){	
		$this->view->render('on_show/makhado/index');	
	}
	
	public function lephalale(){	
		$this->view->render('on_show/lephalale/index');	
	}
	
	public function polokwane(){	
		$this->view->render('on_show/polokwane/index');	
	}
	
	public function tzaneen(){	
		$this->view->render('on_show/tzaneen/index');	
	}
	
	public function fetakgomo(){	
		$this->view->render('on_show/fetakgomo/index');	
	}
	
	public function musina(){	
		$this->view->render('on_show/musina/index');	
	}
	
	public function modimolle(){	
		$this->view->render('on_show/modimolle/index');	
	}
	
	//MPUMALANGA
	public function mpumalanga(){	
		$this->view->render('on_show/mpumalanga/index');	
	}
	
	public function bushbuckridge(){	
		$this->view->render('on_show/bushbuckridge/index');	
	}
	
	public function chief_albert_luthuli(){	
		$this->view->render('on_show/chief_albert_luthuli/index');	
	}
	
	public function lekwa(){	
		$this->view->render('on_show/lekwa/index');	
	}
	
	public function emakhazeni(){	
		$this->view->render('on_show/emakhazeni/index');	
	}
	
	public function victor_khanye(){	
		$this->view->render('on_show/victor_khanye/index');	
	}
	
	public function mbombela(){	
		$this->view->render('on_show/mbombela/index');	
	}
	
	public function dipaleseng(){	
		$this->view->render('on_show/dipaleseng/index');	
	}
	
	public function mkhondo(){	
		$this->view->render('on_show/mkhondo/index');	
	}
	
	public function emalaleni(){	
		$this->view->render('on_show/emalaleni/index');	
	}
	
	public function nkomazi(){	
		$this->view->render('on_show/nkomazi/index');	
	}
	
	public function pixley_ka_isaka_seme(){	
		$this->view->render('on_show/pixley_ka_isaka_seme/index');	
	}
		
	public function msukaligwa(){	
		$this->view->render('on_show/msukaligwa/index');	
	}
	
	public function steve_tshwete(){	
		$this->view->render('on_show/steve_tshwete/index');	
	}
	
	public function thaba_chewu(){	
		$this->view->render('on_show/thaba_chewu/index');	
	}
	
	public function govan_mbeki(){	
		$this->view->render('on_show/govan_mbeki/index');	
	}
	
	public function js_moroka(){	
		$this->view->render('on_show/js_moroka/index');	
	}

	
	//NORTH WEST
	public function north_west(){	
		$this->view->render('on_show/north_west/index');	
	}
	
	public function kgetlengrivier(){	
		$this->view->render('on_show/kgetlengrivier/index');	
	}
	
	public function rustenburg(){	
		$this->view->render('on_show/rustenburg/index');	
	}
	
	public function greater_taung(){	
		$this->view->render('on_show/greater_taung/index');	
	}
	
	public function naledi(){	
		$this->view->render('on_show/naledi/index');	
	}
	
	public function ratlou(){	
		$this->view->render('on_show/ratlou/index');	
	}
	
	public function madibeng(){	
		$this->view->render('on_show/madibeng/index');	
	}
	
	public function matlosana(){	
		$this->view->render('on_show/matlosana/index');	
	}
	
	public function kagisano_molopo(){	
		$this->view->render('on_show/kagisano_molopo/index');	
	}
	
	public function ditsobotla(){	
		$this->view->render('on_show/ditsobotla/index');	
	}
	
	public function tswaing(){	
		$this->view->render('on_show/tswaing/index');	
	}
	
	public function moretele(){	
		$this->view->render('on_show/moretele/index');	
	}
	
	public function jb_marks(){	
		$this->view->render('on_show/jb_marks/index');	
	}
	
	public function lekwa_teemane(){	
		$this->view->render('on_show/lekwa_teemane/index');	
	}
	
	public function mafikeng(){	
		$this->view->render('on_show/mafikeng/index');	
	}
	
	public function moses_kotane(){	
		$this->view->render('on_show/moses_kotane/index');	
	}
	
	public function maquassi_hills(){	
		$this->view->render('on_show/maquassi_hills/index');	
	}
	
	public function mamusa(){	
		$this->view->render('on_show/mamusa/index');	
	}
	
	public function ramotshere_moiloa(){	
		$this->view->render('on_show/ramotshere_moiloa/index');	
	}
	
	//NORTHERN CAPE
	public function northern_cape(){	
		$this->view->render('on_show/northern_cape/index');	
	}
	
	public function dikgatlong(){	
		$this->view->render('on_show/dikgatlong/index');	
	}
	
	public function segonyana(){	
		$this->view->render('on_show/segonyana/index');	
	}
	
	public function kamiesberg(){	
		$this->view->render('on_show/kamiesberg/index');	
	}
	
	public function richtersveld(){	
		$this->view->render('on_show/richtersveld/index');	
	}
	
	public function siyancuma(){	
		$this->view->render('on_show/siyancuma/index');	
	}
	
	public function umsobomvu(){	
		$this->view->render('on_show/umsobomvu/index');	
	}
	
	public function kai_garib(){	
		$this->view->render('on_show/kai_garib/index');	
	}
	
	public function magareng(){	
		$this->view->render('on_show/magareng/index');	
	}
	
	public function gamagara(){	
		$this->view->render('on_show/gamagara/index');	
	}
	
	public function karoo_hoogland(){	
		$this->view->render('on_show/karoo_hoogland/index');	
	}
	
	public function emthanjeni(){	
		$this->view->render('on_show/emthanjeni/index');	
	}
	
	public function siyathemba(){	
		$this->view->render('on_show/siyathemba/index');	
	}
	
	public function tsantsabane(){	
		$this->view->render('on_show/tsantsabane/index');	
	}
	
	public function kgatelopele(){	
		$this->view->render('on_show/kgatelopele/index');	
	}
	
	public function phokwane(){	
		$this->view->render('on_show/phokwane/index');	
	}
	
	public function joe_morolong(){	
		$this->view->render('on_show/joe_morolong/index');	
	}
	
	public function kareeberg(){	
		$this->view->render('on_show/kareeberg/index');	
	}
	
	public function thembelihle(){	
		$this->view->render('on_show/thembelihle/index');	
	}
	
	public function khai_ma(){	
		$this->view->render('on_show/khai_ma/index');	
	}
	
	public function kheis(){	
		$this->view->render('on_show/kheis/index');	
	}
	
	public function sol_plaatje(){	
		$this->view->render('on_show/sol_plaatje/index');	
	}
	
	public function hantam(){	
		$this->view->render('on_show/hantam/index');	
	}
	
	public function nama_khoi(){	
		$this->view->render('on_show/nama_khoi/index');	
	}
	
	public function renosterberg(){	
		$this->view->render('on_show/renosterberg/index');	
	}
	
	public function ubuntu(){	
		$this->view->render('on_show/ubuntu/index');	
	}
	
	public function dawid_kruiper(){	
		$this->view->render('on_show/dawid_kruiper/index');	
	}
	
	public function thembisile_hani(){	
			$this->view->render('on_show/thembisile_hani/index');				
		}
}