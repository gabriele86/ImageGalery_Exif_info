 <?php
$_GET['album'];
$_GET['foto'];

error_reporting(0);



$fileinfo = trim($_GET['album']).'/'.$_GET['foto'];

include_once 'Funzioni/ExifInfo.php';



   
$img_info = getExifInfo($fileinfo);


?>
 <img alt=""  src="<?php echo $fileinfo;?>" height="80" width="80"> </a>
<table class="imagedatatable">
	 					<tbody>
	 						<tr>
	 							<th scope="row"></th>
	 							<td><?php echo $img_info['FileDateTime'];?></td></tr>
	 							<tr><th scope="row"></th><td><?php echo $img_info['Height'];?></td></tr>
	 							<tr><th scope="row"></th><td><?php echo $img_info['Width'];?></td></tr>
	 							<tr><th scope="row"></th>
	 								<td><?php echo $img_info['Make'];?> - <?php echo $img_info['Model'];?></td></tr>
	 							</tbody>
	 						</table>

	 						 <table style="display: table;" id="all_exif">
	 						 	<tbody>
	 						 		<tr>
	 						 			<td><?php echo $img_info['FileName'];?></td>
	 						 		</tr>
	 						 		<tr>
	 						 			<td><?php echo $img_info['FileType'];?></td></tr>
	 						 			<tr>
	 						 				<td><?php echo $img_info['MimeType'];?></td></tr>
	 						 				<tr>
	 						 					<td><?php echo $img_info['FileSize'];?></td></tr>
	 						 					<tr>
	 						 						<td><?php echo $img_info['FileDateTime'];?></td></tr>
	 						 						<tr>
	 						 							<td><?php echo $img_info['Make'];?></td></tr>
	 						 							<td><?php echo $img_info['Model'];?></td></tr>
	 						 							<td><?php echo $img_info['DateTime'];?></td></tr>
	 						 							<tr>
	 						 								<td><?php echo $img_info['ExifVersion'];?></td></tr>
	 						 								<tr>
	 						 									<td><?php echo $img_info['DateTimeOriginal'];?></td></tr>
	 						 								<tr>
	 						 									<td><?php echo $img_info['DateTimeDigitized'];?></td></tr>
	 						 									<tr>
	 						 										<td><?php echo $img_info['Height'];?></td></tr>
	 						 										<tr>
	 						 											<td><?php echo $img_info['Width'];?></td></tr>
	 						 											<tr>
	 						 											 <td><?php echo $img_info['CompressedBitsPerPixel'];?></td></tr>
	 						 												<tr>
	 						 													<td><?php echo $img_info['FocalLength'];?></td></tr>
	 						 													<tr>
	 						 														<td><?php echo $img_info['FocalLengthIn35mmFilm'];?></td></tr>
	 						 														<tr>
	 						 															<td><?php echo $img_info['ColorSpace'];?></td></tr>
	 						 															<tr>
	 						 																<td><?php echo $img_info['Orientation'];?></td></tr>
	 						 																<tr>
	 						 																	<td><?php echo $img_info['XResolution'];?></td></tr>
	 						 																	<tr>
	 						 																	<td><?php echo $img_info['YResolution'];?></td></tr>
	 						 																	<tr>
	 						 																	<td><?php echo $img_info['Software'];?></td>
	 						 																	</tr>
	 						 																		<tr>
	 						 																			<td><?php echo $img_info['FlashPixVersion'];?>
	 						 																		</td>
	 						 																	</tr>
	 						 																			<tr>
	 						 																				<td><?php echo $img_info['ApertureFNumber'];?></td></tr>
	 						 																				<tr>
	 						 																					<td><?php echo $img_info['MaxApertureValue'];?></td></tr>
	 						 																					<tr>
	 						 																						<td><?php echo $img_info['ExposureTime'];?></td></tr>
	 						 																						<tr>
	 						 																							<td><?php echo $img_info['F-Number'];?></td></tr>
	 						 																							<tr>
	 						 																								<td><?php echo $img_info['MeteringMode'];?></td></tr>
	 						 																								<tr><td><?php echo $img_info['LightSource'];?></td></tr>
	 						 																								<tr><td><?php echo $img_info['Flash'];?></td></tr>
	 						 																								<tr><td><?php echo $img_info['ExposureMode'];?></td></tr>
	 						 																								<tr><td><?php echo $img_info['WhiteBalance'];?></td></tr>
	 						 																								<tr><td><?php echo $img_info['ExposureProgram'];?></td></tr>
	 						 																								<tr><td><?php echo $img_info['ExposureBiasValue'];?></td></tr>
	 						 																								<tr><td><?php echo $img_info['ISOSpeedRatings'];?></td></tr>
	 						 																								<tr><td><?php echo $img_info['UserCommentEncoding'];?></td></tr>
	 						 																								<tr><td><?php echo $img_info['UserComment'];?></td></tr>
	 						 																								<tr><td><?php echo $img_info['ExifImageLength'];?></td></tr>
					 																								<?php echo Interpret_IRB_to_HTML( get_Photoshop_IRB( $jpeg_header_data ), $filename ) ;?>
	 						 																								</div>
	 						 																								</div>
	 						 																								</div><!--//-->
	 						 																								</article></div></div><div style="display: block;" id="sidebar"></div></div></div></div><footer id="colophon" role="contentinfo"> <span class="footer-info">2013 // CameraNews.it // Powered by: V3Sessanta .it </span><div id="sociallinks" class="clearfix"><ul></ul></div></footer>
	 						 																								
	 						 																									 						 																								<tr><td><?php echo $img_info['ExifImageWidth'];?></td></tr>
	 						 																								</tbody>
	 						 																								</table>
