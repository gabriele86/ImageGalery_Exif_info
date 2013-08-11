<?php
ini_set('display_errors',1); 
 error_reporting(E_ALL);
$_GET['cartella'];
include_once('Funzioni/ImageGallery.php');
include_once('Funzioni/Exifinfo.php');

@define(base_folder, 'archivio_foto/');

$folder_list = getFolderList(base_folder);



?>

<html>
<body>
	<ul>
		                                   <?php    foreach ($folder_list as $value) {
            
        echo "<li class='segment-0'><a href='index.php?cartella=".$value."'>$value</a></li>";

    }?>
	</ul>
	<ul style="position: relative; overflow: hidden; height:auto;" id="portfolioList" class="clearfix portfolio-list isotope">
                   
                
                                <?php 
                                
                                if(!isset($_GET['cartella'])){
                                
                                
                               $file = getPhotos($cartella.$folder_list[2]);
                                      foreach ($file as $img )
                                      {

                                       

                                        echo "  
                                           <li class='item link'>
                                        <div class='shadow'>
                                            <a href='dettaglio.php?album=".dirname($img)."&foto=".basename($img)."'>
                                                <img  src='$img'></a>
                                                  <div class='item-caption'>
                                                    <strong class='title'>";
                                                        echo basename($img, '.jpg');
                                                
                                                    echo "</strong>
                                                        <br>
                                                </div>
                                        </div>
                                         ";
                                          
                                          
                                          
                                          
                                          
                                      }
                                      
                                }
                                else 
                                    {
                                    
                                     $file = getPhotos(base_folder.$_GET['cartella']);
                                      foreach ($file as $img )
                                      {
                                        $img_parts = pathinfo($img);
                                       
                                        echo "  
                                           <li class='item link'>
                                        <div class='shadow'>
                                            <a href='dettaglio.php?album=".dirname($img)."&foto=".basename($img)."'>
                                                <img src='$img'></a>
                                                    <div class='item-caption'>
                                                    <strong class='title'>";
                                                        echo basename($img, $img_parts['extension']);
                                                
                                                    echo "</strong>
                                                        <br>
                                                </div>
                                        </div>
                                         ";
                                          
                                          
                                          
                                          
                                          
                                      }
                                    
                                    
                                    
                                    
                                    
                                    
                                     }
                                     
                                
                                      
                                ?>
                                
                                </ul>
                          <div id='page_navigation'></div>       
                    </div>
<!-- An empty div which will be populated using jQuery -->  

                </div>
<script type="text/javascript">
$(document).ready(function(){

	//how much items per page to show
	var show_per_page = 15;
	//getting the amount of elements inside content div
	var number_of_items = $('#portfolioList li').size();
	//calculate the number of pages we are going to have
	var number_of_pages = Math.ceil(number_of_items/show_per_page);

	//set the value of our hidden input fields
	$('#current_page').val(0);
	$('#show_per_page').val(show_per_page);

	//now when we got all we need for the navigation let's make it '

	/*
	what are we going to have in the navigation?
		- link to previous page
		- links to specific pages
		- link to next page
	*/
	var navigation_html = '<a class="previous_link" href="javascript:previous();">' + 'Prev' +  '</a>';
	  var current_link = 0;
	  while(number_of_pages > current_link){
	    navigation_html += '<a class="page_link"  href="#portfolioList" onclick="javascript:go_to_page(' + current_link  +')" longdesc="' + current_link  +'">'+ (current_link + 1) +'</a>';
	    current_link++;
	  }
	  navigation_html += '<a class="next_link" href="javascript:next();">' + 'Next'+'</a>';
	

	$('#page_navigation').html(navigation_html);

	//add active_page class to the first page link
	$('#page_navigation .page_link:first').addClass('active_page');

	//hide all the elements inside content div
	$('#portfolioList').children().css('display', 'none');

	//and show the first n (show_per_page) elements
	$('#portfolioList').children().slice(0, show_per_page).css('display', 'block');

	 remove_prev_link();
	

});

function previous(){

	new_page = parseInt($('#current_page').val()) - 1;
	//if there is an item before the current active link run the function
	if($('.active_page').prev('.page_link').length==true){
		go_to_page(new_page);
	}

}

function next(){
	new_page = parseInt($('#current_page').val()) + 1;
	//if there is an item after the current active link run the function
	if($('.active_page').next('.page_link').length==true){
		go_to_page(new_page);
	}

}

function remove_prev_link()
{
  selcted_page_num = parseInt($('#current_page').val()) + 1;

 if(selcted_page_num === 1 ){$('a.previous_link').hide('a.previous_link');

   
}
 else
 {
   $('a.previous_link').show('a.previous_link');
 }

}

function remove_next_link()
{
   selcted_page_num = parseInt($('#current_page').val()) - 1;

  

 

 if(selcted_page_num === parseInt($('#total_pages').val()) ){$('a.next_link').hide('a.next_link');

  
}
 else
 {
   $('a.next_link').show('a.next_link');

 }

}



function go_to_page(page_num){
	//get the number of items shown per page
	var show_per_page = parseInt($('#show_per_page').val());

	//get the element number where to start the slice from
	start_from = page_num * show_per_page;

	//get the element number where to end the slice
	end_on = start_from + show_per_page;

	//hide all children elements of content div, get specific items and show them
	$('#portfolioList').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');

	/*get the page link that has longdesc attribute of the current page and add active_page class to it
	and remove that class from previously active page link*/
	$('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');

	//update the current page input field
	$('#current_page').val(page_num);

	  

	   
    remove_prev_link();
    remove_next_link();
}
                                
</script>


</body>
</html>
