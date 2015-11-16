<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/**
	 * Function to shorten a ObjectId from 24 chars to 16 chars
	 * @param string | ObjectId $id id to be shortend
	 * @return string | false the shortened id, or false if supplied id was not a valid ObjectId
	 */
	public static function getShortMongoId($id)
	{
		$enc = base64_encode(hex2bin(strval($id)));
		$enc = str_replace('+', '-', $enc);
		$enc = str_replace('/', '_', $enc);
		return empty($enc) ? $id : $enc;
	}

	/**
	 * Function to restore a shortened ObjectId
	 * @param string $id the shortened ObjectId
	 * @param boolean $return_object_id if true returns the restored id as a ObjectId, if false as a string
	 * @return string | ObjectId | false the restored id, or false if the conversion did not result in a valid ObjectId
	 */
	public static function restoreFromShortMongoId($id, $return_object_id = false)
	{
		$string = str_replace('-', '+', $id);
		$string = str_replace('_', '/', $string);
		$string = bin2hex(base64_decode($string));

		if (strlen($string) != 24) {
			return false;
		}

		if ($return_object_id) {
			return new MongoId($string);
		} else {
			return $string;
		}
	}

}
