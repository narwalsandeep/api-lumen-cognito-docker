<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {
	const STATUS_ACTIVE = "active";
	const STATUS_INACTIVE = 'inactive';
	const SAMPLE_USER = "nouserimage.png";
	const SAMPLE_EVENT = "event.jpg";
	
	
	/**
     *
     */
    public function _verifyAuth($token)
    {
        try {
            $res = $this->cognito->verifyAccessToken($token);
            return $res;
        } catch (\Exception $e) {
            return false;
        }
    }

	/**
	 *
	 * @var unknown
	 */
	protected $payload;
	/**
	 */
	protected function make($success = true, $msg = "") {
		$return = array ();
		$return ['success'] = $success;
		if($this->payload){
			if(is_array($this->payload))
				$return ['count'] = count ( $this->payload );
			$return ['payload'] = ($this->payload) ? $this->payload : array ();
		}
		$return ['msg'] = ($msg) ? $msg : "";
		$return ['error'] = ! $success;
		return $return;
	}
	
	/**
	 */
	protected function unauthorized() {
		$return = array ();
		$return ['success'] = false;
		$return ['msg'] = "Invalid Login";
		$return ['error'] = 403;
		return $return;
	}
	
	/**
	 */
	protected function satinizeUser() {
		$this->ignore ( "auth_token,password" );
	}
	
	/**
	 *
	 * @param unknown $ignore        	
	 */
	protected function ignore($ignore) {
		$explode = explode ( ",", $ignore );
		foreach ( $this->payload as $key => $value ) {
			foreach ( $value as $k => $v ) {
				if (in_array ( $k, $explode )) {
					unset ( $this->payload [$key]->$k );
				}
			}
		}
	}
	
	/**
	 *
	 * @param unknown $filename        	
	 * @param unknown $newwidth        	
	 * @param unknown $newheight        	
	 * @param unknown $time        	
	 * @return unknown
	 */
	function resizeImage($filename, $newwidth, $newheight, $time) {
		list ( $width, $height ) = getimagesize ( $filename );
		if ($width > $height && $newheight < $height) {
			$newheight = $height / ($width / $newwidth);
		} else if ($width < $height && $newwidth < $width) {
			$newwidth = $width / ($height / $newheight);
		} else {
			$newwidth = $width;
			$newheight = $height;
		}
		
		$thumb = imagecreatetruecolor ( $newwidth, $newheight );
		$source = imagecreatefromjpeg ( $filename );
		imagecopyresized ( $thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
		
		imagejpeg ( $thumb, "uploads/" . $time . "400.jpg" );
		return "uploads/" . $time . "400.jpg";
	}
	
	/**
	 * 
	 */
	public function _i($str){
		echo "<br><span style='color:blue'>".$str."</span>";
		ob_flush();
        flush();
	}

	/**
	 * 
	 */
	public function _s($str){
		echo "<br><span style='color:green'>".$str."</span>";
		ob_flush();
        flush();
	}

	/**
	 * 
	 */
	public function _c($str){
		echo "<br><pre>";
		print_r(json_decode($str));
		echo "</pre>";
		ob_flush();
        flush();
	}
	/**
	 * 
	 */
	public function _r($str){
		echo "<br><pre>";
		print_r($str);
		echo "</pre>";
		ob_flush();
        flush();
	}

	/**
	 * 
	 */
	public function _e($str){
		echo "<br><span style='color:red'>".$str."<span>";
		ob_flush();
        flush();
	}
	
	/**
	 *
	 * @param string $embed        	
	 * @param number $size        	
	 * @param string $algo        	
	 * @return string
	 */
	protected function getRandomString($embed = "", $size = 16, $algo = "") {
		if (! $algo)
			$algo = "sha1";
		
		return strtolower ( substr ( $algo ( $embed . rand ( 1, 1000000 ) . microtime () ), 0, $size ) );
	}
}
