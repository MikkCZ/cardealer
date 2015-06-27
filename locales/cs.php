<?php
defined('ABSPATH') or die();

define('DASH', '-');
define('ASK', 'Na dotaz');
define('CURRENCY', ',- Kč');
define('ODO_UNIT', ' km');
define('LITERS_UNIT', ' cm3');
define('POWER_UNIT', ' kW');

define('YEAR', 'Rok výroby');
define('ODOMETER', 'Najeto');
define('CATEGORY', 'Karoserie');
define('FUEL', 'Palivo');
define('ENGINELITERS', 'Objem motoru');
define('ENGINEPOWER', 'Výkon motoru');
define('TRANSMISSION', 'Převodovka');
define('ECOLOR', 'Barva karoserie');
define('METALLIC', 'Metalíza');
define('CONDITION', 'Stav vozu');
define('WARRANTY', 'Záruka');
define('ECOTAX', 'Ekodaň');
define('CRASHED', 'Havarováno');
define('STK', 'STK');
define('EMISSIONS', 'Emise');

define('PRICE', 'Cena');

define('COMFORT', 'Pohodlí');
define('INTERIOR', 'Interiér');
define('MEDIA', 'Média, navigace');
define('EXTERIOR', 'Exteriér');
define('SAFETY', 'Bezpečnost');

define('ADDITIONAL', 'Další vlastnosti');

define('VEHICLE_INFO_STRINGS',
	serialize (
		array(
			'cardealer_category' => array(
				'sedan'		=> 'Sedan',
				'kombi'		=> 'Kombi',
				'hatch'		=> 'Hatchback',
				'coupe'		=> 'Coupé',
				'cabrio'	=> 'Kabriolet',
				'suv'		=> 'SUV / Crossover',
				'terrain'	=> 'Terénní',
				'pickup'	=> 'Pickup',
				'van'		=> 'Dodávka',
				'caravan'	=> 'Obytný',
				'trailer'	=> 'Přívěs',
				'other'		=> 'Jiná',
			),
			'cardealer_fuel'	=> array(
				'gasoline'	=> 'Benzín',
				'diesel'	=> 'Nafta',
				'hybrid'	=> 'Hybridní',
				'lpg'		=> 'LPG',
				'cng'		=> 'CNG',
				'other'		=> 'Jiné',
			),
			'cardealer_transmission'	=> array(
				'manual'	=> 'Manuální',
				'auto'		=> 'Automatická',
				'semi-auto'	=> 'Polo-automatická',
				'other'		=> 'Jiná',
			),
			'cardealer_metallic' => array(
				'yes'		=> 'Ano',
				'no'		=> 'Ne',
				'other'		=> DASH,
			),
			'cardealer_condition' => array(
				'new'		=> 'Nový',
				'demo'		=> 'Předváděcí',
				'used'		=> 'Ojetý',
				'other'		=> 'Jiný',
			),
			'cardealer_warranty' => array(
				'yes'		=> 'Ano',
				'no'		=> 'Ne',
				'other'		=> DASH,
			),
			'cardealer_ecotax' => array(
				'yes'		=> 'Ano',
				'no'		=> 'Ne',
				'other'		=> DASH,
			),
			'cardealer_crashed' => array(
				'yes'		=> 'Ano',
				'no'		=> 'Ne',
				'other'		=> DASH,
			),
		)
	)
);

define('VEHICLE_OPTIONS',
	serialize (
		array(
			'cardealer_comfort'		=> array(
				'power steering'			=> 'Posilovač řízení',
				'adjustable steering wheel'	=> 'Stavitelný volant',
				'electric windows'			=> 'Elektricky ovládaná okna',
				'air condition'				=> 'Klimatizace',
				'cruise'					=> 'Tempomat',
				'on-board computer'			=> 'Palubní počítač',
				'steering wheel buttons'	=> 'Multifunkční volant',
				'integrated phone'			=> 'Integrovaný telefon',
				'rain sensor'				=> 'Dešťový senzor',
				'park assist'				=> 'Parkovací asistent',
			),
			'cardealer_interior'	=> array(
				'armrest'					=> 'Loketní opěrka',
				'leather seats'				=> 'Kožený interiér',
				'heated seats'				=> 'Vyhřívaná sedadla',
				'adjustable seats'			=> 'Nastavitelná sedadla',
				'adjustable headrests'		=> 'Výsuvné opěrky hlavy',
				'adjustable rear seats'		=> 'Dělená zadní sedadla',
				'sunroof'					=> 'Střešní okno',
			),
			'cardealer_media'		=> array(
				'radio'						=> 'AM/FM rádio',
				'mc'						=> 'Kazety (MC)',
				'cd'						=> 'CD přehrávač',
				'cd changer'				=> 'Měnič CD',
				'dvd'						=> 'DVD přehrávač',
				'mp3'						=> 'Přehrávání MP3',
				'handsfree'					=> 'Handsfree sada',
				'bluetooth'					=> 'Bluetooth',
				'gps'						=> 'GPS navigace',
				'steering wheel buttons'	=> 'Ovladače na volantu',
			),
			'cardealer_exterior'	=> array(
				'alloy wheels'				=> 'Litá kola',
				'winter wheels'				=> 'Zimní kola',
				'fog lights'				=> 'Mlhovky',
				'xenon lights'				=> 'Xenonové světlomety',
				'adaptive lights'			=> 'Adaptivní světlomety',
				'washer lights'				=> 'Ostřikovače světel',
				'electric mirrors'			=> 'Elektrická zrcátka',
				'heated mirrors'			=> 'Vyhřívaná zrcátka',
				'rear wiper'				=> 'Zadní stěrač',
				'rails'						=> 'Ližiny',
				'hitch'						=> 'Tažné zařízení',
			),
			'cardealer_safety'		=> array(
				'central lock'				=> 'Centrální zamykání',
				'remote lock'				=> 'Dálkové ovládání',
				'alarm'						=> 'Alarm',
				'immobilizer'				=> 'Imobilizér',
				'abs'						=> 'ABS',
				'asr'						=> 'ASR',
				'esp'						=> 'ESP',
				'1airbag'					=> '1x airbag',
				'2airbag'					=> '2x airbag',
				'4airbag'					=> '4x airbag',
				'6airbag'					=> '6x airbag',
				'8airbag'					=> '8x airbag',
				'10airbag'					=> '10x airbag',
				'12airbag'					=> '12x airbag',
			),
		)
	)
);
