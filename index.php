<?php
	// $_POST['from'] = "WST";
	// $_POST['to'] = "ZMK";
	// $_POST['amount'] = 1;
	// $_POST['type'] = "Money";

	$response['feedback'] = "";
    $countries = array('USD','EUR','GBP','ZAR','AED','AFN','ALL','ANG','AOA','AMD','ARS','AWG',
                        'AUD','AZN','BSD','BDT','BBD','BHD','BZD','BMD','BYR','BOB','BAM','BWP',
                        'BRL','BND','BGN','BIF','BTN','CAD','CVE','CZK','CLP','CNY','COP','CDF',
                        'CRC','CUC','CUP','CHF','DZD','DKK','DJF','DOP','EGP','ERN','ETB','FJD',
                        'GGP','GMD','GHS','GEL','GIP','GTQ','GYD','GNF','HRK','HTG','HNL','HKD',
                        'HUF','FKP','IDR','IRR','IQD','ISK','IMP','INR','JMD','JPY','JEP','JOD',
                        'KYD','KHR','KZT','KMF','KES','KGS','KPW','KRW','KWD','ILS','LAK','LSL',
                        'LBP','LRD','LYD','LKR','MOP','MKD','MGA','MYR','MWK','MVR','MAD','MUR',
                        'MRO','MXN','MMK','MZN','MDL','MNT','NZD','NAD','NPR','NIO','NGN','NOK',
                        'OMR','PAB','PGK','PKR','PYG','PEN','PLN','PHP','PNB','QAR','RUB','RON',
                        'RWF','RSD','SAR','SHP','SGD','STD','SCR','SLL','SYP','SOS','SZL','SDG',
                        'SSP','SEK','SRD','TRY','THB','TWD','TJS','TZS','TOP','TTD','TND','TMT',
                        'UAH','UGX','UYU','UZS','VUV','VES','VND','XCD','XOF','XAF','XPF','YER',
                        'WST','ZMK'
                    );
    $values = array(    1,0.94,0.83,17.05,3.67,88.49,107.35,1.80,503.87,393.81,173.95, 1.80,
                        1.49,1.70,1,105.84,2.02,0.38,2.02,1, 25.25,6.91, 1.84,12.85,
                        5.17,1.35,1.84,2061.27,82.77,1.36,103.53,22.79,878.00,6.99,4729.47, 1999.94,
                        584.06,1,23.87,0.93,137.8,7.0,177.99,55.66,24.78,15.0,53.62,2.23,
                        0.82,61.95,9.50,2.68,0.82,7.85,209.39,8594.16,7.09,146.47,24.62,7.80,
                        376.70,0.82,15593.64,42025.17,1459.61,143.45,0.82,82.77,153.11,132.76, 0.82,0.70,
                        0.82,4111.02,461.48,461.92,123.18,85.68,900,1280.13,0.307,3.50, 17305.06,17.04,
                        1507.5,154.44,4.810,365.56,8.03,57.79,4459.20,4.42,1024.33,15.66,10.50,44.59,
                        370.79,19.38,2095.49, 63.73,19.18,3444.53,1.58,17.04,132.50,36.41,446.61,9.92,
                        0.385,1,3.52,225.59, 7340.77,3.80,4.37,55.24,54.80,3.64,69.10,4.62,
                        1067.98,110.45,3.75,0.82,1.35,23098.71,14.28,18865.03,2512.53,568.5,17.05,565.26,
                        130.26,10.53,31.57,18.66,34.80,30.74,10.20,2331.52,2.34,6.77,3.113,3.507,
                        36.89,3641.51,38.63,11224.98,118.42,16.41,23563.79,2.7, 616.68,616.68,112.18,250.22,
                        2.71,17979.52
                    );
    $total= 0;

	if (isset($_POST['type']) && $_POST['type'] == "Money") {
		$from = $_POST['from'];
		$to = $_POST['to'] ;
		$amount = $_POST['amount'] ;
		if (isset($_POST['from']) && isset($_POST['to']) && isset($_POST['amount'])) {
			// $response['feedback'] = currencyConverter($amount, $from, $to);
            for ($i=0; $i < count($countries); $i++) { 
                if ($_POST['from'] == $countries[$i]) {
                    $from = $values[$i];
                }
                if ($_POST['to'] == $countries[$i]) {
                    $to = $values[$i];
                }
            }
            $response['feedback'] = ($amount * $to) / $from;
		} else {
			$response['feedback'] = 'No values to convert';
		}
	} else {
		$from = $_POST['from'];
		$to = $_POST['to'] ;
		$amount = $_POST['amount'] ;
		$response['feedback'] = convert($amount, $from, $to);
	}
	
	echo json_encode($response);
	
	function currencyConverter($amount, $from, $to){
		$conv_id = "{$from}_{$to}";
		$string = file_get_contents("https://free.currconv.com/api/v7/convert?q=$conv_id&compact=ultra&apiKey=c28130519c868037a79d");
		$json_a = json_decode($string, true);
		return $amount * round($json_a[$conv_id], 4);
	}

	function convert($value, $from, $to)
	{
		switch ($from) {
			case "Angstron":
                    switch ($to) {
                        case "Angstron":
                            return "Unnecessary Conversation";
                        case "dm":
                            $valordm = $value * 0.0000000001 / 0.1;
                            return $value ." ". $from . " = " .$valordm ." ". $to;
                        case "km":
                            $valorkm = $value * 0.0000000001 * 1000;
                            return $value ." ". $from . " = " .$valorkm ." ". $to;
                        case "m":
                            $valor = $value * 0.0000000001;
                            return $value ." ". $from . " = " .$valor ." ". $to;
                        case "cm":
                            $valorcm = $value * 0.0000000001 * 0.01;
                            return $value ." ". $from . " = " .$valorcm." ". $to;
                        case "dam":
                            $valordam = $value * 0.0000000001 / 10;
                            return $value ." ". $from . " = " .$valordam." ". $to;
                        case "hm":
                            $valorhm = $value * 0.0000000001 / 0.00000001;
                            return $value ." ". $from . " = " .$valorhm." ". $to;
                        case "mm":
                            $valormm = $value * 0.0000000001 * 0.001;
                            return $value ." ". $from . " = " .$valormm." ". $to;
                        case "nm":
                            $valornm = $value * 0.0000000001 / 0.000000001;
                            return $value ." ". $from . " = " .$valornm." ". $to;
                        case "µm":
                            $valormc = $value * 0.0000000001 / 0.000001;
                            return $value ." ". $from . " = " .$valormc." ". $to;
                        default:
                            return "Invalid Conversation";
                    }
                    break;
                case "km":
                    switch ($to) {
                        case "km":
                            return "";
                        case "m":
                            $valor = $value * 1000;
                            return $value ." ". $from . " = " .$valor." ". $to;
                        case "cm":
                            $valorcm = $value * 100000;
                            return $value ." ". $from . " = " .$valorcm." ". $to;
                        case "dm":
                            $valordm = $value * 10000;
                            return $value ." ". $from . " = " .$valordm." ". $to;
                        case "hm":
                            $valorhm = $value * 1000 / 0.0000001;
                            return $value ." ". $from . " = " .$valorhm." ". $to;
                        case "mph":
                            $c = $value / 16093;
                            return $value ." ". $from . " = " .$c." ". $to;
                        case "µm":
                            $valormicm = $value * 1000 / 0.000001;
                            return $value ." ". $from . " = " .$valormicm." ". $to;
                        case "nm":
                            $valornm = $value * 1000 / 0.00000001;
                            return $value ." ". $from . " = " .$valornm." ". $to;
                        case "dam":
                            $valordam = $value * 1000 / 10;
                            return $value ." ". $from . " = " .$valordam." ". $to;
                        case "mm":
                            $valormm = $value * 1000 / 0.001;
                            return $value ." ". $from . " = " .$valormm." ". $to;
                        case "Angstron":
                            $valorang = $value * 1000 / 0.0000000001;
                            return $value ." ". $from . " = " .$valorang." ". $to;
                        default:
                        	return "Invalid Conversation";
                    }
                    break;
                case "m":
                    switch ($to) {
                        case "km":
                            $valor = $value / 1000;
                            return $value ." ". $from . " = " .$valor." ". $to;
                        case "m":
                            return "Unnecessary Conversation";
                        case "cm":
                            $valorcm = $value * 100;
                            return $value ." ". $from . " = " .$valorcm." ". $to;
                        case "dm":
                            $valordm = $value / 0.1;
                            return $value ." ". $from . " = " .$valordm." ". $to;
                        case "hm":
                            $valorhm = $value / 0.00000001;
                            return $value ." ". $from . " = " .$valorhm." ". $to;
                        case "mph":
                            $valormph = $value / 0.0006214;
                            return $value ." ". $from . " = ".$valormph." ". $to;
                        case "hectares":
                            return "Invalid Conversation";
                        case "µm":
                            $valormicm = $value / 0.000001;
                            return $value ." ". $from . " = " .$valormicm." ". $to;
                        case "nm":
                            $valornm = $value / 0.000000001;
                            return $value ." ". $from . " = " .$valornm." ". $to;
                        case "mm":
                            $vmm = $value / 0.001;
                            return $value ." ". $from . " = " .$vmm." ". $to;
                        case "dam":
                            $vdam = $value / 10;
                            return $value ." ". $from . " = " .$vdam." ". $to;
                        default:
                            return "Invalid Conversation";
                    }
                    break;
                case "cm":
                	switch ($to) {
                        case "km":
                            $valor = $value / 100000;
                            return $value ." ". $from . " = " .$valor." ". $to;
                        case "m":
                            $valorcm = $value / 100;
                            return $value ." ". $from . " = " .$valordm." ". $to;
                        case "cm":
                            return "Unnecessary Conversation";;
                        case "dm":
                            $valordm = $value / 0.01;
                            return $value ." ". $from . " = " .$valordm." ". $to;
                        case "hm":
                            $valorhm = $value / 0.00000001;
                            return $value ." ". $from . " = " .$valorhm." ". $to;
                        case "mph":
                            $valorcmmhp = $value /  0.000006214;
                            return $value ." ". $from . " = " .$valorcmmhp." ". $to;
                        case "hectares":
                            return "Invalid Conversation";
                        case "µm":
                            $valormicm = $value / 0.000001;
                            return $value ." ". $from . " = " .$valormicm." ". $to;
                        case "nm":
                            $valornm = $value / 0.000000001;
                            return $value ." ". $from . " = " .$valornm." ". $to;
                        case "mm":
                            $vmm = $value / 0.001;
                            return $value ." ". $from . " = " .$vmm." ". $to;
                        case "dam":
                            $vdam = $value / 10;
                            return $value ." ". $from . " = " .$vdam." ". $to;
                        default:
                            return "Invalid Conversation";
                    }
                    break;
                case "dm":
                    break;
                case "dam":
                    break;
                case "hm":
                    break;
                case "mm":
                    break;
                case "km/h":
                    switch ($to) {
                        case "km/h":
                            return "Conversation Unnecessary";
                        case "m/s":
                            $valorms = $value / 3.6;
                            return $value ." ". $from . " = " .$valorms." ". $to;
                        default:
                            return "Invalid Conversation";
                    }
                    break;
                case "m/s":
                    switch ($to) {
                        case "m/s":
                            return "Unnecessary Conversation";
                        case "km/h":
                            $valorms = $value * 3.6;
                            return $value ." ". $from . " = " .$valorms." ". $to;
                        default:
                            return "Invalid Conversation";
                    }
                    break;
                case "hectare":
                    switch ($to) {
                        case "hectare":
                            return "Unnecessary Conversation";
                        case "acre":
                            $c = $value / 0.4046;
                            return $value ." ". $from . " = " .$c." ". $to;
                        case "m^2":
                            $m = $value * 10000;
                            return $value ." ". $from . " = " .$m." ". $to;
                        case "km^2":
                            $km = $value * 10000 / 1000;
                            return $value ." ". $from . " = " .$km." ". $to;
                        default:
                            return "Invalid Conversation";
                    }
                    break;
                case "acre":
                    switch ($to) {
                        case "hectare":
                            $c = $value * 0.4046;
                            return $value ." ". $from . " = " .$c." ". $to;
                        case "acre":
                            return "Unnecessary Conversation";
                        default:
                            return "Invalid Conversation";
                    }
                    break;
                case "mph":
                    switch ($to) {
                        case "km":
                            $c = $value * 16093;
                            return $value ." ". $from . " = " .$c." ". $to;
                        case "mph":
                            return "Unnecessary Conversation";
                        default:
                            return "invalid convertion";
                    }
                    break;
                case "K":
                    switch ($to) {
                        case "K":
                            return "Unnecessary Conversation";
                        case "ºC":
                            $c = $value - 273;
                            return $value ." ". $from . " = " .$c." ". $to;
                        case "ºF":
                            $f = 9 * ($value - 273) / 5 + 32;
                            return $value ." ". $from . " = " .$f." ". $to;
                        default:
                            return "Invalid Conversation";
                    }
                    break;
                case "ºF":
                    switch ($to) {
                        case "K":
                            $f = 5 * ($value - 32) / 9 + 273;
                            return $value ." ". $from . " = " .$f." ". $to;
                        case "ºC":
                            $c = 5 * ($value - 32) / 9;
                            return $value ." ". $from . " = " .$c." ". $to;
                        case "ºF":
                            return "Unnecessary Conversation";
                        default:
                            return "Invalid Conversation";
                    }
                    break;
                case "ºC":
                    switch ($to) {
                        case "ºC":
                            return "Unnecessary Conversation";
                        case "K":
                            $f = $value + 273;
                            return $value ." ". $from . " = " .$f." ". $to;
                        case "ºF":
                            $c = 9 * value / 5 + 32;
                            return $value ." ". $from . " = " .$c." ". $to;
                        default:
                            return "Invalid Conversation";
                    }
                    break;
                case "h":
                    switch ($to) {
                        case "h":
                            return "Unnecessary Conversation";
                        case "min":
                            $f = $value * 60;
                            return $value ." ". $from . " = " .$f." ". $to;
                        case "s":
                            $c = $value * 60 * 60;
                            return $value ." ". $from . " = " .$c." ". $to;
                        default:
                            return "Invalid Conversation";
                    }
                    break;
                case "min":
                    switch ($to) {
                        case "min":
                            return "Unnecessary Conversation";
                        case "s":
                            $f = $value / 60;
                            return $value ." ". $from . " = " .$f." ". $to;
                        case "h":
                            $c = $value / 60 / 60;
                            return $value ." ". $from . " = " .$c." ". $to;
                        default:
                            return "Invalid Convertion";
                            break;
                    }
                    break;
                case "s":
                    switch ($to) {
                        case "s":
                            return "Unnecessary Conversation";
                            break;
                        case "min":
                            $f = $value / 60;
                            return $value ." ". $from . " = " .$f." ". $to;
                            break;
                        case "h":
                            $c = $value / 60 / 60;
                            return $value ." ". $from . " = " .$c." ". $to;
                        default:
                            return "Invalid Conversation";
                    }
                    break;
            }
	}
?>			