<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Admin extends CI_Model
{



	public function image2jpeg(string $pic,string $new = '',string  $newDir="") : string
	{
		if( is_file ( $pic ) ) {
			if ( $new && ! preg_match('/\.jpg|jpeg$/i', $new)) $new="{$new}.jpg";
			$mime= mime_content_type($pic) ;
			if (preg_match('/jpeg|jpg|png|gif/', $mime, $match)) {
				$originalExt= $match[0] ;
				$ext = strtolower( ($match[0] == 'jpeg' ? 'jpg' : $match[0]) );
				if ($ext == 'jpg') {
					$src = imagecreatefromjpeg($pic);
				}
				if ($ext == 'png') {
					$src = imagecreatefrompng($pic);
				}
				if ($ext == 'gif') {
					$src = imagecreatefromgif($pic);
				}
				list($w, $h) = getimagesize($pic);
				$dst = imagecreatetruecolor($w, $h);
				imagecopymerge($dst, $src, 0, 0, 0, 0, $w, $h, 100);
				$ret = imagejpeg($dst, "{$newDir}{$new}", 70);
				// var_dump($ret,"{$newDir}{$new}"); die;
				if ( $ret ) {
					return $new;
				}else {
					return "";
				}
			}
		}
		return "";
	}
	# ##########################################################
	
	/**
	 * upload images
	 *
	 * @param string $pic
	 * @param string|array $old
	 * @return string image name
	 */
	public function uploadPic(string $pic, $old = '', $up="./uploads/products/") {
		try {
			if ($_FILES[$pic]['name'] != '') {
				if (preg_match('/jpeg|jpg|png|gif/', $_FILES[$pic]['type'], $match)) {
					$ext = ($match[0] == 'jpeg' ? 'jpg' : $match[0]);
					// var_dump($ext); die;
					if ($ext == 'jpg') {
						$src = imagecreatefromjpeg($_FILES[$pic]['tmp_name']);
					}
					if ($ext == 'png') {
						$src = imagecreatefrompng($_FILES[$pic]['tmp_name']);
					}
					if ($ext == 'gif') {
						$src = imagecreatefromgif($_FILES[$pic]['tmp_name']);
					}
					list($w, $h) = getimagesize($_FILES[$pic]['tmp_name']);
					$newSize= min($w,$h);
					if($h < $w) {
						$src_x= ceil( ($w-$h)  / 2);
						$src_y= 0 ;
					}else if( $h > $w )
					{
						$src_y= ceil( ($h-$w)  / 2);
						$src_x= 0 ;
					}else if( $w==$h ) {
						$src_y= 0;
						$src_x= 0 ;
					}
					$dst = imagecreatetruecolor(350, 350);
					imagesavealpha($dst, true);
					imagecopyresized ( $dst , $src , 0 , 0 , $src_x , $src_y ,350 , 350 , $newSize ,$newSize);
					$pic_name= uniqid();
					$thumb = $pic_name . "_thumb.jpg";
					imagejpeg($dst, $up.$thumb, 80);
					$pic = $this->image2jpeg($_FILES[$pic]['tmp_name'],$pic_name,$up);
					if ( gettype($old) == 'string') {
						if (is_file("{$up}{$old}")) {
							@unlink("{$up}{$old}");
						}
					}else if ( gettype($old) == 'array') {
						foreach( $old as $o ){
							if (is_file("{$up}{$o}")) {
								@unlink("{$up}{$o}");
							}
						}

					}
					return ["pic"=>$pic,"thumbnail"=>$thumb];
				} else {
					return $old;
				}
			} else {
				return $old;
			}
		} catch (Exception $e) {
			echo 'Caught exception: ', $e->getMessage(), "\n";
			die;
		}
	}

}