<?php
function getExifInfo($file){
	$exif = exif_read_data($file, NULL, true, true);

	$orientation = array('', 'top left side', 'top right side', 'bottom right side', 'bottom left side', 'left side top', 'right side top', 'right side bottom', 'left side bottom');

	$resolution_unit = array('', '', 'inches', 'centimeters');

	$ycbcr_positioning = array('', 'the center of pixel array', 'the datum point');

	$imgtype = array( '', 'GIF', 'JPG', 'PNG', 'SWF', 'PSD', 'BMP', 'TIFF(intel byte order)', 'TIFF(motorola byte order)', 'JPC', 'JP2', 'JPX', 'JB2', 'SWC', 'IFF', 'WBMP', 'XBM');
	 
	$exposure_program = array(
			'Not defined',
			'Manual',
			'Normal program',
			'Aperture priority',
			'Shutter priority',
			'Creative program (biased toward depth of field)' ,
			'Action program (biased toward fast shutter speed)',
			'Portrait mode (for closeup photos with the background out of focus)',
			'Landscape mode (for landscape photos with the background in focus)',
	);
	$metering_mode = array(
			'0' => 'Unknown',
			'1' =>  'Average',
			'2' =>  'Center Weighted Average',
			'3' =>  'Spot',
			'4' =>  'MultiSpot',
			'5' =>  'Pattern' ,
			'6' =>  'Partial' ,
			'255' =>'Other Metering Mode'
	);

	$light_source = array(
			'0' =>  'unknown',
			'1' =>  'Daylight',
			'2' =>  'Fluorescent',
			'3' =>  'Tungsten (incandescent light)',
			'4' =>  'Flash',
			'9' =>  'Fine weather',
			'10' =>  'Cloudy weather',
			'12' =>  'Daylight fluorescent (D 5700 ñ 7100K)',
			'13' =>  'Day white fluorescent (N 4600 ñ 5400K)',
			'14' =>  'Cool white fluorescent (W 3900 ñ 4500K)',
			'15' =>  'White fluorescent (WW 3200 ñ 3700K)',
			'17' =>  'Standard light A',
			'18' =>  'Standard light B',
			'19' =>  'Standard light C',
			'20' =>  'D55',
			'21' =>  'D65',
			'22' =>  'D75',
			'23' =>  'D50',
			'24' =>  'ISO studio tungsten',
			'255' => 'other light source',
	);

	$flash = array(
			'0' =>  'Flash did not fire.',
			'1' =>  'Flash fired.',
			'5' => 'Strobe return light not detected.',
			'7' =>  'Strobe return light detected.',
			'9' =>  'Flash fired, compulsory flash mode',
			'13' =>  'Flash fired, compulsory flash mode, return light not detected',
			'15' =>  'Flash fired, compulsory flash mode, return light detected',
			'16' =>  'Flash did not fire, compulsory flash mode',
			'24' =>  'Flash did not fire, auto mode',
			'25' =>  'Flash fired, auto mode',
			'29' =>  'Flash fired, auto mode, return light not detected',
			'31' =>  'Flash fired, auto mode, return light detected',
			'32' =>  'No flash function',
			'65' =>  'Flash fired, red-eye reduction mode',
			'69' =>  'Flash fired, red-eye reduction mode, return light not detected',
			'71' =>  'Flash fired, red-eye reduction mode, return light detected',
			'73' =>  'Flash fired, compulsory flash mode, red-eye reduction mode',
			'77' =>  'Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected',
			'79' =>  'Flash fired, compulsory flash mode, red-eye reduction mode, return light detected',
			'89' =>  'Flash fired, auto mode, red-eye reduction mode',
			'93' =>  'Flash fired, auto mode, return light not detected, red-eye reduction mode',
			'95' =>  'Flash fired, auto mode, return light detected, red-eye reduction mode',
	);

	$img_info = array ();
	if ( isset( $exif['FILE']['FileName'] ) )
		$img_info['FileName'] = '<b>FileName</b> '. $exif['FILE']['FileName'];
	
	else $img_info['FileName'] ="";
	
	
	if ( isset( $exif['FILE']['FileType'] ) )
		$img_info['FileType'] ='<b>FileType</b> '.  $imgtype[$exif['FILE']['FileType']];
	else $img_info['FileType'] ="";
	if ( isset( $exif['FILE']['MimeType'] ) )
		$img_info['MimeType'] = '<b>MimeType</b> '.  $exif['FILE']['MimeType'];
	else $img_info['MimeType'] ="";
	if ( isset( $exif['FILE']['FileSize'] ) )
		$img_info['FileSize'] ='<b>FileSize</b> '. ( floor( $exif['FILE']['FileSize'] / 1024 * 10 ) /10 ) . ' KB';
	else $img_info['FileSize'] ="";
	if ( isset( $exif['FILE']['FileDateTime'] ) )
		$img_info['FileDateTime'] ='<b>FileDataTime</b> '. date( 'Y-m-d  H:i:s', $exif['FILE']['FileDateTime'] );
	else $img_info['FileDateTime'] ="";
	if ( isset( $exif['IFD0']['Artist'] ) )
		$img_info['Artist'] ='<b>Artis</b> '. $exif['IFD0']['Artist'];
	else $img_info['Artist'] ="";
	if ( isset( $exif['IFD0']['Make'] ) )
		$img_info['Make'] = '<b>Make</b> '.$exif['IFD0']['Make'];
	else $img_info['Make'] ="";
	if ( isset( $exif['IFD0']['Model'] ) )
		$img_info['Model'] ='<b>Model</b> '. $exif['IFD0']['Model'];
	else $img_info['Model'] ="";
	if ( isset( $exif['IFD0']['DateTime'] ) )
		$img_info['DateTime'] ='<b>DateTime</b> '. $exif['IFD0']['DateTime'];
	else $img_info['DateTime'] ="";
	if ( isset( $exif['EXIF']['ExifVersion'] ) )
		$img_info['ExifVersion'] ='<b>ExifVersion</b> '. $exif['EXIF']['ExifVersion'];
	else $img_info['ExifVersion'] ="";

	if ( isset( $exif['EXIF']['DateTimeOriginal'] ) )
		$img_info['DateTimeOriginal'] ='<b>DateTimeOriginal</b> '. $exif['EXIF']['DateTimeOriginal'];
	else $img_info['DateTimeOriginal'] =" ";
	if ( isset( $exif['EXIF']['DateTimeDigitized'] ) )
		$img_info['DateTimeDigitized'] = '<b>DateTimeDigitalized</b> '. $exif['EXIF']['DateTimeDigitized'];
	else $img_info['DateTimeDigitized'] ="";
	if ( isset( $exif['COMPUTED']['Height'] ) )
		$img_info['Height'] = '<b>Height</b> '. $exif['COMPUTED']['Height'] . ' px';
	else $img_info['Height'] ="";
	if ( isset( $exif['COMPUTED']['Width'] ) )
		$img_info['Width'] = '<b>Width</b> '.$exif['COMPUTED']['Width'] . ' px';
	else $img_info['Width'] ="";
	if ( isset( $exif['EXIF']['CompressedBitsPerPixel'] ) )
	$img_info['CompressedBitsPerPixel'] ='<b>CompressedBitsPerPixel</b> '. $exif['EXIF']['CompressedBitsPerPixel'] .' Bits/Pixel';
	else $img_info['CompressedBitsPerPixel'] ="";
	
	if(isset( $exif['COMPUTED']['FocusDistance'] ))
	$img_info['FocusDistance'] = isset( $exif['COMPUTED']['FocusDistance'] ) ? $exif['COMPUTED']['FocusDistance'] . ' m' : NULL;
	else $img_info['FocusDistance'] ="";
	if(isset( $exif['COMPUTED']['FocalLength'] ))
	$img_info['FocalLength'] = isset( $exif['EXIF']['FocalLength'] ) ? '<b>FocalLenght</b>'.$exif['EXIF']['FocalLength'] . ' mm' : NULL;
	else  $img_info['FocalLength'] ="";
	if(isset( $exif['EXIF']['FocalLengthIn35mmFilm'] ))
	$img_info['FocalLengthIn35mmFilm'] = isset( $exif['EXIF']['FocalLengthIn35mmFilm'] ) ?'<b>FocalLengthIn35mmFilm</b> '. $exif['EXIF']['FocalLengthIn35mmFilm'] . ' mm' : NULL;
	else $img_info['FocalLengthIn35mmFilm']="";
	if ( isset( $exif['EXIF']['ColorSpace'] ) )
		$img_info['ColorSpace'] ='<b>ColorSpace </b> '. $exif['EXIF']['ColorSpace'] == 1 ? 'sRGB' : 'Uncalibrated';
	else $img_info['ColorSpace'] = "";
	if ( isset( $exif['IFD0']['ImageDescription'] ) )
		$img_info['ImageDescription'] ='<b>ImageDescription </b> '. $exif['IFD0']['ImageDescription'];
	else $img_info['ImageDescription'] = "";
	if ( isset( $exif['IFD0']['Orientation'] ) )
		$img_info['Orientation'] ='<b>Orientation </b> '. $orientation[$exif['IFD0']['Orientation']];
	else $img_info['Orientation'] = "";
	if ( isset( $exif['IFD0']['XResolution'] ) )
		$img_info['XResolution'] ='<b>XResolution </b> '. $exif['IFD0']['XResolution'] . $resolution_unit[$exif['IFD0']['ResolutionUnit']];
	else $img_info['XResolution'] ="";
	if ( isset( $exif['IFD0']['YResolution'] ) )
		$img_info['YResolution'] ='<b>YResolution </b> '. $exif['IFD0']['YResolution'] . $resolution_unit[$exif['IFD0']['ResolutionUnit']];
	else $img_info['YResolution'] = "";
	if ( isset( $exif['IFD0']['Software'] ) )
		$img_info['Software'] = '<b>Software </b> '.utf8_encode( $exif['IFD0']['Software'] );
	else $img_info['Software'] = "";
	if ( isset( $exif['IFD0']['YCbCrPositioning'] ) )
		$img_info['YCbCrPositioning'] ='<b>YCbCrPositioning </b> '. $ycbcr_positioning[$exif['IFD0']['YCbCrPositioning']];
	else $img_info['YCbCrPositioning'] = "";
	if ( isset( $exif['IFD0']['Copyright'] ) )
		$img_info['Copyright'] ='<b>Copyright</b> '. $exif['IFD0']['Copyright'];
	else $img_info['Copyright'] = "";
	if ( isset( $exif['COMPUTED']['Copyright.Photographer'] ) )
		$img_info['Photographer'] ='<b>Photographer</b> '. $exif['COMPUTED']['Copyright.Photographer'];
	else $img_info['Photographer'] = "";
	if ( isset( $exif['COMPUTED']['Copyright.Editor'] ) )
		$img_info['Editor'] ='<b>Editor</b> '. $exif['COMPUTED']['Copyright.Editor'];
	else $img_info['Editor'] = "";
	if ( isset( $exif['EXIF']['ExifVersion'] ) )
		$img_info['ExifVersion'] ='<b>ExifVersion</b> '. $exif['EXIF']['ExifVersion'];
	else $img_info['ExifVersion'] = "";
	if ( isset( $exif['EXIF']['FlashPixVersion'] ) )
		$img_info['FlashPixVersion'] ='<b>FlashPixVersion</b> '. 'Ver'. number_format( $exif['EXIF']['FlashPixVersion']/100, 2 );
	else $img_info['FlashPixVersion'] = "";
	if ( isset( $exif['EXIF']['ApertureValue'] ) )
		$img_info['ApertureValue'] ='<b>ApertureValue</b> '. $exif['EXIF']['ApertureValue'];
	else $img_info['ApertureValue'] = "";
	if ( isset( $exif['EXIF']['ShutterSpeedValue'] ) )
		$img_info['ShutterSpeedValue'] ='<b>ShutterValue</b> '. $exif['EXIF']['ShutterSpeedValue'];
	else $img_info['ShutterSpeedValue'] = "";
	if ( isset( $exif['COMPUTED']['ApertureFNumber'] ) )
		$img_info['ApertureFNumber'] ='<b>ApertureFNumber</b> '. $exif['COMPUTED']['ApertureFNumber'];
	else $img_info['ApertureFNumber'] = "";
	if ( isset( $exif['EXIF']['MaxApertureValue'] ) )
		$img_info['MaxApertureValue'] ='<b>MaxApertureValue</b> '. 'F' . $exif['EXIF']['MaxApertureValue'];
	else $img_info['MaxApertureValue'] = "";
	if ( isset( $exif['EXIF']['ExposureTime'] ) )
		$img_info['ExposureTime'] ='<b>ExposureTime</b> '. $exif['EXIF']['ExposureTime'];
	else $img_info['ExposureTime'] = "";
	if ( isset( $exif['EXIF']['FNumber'] ) )
		$img_info['F-Number'] ='<b>FNumber</b> '. $exif['EXIF']['FNumber'];
	else $img_info['F-Number'] = "";
	if ( isset( $exif['EXIF']['MeteringMode'] ) )
		$img_info['MeteringMode'] ='<b>MeteringMode</b> '.$metering_mode[$exif['EXIF']['MeteringMode']];
	else $img_info['MeteringMode'] = "";
	 
	if ( isset( $exif['EXIF']['LightSource'] ) )
		$img_info['LightSource'] ='<b>LightSource</b> '.$light_source[ $exif['EXIF']['LightSource']];
	else $img_info['LightSource'] = "";
	if ( isset( $exif['EXIF']['Flash'] ) )
		$img_info['Flash'] ='<b>Flash</b> '.$flash[$exif['EXIF']['Flash']];
	else $img_info['Flash'] = "";
	 
	 
	if ( isset( $exif['EXIF']['ExposureMode'] ) )
		$img_info['ExposureMode'] ='<b>ExposureMode</b> '. $exif['EXIF']['ExposureMode'] == 1 ? 'Manual exposure' :'Auto exposure';
	else $img_info['ExposureMode'] = "";
	if ( isset( $exif['EXIF']['WhiteBalance'] ) )
		$img_info['WhiteBalance'] ='<b>WitheBalance</b> '. $exif['EXIF']['WhiteBalance'] == 1 ?  'Manual white balance' :  'Auto white balance';
	else $img_info['WhiteBalance'] = "";
	if ( isset( $exif['EXIF']['ExposureProgram'] ) )
		$img_info['ExposureProgram'] ='<b>ExposureProgram</b> '. $exposure_program[$exif['EXIF']['ExposureProgram']];
	else $img_info['ExposureProgram'] = "";
	if ( isset( $exif['EXIF']['ExposureBiasValue'] ) )
		$img_info['ExposureBiasValue'] ='<b>ExposureValue</b> '. $exif['EXIF']['ExposureBiasValue'] . 'EV';
	else $img_info['ExposureBiasValue'] = "";
	if ( isset( $exif['EXIF']['ISOSpeedRatings'] ) )
		$img_info['ISOSpeedRatings'] ='<b>ISOSpeedRatings</b> '. $exif['EXIF']['ISOSpeedRatings'];
	else $img_info['ISOSpeedRatings'] = "";

	if ( isset( $exif['EXIF']['ComponentsConfiguration'] ) )
		$img_info['ComponentsConfiguration'] ='<b>ComponentsConfiguration</b> '. bin2hex( $exif['EXIF']['ComponentsConfiguration'] ) == '01020300' ? 'YCbCr' : 'RGB';
	else $img_info['ComponentsConfiguration'] = "";
	if ( isset( $exif['COMPUTED']['UserCommentEncoding'] ) )
		$img_info['UserCommentEncoding'] ='<b>UserCommentEncoding</b> '. $exif['COMPUTED']['UserCommentEncoding'];
	else $img_info['UserCommentEncoding'] = "";
	if ( isset( $exif['COMPUTED']['UserComment'] ) )
		$img_info['UserComment'] ='<b>UserComment</b> '. $exif['COMPUTED']['UserComment'];
	else $img_info['UserComment'] = "";
	if ( isset( $exif['EXIF']['ExifImageLength'] ) )
		$img_info['ExifImageLength'] ='<b>ExifImageLenght</b> '. $exif['EXIF']['ExifImageLength'];
	else $img_info['ExifImageLength'] = "";
	if ( isset( $exif['EXIF']['ExifImageWidth'] ) )
		$img_info['ExifImageWidth'] ='<b>ExifImageWidth</b> '. $exif['EXIF']['ExifImageWidth'];
	else $img_info['ExifImageWidth'] = "";
	if ( isset( $exif['EXIF']['FileSource'] ) )
		$img_info['FileSource'] ='<b>FileSource</b> '. bin2hex( $exif['EXIF']['FileSource'] )  == 0x03 ? 'DSC' :'unknown' ;
	else $img_info['FileSource'] = "";
	if ( isset( $exif['EXIF']['SceneType'] ) )
		$img_info['SceneType'] ='<b>SceneType</b> '. bin2hex( $exif['EXIF']['SceneType'] ) == 0x01 ? 'A directly photographed image' :  'unknown' ;
	else $img_info['SceneType'] = "";
	if ( isset( $exif['COMPUTED']['Thumbnail.FileType'] ) )
		$img_info['Thumbnail.FileType'] ='<b>Thumbnail.FileType</b> '. $exif['COMPUTED']['Thumbnail.FileType'];
	else $img_info['Thumbnail.FileType'] = "";
	if ( isset( $exif['COMPUTED']['Thumbnail.MimeType'] ) )
		$img_info['Thumbnail.MimeType'] ='<b>Thumbnail.MimeType</b> '. $exif['COMPUTED']['Thumbnail.MimeType'];
	else $img_info['Thumbnail.MimeType'] = "";


	return $img_info;
}
?>