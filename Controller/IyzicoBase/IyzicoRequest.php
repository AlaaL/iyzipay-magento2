<?php
/**
 * iyzico Payment Gateway For Magento 2
 * Copyright (C) 2018 iyzico
 * 
 * This file is part of Iyzico/Iyzipay.
 * 
 * Iyzico/Iyzipay is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Iyzico\Iyzipay\Controller\IyzicoBase;

class IyzicoRequest
{

	public function iyzicoCheckoutFormRequest($baseUrl,$json,$authorizationData) {

			$url = $baseUrl.'/payment/iyzipos/checkoutform/initialize/auth/ecom';
				 
		    return $this->curlPost($json,$authorizationData,$url);

	}

	public function iyzicoCheckoutFormDetailRequest($baseUrl,$json,$authorizationData) {

			$url = $baseUrl.'/payment/iyzipos/checkoutform/auth/ecom/detail';
			
		    return $this->curlPost($json,$authorizationData,$url);

	}


	public function iyzicoOverlayScriptRequest($json,$authorizationData) {

			$baseUrl   = "https://iyziup.iyzipay.com/";
			$url   	   = $baseUrl."v1/iyziup/protected/shop/detail/overlay-script";


		    return $this->curlPost($json,$authorizationData,$url);

	}


	public function curlPost($json,$authorizationData,$url) {

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		$content_length = 0;
		if ($json) {
		    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
		    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
		//curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($curl, CURLOPT_TIMEOUT, 150);
		
		curl_setopt(        
		    $curl, CURLOPT_HTTPHEADER, array(
		        "Authorization: " .$authorizationData['authorization'],
		        "x-iyzi-rnd:".$authorizationData['rand_value'], 
		        "Content-Type: application/json",
			"Accept: application/json"
		    )
		);

		$result = json_decode(curl_exec($curl));
		curl_close($curl);

		

		return $result;
	}

}
