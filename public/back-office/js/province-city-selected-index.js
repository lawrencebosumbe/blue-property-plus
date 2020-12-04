/*
--------------------------------------------------------

PROVINCE - MUNICIPALITY - CITY SELECTED INDEX

--------------------------------------------------------
*/

var countryStateInfo = {
		"Eastern Cape": {
			"Amahlathi": {
				"Cathcart": [""],
				"Stutterheim": [""],
				"Keiskammahoek": [""]
			},
			"Blue Crane Route": {
				"Cookhouse": [""],
				"Pearston": [""],
				"Somerest East": [""]
			},
			"Buffalo City": {
				"King's William Town": [""],   
				"East London": [""]
			},
			"Dr Beyers Naude": {
				"Aberdeen": [""],   
				"Graaff-Reinet": [""],
				"Jansenville": [""],
				"Klipplaat": [""],
				"Steytlerville": [""],
				"Willowmore": [""]
			},
			"Elundini": {
				"Maclear": [""]
			},
			"Emalahleni": {
				"Dordrecht": [""]
			},
			"Engcobo": {
				"Engcobo": [""] 
			},
			"Enoch Mgijima": {
				"Hofmeyr": [""],   
				"Queenstown": [""],
				"Sterkstroom": [""],
				"Whittlesea": [""]
			},
			"Great Kei": {
				"Komga": [""]
			},
			"Ingquza Hill": {
				"Flagstaff": [""],   
				"Lusikisiki": [""]
			},
			"Intsika Yethu": {
				"Cofimvaba": [""],   
				"Tsomo": [""]
			},
			"Ixhuba Yethemba": {
				"Cradock": [""],   
				"Middelburg": [""]
			},
			"King Sabata": {
				"Mqanduli": [""],   
				"Mthatha": [""]
			},
			"Kouga": {
				"Hankey": [""],   
				"Humansdorp": [""],
				"Jeffreys Bay": [""]
			},
			"Koukamma": {
				"Joubertina": [""]
			},
			"Makana": {
				"Grahamstown": [""]
			},
			"Matatiele": {
				"Matatiele": [""]
			},
			"Mbhashe": {
				"Elliotdale": [""],   
				"Willowvale": [""]
			},
			"Mbizana": {
				"Bizana": [""]
			},
			"Mhlontlo": {
				"Qumbu": [""],   
				"Tsolo": [""]
			},
			"Mnquma": {
				"Butterworth": [""],   
				"Kentani": [""]
			},
			"Ndlambe": {
				"Alexandria": [""],   
				"Buthurst": [""]
			},
			"Nelson Mandela Bay": {
				"Port Elizabeth": [""]
			},
			"Ngqushwa": {
				"Peddie": [""] 
			},
			"Ntabankulu": {
				"Ntabankulu": [""]
			},
			"Nyandeni": {
				"Libode": [""],   
				"Ngqeleni": [""]
			},
			"Port St Johns": {
				"Port St Johns": [""]
			},
			"Raymond Mhlaba": {
				"Adelaide": [""],   
				"Alice": [""]
			},
			"Sakhisizwe": {
				"Cela": [""]
			},
			"Senqu": {
				"Barkly East": [""],   
				"Barkly West": [""]
			},
			"Sunday River Valley": {
				"Addo": [""],   
				"Kirkwood": [""],
				"Paterson": [""]
			},
			"Umzimvubu": {
				"Mount Ayliff": [""],   
				"Mount Frere": [""]
			},
			"Walter Sisilu": {
				"Aliwal North": [""],   
				"Burgersdorp": [""],
				"Steynsburg": [""],
				"Venterstad": [""],
			}
		},
		"Free State": {
			"Dihlabeng": {
				"Bethlehem": [""],
				"Clarens" : [""],  
				"Fouries" : [""], 
				"Paul Roux" : [""], 
				"Rosendal" : [""] 
			},
			"Kopanong": {
				"Bethulie" : [""],
				"Edenburg" : [""],
				"Fauresmith" : [""],
				"Jaggersfontein" : [""],
				"Philipolis" : [""],
				"Reddersburg" : [""],
				"Springfontein" : [""],
				"Trompsburg" : [""],
				"Waterkloof" : [""]
			},
			"Letsemeng": {
				"Jacobsdal" : [""],
				"Koffiefontein" : [""],
				"Luckoff" : [""],
				"Petrusburg" : [""]  
			},
			"Mafube": {
				"Comelia" : [""],
				"Frankfort" : [""],
				"Tweeling" : [""],
				"Viliers" : [""]   
			},
			"Maluti-A-Phofung": {
				"Harismith" : [""],
				"Kestell" : [""],
				"Phuthaditjhaba" : [""],   
			},
			"Mangaung Metropolitan": {
				"Bloemfontein" : [""],
				"Botshabelo" : [""],
				"Dewetsdorp" : [""],
				"Wepener" : [""],
				"Thaba Nchu" : [""]
			},
			"Mantsopa": {
				"Excelsior" : [""],
				"Hobhouse" : [""],
				"Ladybrand" : [""]   
			},
			"Masilonyana": {
				"Brandfort" : [""],
				"Theunissen" : [""],
				"Winburg" : [""]   
			},
			"Matjhabeng": {
				"Odendaalrus" : [""], 
				"Ventersburg" : [""],
				"Virgina" : [""],
				"Welkom" : [""]
			},
			"Metsimaholo": {
				"Deneysville" : [""],
				"Kragbron" : [""],
				"Oranjeville" : [""],
				"Sasolburg" : [""]   
			},
			"Mohokare": {
				"Rouxville" : [""],
				"Smithfield" : [""],
				"Zastron" : [""]  
			},
			"Moqhaka": {
				"Kroonstad" : [""],
				"Viljoenskroon" : [""] 
			},
			"Nala": {
				"Bothaville" : [""],
				"Wesselsbron" : [""]  
			},
			"Ngwathe": {
				"Edenville" : [""],
				"Heilbron" : [""],
				"Koppies" : [""],
				"Parys" : [""],
				"Vredefort" : [""]   
			},
			"Nketoana": {
				 "Arlington" : [""],
				"Lindley" : [""],
				"Petrus Steyn" : [""],
				"Reitz" : [""], 
			},
			"Phumelela": {
				"Vrede" : [""],
				"Warden" : [""]  
			},
			"Setseto": {
				"Clocolan" : [""],
				"Ficksburg" : [""],
				"Senekal" : [""]  
			},
			"Tokologo": {
				"Boshof" : [""],
				"Dealesville" : [""],
				"Hertzogville" : [""]   
			},
			"Tswelopele": {
				"Bultfontein" : [""]     
			}
		},
		"Gauteng": {
			"City of Johannesburg": {
				"Abbotsford" : [""],
				"Albertskroon" : [""],
				"Albertville" : [""],
				"Alexandra" : [""],
				"Amalgam" : [""],
				"Auckland Park" : [""],
				"Constansia Kloof" : [""],
				"Diepkloof" : [""],
				"Diepsloot" : [""],
				"Dobsonville" : [""],
				"Doornkop" : [""],
				"Ennerdale" : [""],
				"Ebony Park" : [""],
				"Fourways" : [""],
				"Hyde Park" : [""],
				"Highlands North" : [""],
				"Ivory Park" : [""],
				"Johannesburg" : [""],
				"Katlehong" : [""],
				"Lawley" : [""],
				"Lenesia" : [""],
				"Marboro Gardens" : [""],
				"Maroeland" : [""],
				"Meadowlands" : [""],
				"Melville" : [""],
				"Midrand" : [""],
				"Morning Side" : [""],
				"Nasrec" : [""],
				"Noordgesig" : [""],
				"Orang Farm" : [""],
				"Parktown" : [""],
				"Paulshof" : [""],
				"Phiri" : [""],
				"Protea Glen" : [""],
				"Rabie Ridge" : [""],
				"Randburg" : [""],
				"Rivonia" : [""],
				"Rosebank" : [""],
				"Roodepoort" : [""],
				"Sandton" : [""],
				"Soweto" : [""],				
				"Zendspruit" : [""],
				"Zola" : [""]
			},
			"City of Pretoria": {
				"Atteridgeville" : [""],
				"Bronberg" : [""],
				"Bronkhostspruit" : [""],
				"Centurion" : [""],
				"Cullinan" : [""],
				"Hammaskraal" : [""],
				"Ga-Rankuwa" : [""],
				"Irene" : [""],
				"Mabopane" : [""],
				"Mamelodi" : [""],
				"Pretoria" : [""],
				"Rayton" : [""],
				"Refilwe" : [""],
				"Soshanguve" : [""],
				"Zithobeni" : [""]
			},
			"Ekurhuleni": {
				"Alberton": ["Aberton City"],
				"Benoni" : [""],
				"Boksburg": [""],
				"Brakpan": [""],
				"Daveyton": [""],
				"Duduza": [""],
				"Edenvale": [""],
				"ethwathwa": [""],
				"Germiston": [""],
				"Katlehong": [""],
				"KwaThemba": [""],
				"Kempton Park": [""],
				"Nigel": [""],
				"Springs": [""],
				"Tembisa": [""],
				"Thokoza": [""],
				"Tsakane": [""],
				"Vosloorus": [""],
				"Isando": [""],
				"Bedfordview": [""]
			},
			"Emfuleni": {
				"Boipatong" : [""],
				"Bophelong" : [""],
				"Evaton" : [""],
				"Sebokeng" : [""],
				"Sharpeville" : [""],
				"Vanderbijlpark" : [""],
				"Vereeniging" : [""]
			},
			"Lesedi": {
				"Heidelberg" : [""],
				"Ratanda" : [""],
				"Devon" : [""],
				"Impumelelo" : [""]
			},
			"Midvaal": {
				"Meyerton" : [""],
				"Vaal Marina" : [""],
				"Randvaal" : [""],
				"Walkerville" : [""]
			},
			"Merafong City": {
				"Carletonville" : [""],
				"Khutsong" : [""],
				"Fochville" : [""],
				"Kokosi" : [""],
				"Greenspark" : [""]
			},
			"Mogale City": {
				"Chamdor" : [""],
				"Dan Pienaarville" : [""],
				"Delporton" : [""],
				"Factoria" : [""],
				"Hekpoort" : [""],
				"Kagiso" : [""],
				"Kenmare" : [""],
				"Kroomdraai" : [""],
				"Krugersdorp" : [""],
				"Magaliesburg" : [""],
				"Monument" : [""],
				"Muldersdrift" : [""],
				"Munsieville" : [""],
				"Noordheuwel" : [""],
				"Rangeview" : [""],
				"Rievallei" : [""],
				"Silverfields" : [""],
				"Tarlton" : [""]
			},
			"Rand West City": {
				"Aureus" : [""],
				"Bekkersdal" : [""],
				"Delmas" : [""],
				"Randfontein" : [""],				
				"Westonaria" : [""]
			}
		},
		"Kwa-Zulu Natal": {
			"Abaqulusi": {
				"Vryheid": [""]
			},
			"Alfred Duma": {
				"Colenso": [""],
				"Ladysmith": [""]
			},
			"Big 5 Hlabisa": {
				"Hlabisa": [""],
				"Hluhluwe": [""] 
			},
			"City of Umhlathuze": {
				"Empangweni": [""],
				"Richards Bay": [""] 
			},
			"Dannhause": {
				"Dannhauser": [""] 
			},
			"Edumbe": {
				"Paulpietersburg": [""] 
			},
			"Emadlangeni": {
				"Utrecht": [""] 
			},
			"Endumeni": {
				"Dundee": [""],
				"Glencoe": [""] 
			},
			"Ethekwini": {
				"Amamzimtoti": [""],
				"Chartsworth": [""],
				"Durban": [""],
				"Hammardale": [""],
				"Isipingo Beach": [""],
				"Pinetown": [""],
				"Tongaat": [""],
				"Umlanga": [""],
				"Umkomaas": [""],
				"Umlazi": [""],
				"Verulam": [""] 
			},
			"Greater Kokstad": {
				"Kokstad": [""]
			},
			"Jozini": {
				"Ingwavuma": [""],
				"Jozini": [""] 
			},
			"Kwadukuza": {
				"Tongaat": [""]
			},
			"Mandeni": {
				"Mandeni": [""] 
			},
			"Maphumulo": {
				"Umphumulo": [""] 
			},
			"Msinga": {
				"Pomeroy": [""] 
			},
			"Mthonjaneni": {
				"Melmoth": [""]
			},
			"Mtubatuba": {
				"Mtubatuba": [""] 
			},
			"Ndwedwe": {
				"Ndwedwe": [""] 
			},
			"Newcastle": {
				"Newcastle": [""] 
			},
			"Nkandla": {
				"Nkandla": [""] 
			},
			"Nkosazana Dlamini Zum": {
				"Creighton": [""] 
			},
			"Nkosi Langalibalele": {
				"Escourt": [""] 
			},
			"Nongoma": {
				"Nongoma": [""] 
			},
			"Nquthu": {
				"Mgazi": [""], 
			},
			"Okhahlamba": {
				"Bergsville": [""],
				"Wenterton": [""] 
			},
			"Ubuhlebezwe": {
				"Ixopo": [""] 
			},
			"Ulundi": {
				"Ulundi": [""] 
			},
			"Umfolozi": {
				"Kwambonambi": [""]
			},
			"Umhlabuyalingana": {
				"Mbazwana": [""] 
			},
			"Umlalazi": {
				"Eshowe": [""],
				"Mtumzini": [""] 
			},
			"Umvoti": {
				"Greytown": [""]
			},
			"Umzimkhulu": {
				"Umzimkhulu": [""] 
			},
			"Uphongolo": {
				"Pongola": [""] 
			}
		},
		"Limpopo": {
			"Blouberg": {
				"Alldays": [""]
			},
			"Lepelle-Nkumpi": {
				"Zebediala": [""]
			},
			"Molemole": {
				"Dedron": [""]
			},
			"Polokwane": {
				"Polokwane": [""]
			},
			"Phalaborwa": {
				"Phalaborwa": [""]
			},
			"Giyani": {
				"Giyani": [""]
			},
			"Letaba": {
				"Modjadjikloof": [""]
			},
			"Tzaneen": {
				"Tzaneen": [""]
			},
			"Maruleng": {
				"Hoedspruit": [""]
			},
			"Elias Motsoaledi": {
				"Rossenekal": [""]
			},
			"Ephraim Mogale": {
				"Marble Hall": [""]
			},
			"Fetakgomo": {
				"Burgersfort": [""]
			},
			"Makhuduthamaga": {
				"Bloblersdal": [""]
			},
			"Collins Chabane": {
				"Malamulele": [""]
			},
			"Makhado": {
				"Makhado": [""]
			},
			"Musina": {
				"Musina": [""]
			},
			"Thulamela": {
				"Tohoyandou": [""]
			},
			"Bela-Bela": {
				"Be-bela": [""]
			},
			"Lephalale": {
				"Lephalale": [""]
			},
			"Modimolle": {
				"Modimolle": [""],
				"Vaalwater": [""]
			},
			"Mogalakwena": {
				"Mokopane": [""]
			},
			"Thabazimbi": {
				"Thabazimbi": [""]
			}
		},
		"Mpumalanga": {
			"Bushbuckridge": {
				"Thabazimbi": [""],
				"Sabie": [""]
			},
			"City of Mbombela": {
				"Barberton": [""],
				"Hazyview": [""],
				"Kabokweni": [""],
				"Kanyamazane": [""],
				"Skukuza": [""],
				"White River": [""]
			},
			"Nkomazi": {
				"Komatipoort": [""]
			},
			"Thaba Chweu": {
				"Graskop": [""],
				"Lydenburg": [""],
				"Sabie": [""]
			},
			"Chief Albert Luthuli": {
				"Carolina": [""]
			},
			"Dipaleseng": {
				"Balfour" : [""]
			},
			"Dr Pixley Ka Isaka Seme": {
				"Amersfoort" : [""],
				"Volksrust" : [""],
				"Wakkerstroom" : [""]
			},
			"Govan Mbeki": {
				"Bethal" : [""],
				"Evender" : [""],
				"Secunda" : [""]
			},
			"Lekwa": {
				"Standerton" : [""]
			},
			"Mkhondo": {
				"Amsterdam" : [""]
			},
			"Msukaligwa": {
				"Breyten" : [""],
				"Ermelo" : [""]
			},
			"Dr JS Moroka": {
				"Siyabuswa" : [""]
			},
			"Emalahleni": {
				"Kriel" : [""],
				"Ogies" : [""]
			},
			"Steve Tshwete": {
				"Middleburg" : [""],
				"Hendrina" : [""]
			},
			"Thembisile Hani": {
				"Kwamhlanga" : [""]
			},
			"Victor Khanye": {
				"Delmas" : [""]
			}
		},
		"Northern Cape": {
			"Dikgatlong": {
				"Barkly West": [""],
				"Windsorton" : [""]
			},
			"Magareng": {
				"Warrenton" : [""]
			}, 
			"Phokwane": {
				"Hartswater" : [""]
			},
			"Sol Plaatje": {
				"Kimberley" : [""]
			},
			"Segonyana": {
				"Kuruman" : [""]
			},
			"Gamagara": {
				"Olifantshoek" : [""]
			},
			"Joe Morolong": {
				"Hotazel" : [""]
			},
			"Hantam": {
				"Calvinia" : [""]
			},
			"Kamiesberg": {
				"Garies" : [""],
				"Carnarvon" : [""]
			},
			"Karoo Hoogland": {
				"Sutherland" : [""],
				"Pofadder" : [""]
			},
			"Khai-Ma": {
				"Springbok" : [""]
			},
			"Nama Khoi": {
				"Alexander Bay" : [""]
			},
			"Richtersveld": {
				"Britstown" : [""]
			},
			"Emthanjeni": {
				"Petrusville" : [""],
				"Philipstown" : [""]
			},
			"Kareeberg": {
				"Prieska" : [""]				
			},
			"Renosterberg": {
				"Hopetown" : [""],
				"Strydenburg" : [""]
			},
			"Siyancuma": {
				"Victoria West" : [""]
			},
			"Siyathemba": {
				"Colesberg" : [""],
				"Noupoort" : [""]
			},
			"Thembelihle": {
				"Postmasburg" : [""]
			},
			"Ubuntu": {
				"Groblershoop" : [""]
			},
			"Tsantsabane": {
				"Upington" : [""]
			},
			"Kheis": {
				"Keimoes" : [""]
			},
			"Dawid Kruiper": {
				"Danielskuil" : [""]
			}
		},
		"North West": {
			"Kgetlengrivier": {
				"Koster": [""],
				"Swartruggen" : [""]
			},
			"Madibeng": {
				"Bafokeng" : [""],
				"Brits" : [""],
				"Mooinooi" : [""]
			},
			"Moretele": {
				"Thulwe" : [""]
			},
			"Moses Kotane": {
				"Mogwase": [""]				
			},
			"Rustenburg": {
				"Marikana" : [""],
				"Rustenburg" : [""]
			},
			"City of Matlosana": {
				"Jouberton" : [""],
				"Klerksdorp" : [""],
				"Orkney" : [""],
				"Stilfontein" : [""]
			},
			"JB Marks": {
				"Potchefstroom" : [""],
				"Ventersdorp" : [""]
			},
			"Maquassi Hills": {
				"Makwassie" : [""],
				"Wolmaransstad" : [""],
				"Leeudoringstad" : [""]
			},
			"Greater Taung": {
				"Pudimoe" : [""],
				"Reivilo" : [""], 
				"Taung" : [""]
			},
			"Kagisano-Molopo": {
				"Piet Plessis" : [""],
				"Pomfret" : [""]
			},
			"Lekwa-Teemane": {
				"Bloemof" : [""],
				"hristiana" : [""]
			},
			"Mamusa": {
				"Schweizer-Reneke" : [""]
			},
			"Naledi": {
				"Vryburg" : [""]
			},
			"Ditsobotla": {
				"Lichtenburg" : [""],
				"Coligny" : [""],
				"Itsoseng" : [""]
			},
			"Mafikeng": {
				"Mafikeng" : [""],
				"Madikwe" : [""]
			},
			"Ramotshere Moiloa": {
				"Vryburg" : [""]
			},
			"Ratlou": {
				"Madibogo" : [""]
			},
			"Tswaing": {
				"Delareyville" : [""],
				"Ottosdal" : [""],
				"Sannieshof" : [""]
			}
		},
		"Western Cape": {
			"City of Cape Town": {
				"Athlone": [""],
				"Atlantis" : [""],
				"Belhar" : [""],
				"Bellville" : [""],
				"Brackenfell" : [""],
				"Cape Town" : [""],
				"Goodwood" : [""],
				"Gordon's Bay" : [""],
				"Kraaifontein" : [""],
				"Kuils River" : [""],
			}, 
			"Breede Valley": {
				"Touws Rive" : [""],
				"Worcester" : [""]
			},
			"Drakenstein": { 
				"Paarl" : [""],
				"Wellington" : [""]
			},
			"Stellenbosch": { 
				"Stellenbosch" : [""]
			},
			"Witzenberg": { 
				"Ceres" : [""],
				"Wolseley" : [""]
			},
			"Beaufort West": { 
				"Murraysburg" : [],
				"Beaufort West" : []
			},
			"Oudtshoorn": { 
				"Oudtshoorn" : [""]
			},
			"Witzenberg": { 
				"" : [""]
			},
			"Mossel Bay": { 
				"Great Brak River" : [""]
			},
			"Langeberg": { 
				"Ashton" : [""],
				"Bonnievale" : [""],
				"Montagu" : [""],
				"Robertson" : [""]
			},
			"Laingsburg": { 
				"Laingsburg" : [""]
			},
			"Prince Albert": { 
				"Prince Albert" : [""]
			},
			"Bitou": { 
				"Riversdale" : [""],
				"Plettenberg Bay": [""]
			},
			"George": { 
				"George" : [""],
				"Uniondale" : [""]
			},
			"Hessequa": { 
				"Albertinia" : [""],
				"Still Bay" : [""]
			},
			"Kannaland": { 
				"Calitzdorp" : [""],
				"Ladysmith" : [""]
			},
			"Knysna": { 
				"Knysna" : [""]
			},
			"Oudtshoorn": { 
				"Cape Town" : ["3000", "3001"],
				"Beaufort West" : ["4000", "4001"]
			},
			"Cape Agulhas": { 
				"Bredasdorp" : [""]
			},
			"Overstrand": { 
				"Gans Bay" : [""],
				"Kleinmond" : [""]
			},
			"Swellendam": { 
				"Swellendam" : [""]
			},
			"Theewaterskloof": { 
				"Caledon" : [""],
				"Grabouw" : [""]
			},
			"Bergrivier": { 
				"Piketberg" : [""],
				"Velddrif" : [""],
				"Porterville" : [""]
			},
			"Cederberg": { 
				"Citrusdal" : [""],
				"Clanwilliam" : [""]
			},
			"Matzikama": { 
				"Bitterfontein" : [""]
			},
			"Saldanha Bay": { 
				"Saldanha" : [""],
				"Vredenburg" : [""]
			},
			"Swartland": { 
				"Atlantis" : [""],
				"Darling" : [""],
				"Malmesbury" : [""]
			}
		}
	}
	
	
	window.onload = function () {
		
		//Get html elements
		var provinceSel = document.getElementById("provinceSel");
		var municipalSel = document.getElementById("municipalSel");	
		var citySel = document.getElementById("citySel");
		var suburbSel = document.getElementById("suburbSel");
		
		//Load countries
		for (var province in countryStateInfo) {
			provinceSel.options[provinceSel.options.length] = new Option(province, province);
		}
		
		//Province Changed
		provinceSel.onchange = function () {
			 
			 municipalSel.length = 1; // remove all options bar first
			 citySel.length = 1; // remove all options bar first
			 suburbSel.length = 1; // remove all options bar first
			 
			 if (this.selectedIndex < 1)
				 return; // done
			 
			 for (var state in countryStateInfo[this.value]) {
				 municipalSel.options[municipalSel.options.length] = new Option(state, state);
			 }
		}
		
		//MunicipalSelChanged
		municipalSel.onchange = function () {		 
			 
			 citySel.length = 1; // remove all options bar first
			 suburbSel.length = 1; // remove all options bar first
			 
			 if (this.selectedIndex < 1)
				 return; // done
			 
			 for (var city in countryStateInfo[provinceSel.value][this.value]) {
				 citySel.options[citySel.options.length] = new Option(city, city);
			 }
		}
		
		//City Changed
		citySel.onchange = function () {
			suburbSel.length = 1; // remove all options bar first
			
			if (this.selectedIndex < 1)
				return; // done
			
			var subs = countryStateInfo[provinceSel.value][municipalSel.value][this.value];
			for (var i = 0; i < subs.length; i++) {
				suburbSel.options[suburbSel.options.length] = new Option(subs[i], subs[i]);
			}
		}	
	}
	
	