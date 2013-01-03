var mapReset = false;
var logoDown = false;
var annunciSingle = false;
var DitoFront;
$(document).ready(function(){
	if($(".linkcat").is('li'))
	{
		expandLinks();
	}
	$(document).pngFix();
	logoPositionControl();
//	annunciTitleControl();
	$('#s').click(function(){
		$('#s').val("");
	});
if($('.tubepress_container').is('div'))
{
	fixVideoGalleries();
	videoSidebarCssFixes();
}
if($('.homeFirst').is('div')){
	expandCollapse();
}
if($('.newsletterTextInput').is('input')){
	$('.newsletterTextInput').click(function(){
		$('.newsletterTextInput').val('');
	});
}
if($('.homeEntry').is('div')){
	homeTxtControl();
	homeImgSwap();
	}
if($("#mapsearch").is("input")){
	clearMapForm();
}
if ($("#carta").is("div")){
    loadMap();
    resetMap();
    resetDirections();
    searchAdressesByCat();
    clearDirectionsForm();
 }
if($("#annunci").is("div") || annunciSingle == true){     
    catAnnunci();
    searchAnnunci();
    countAnnunci();
    annunciIntroControl();
    annunciSearchControl();
    annunciInserisciOffertaControl();
    annunciInserisciRichiestaControl();
    annunciNewSearchControl();
    annunciSingleControl();
    piccoliAnnunciIntroControl();
    $("#pannunci").click(function(){
        $("#pannunci").val("");
	});
} 
if($(".intro").is("div")){
    $(".goRead").click(function(){
    $(".goRead").fadeOut(100);
    $(".intro").fadeOut(100);
    $(".story").fadeIn(150);
    $(".changeMe").removeClass('boxesBoxSecond'); 
    if ($(".goaway").is("div")) {
        $(".change").removeClass("secondLine");
        $(".changeDiv").removeClass("boxesSecondLine");
        $(".changeDiv").addClass("boxes");
        $(".changeDiv").css({paddingTop:"0px"})
        $(".goaway").fadeOut(100);
        }
    });
}      
	if ( $(".questions").is("div") )
	{
       elScroll();
	}              
});//////CLOSE DOCUMENT READY FUNCTION///////////////////////////////
function resetMap(){
$(".resetMap").click(function(){
        $(".address").remove();
        $(".resetMap").remove();
        var mapForm = "";
        mapForm += "<form id=\"mapform\" name=\"mapform\" method=\"get\" action=\"map.php\">";
        mapForm += "<input type=\"text\" name=\"mapsearch\" value=\"Inserisci nome servizio\"  style=\"top:-7px;\" id=\"mapsearch\" >";
        mapForm += "<input type=\"image\" src=\"http://dito.areato.org/wp-content/themes/area/imgs/search.gif\" name=\"submit\" style=\"top:-2px;left:5px;\" id=\"submap\" /></form>";
        $(".entry").append(mapForm);
        loadMap(45.071399, 7.687683);
        clearMapForm();
        clearDirectionsForm();
        if (mapReset == true){
        resetDirections();
        } 
    });
};
function clearMapForm(){
 $("#mapsearch").click(function(){
        $("#mapsearch").val("");
    });
};
function elScroll(){
		
        var pageScrl = $(document).scrollTop();
        var container_Scrl = $('#content').offset({scroll:false});
		var fm_Scrl = $('.questions').offset({scroll:false});
		
		var amountToTop = pageScrl-0-container_Scrl.scrollTop();
		
		if ( $("#maptxt").is("div") )
		{
			amountToTop=6;
		}
		else if( amountToTop < 60 )
		{
			amountToTop=60;
		}
		
        $('.questions').animate({top: amountToTop},function(){
        	// console.log('lement should d something now', amountToTop);
             window.setTimeout('elScroll()', 2000)
        });
};
function catAnnunci(){
   var el = $(".boxes").find("span");
   el.click(function(){
   $('.piccoliIntro').fadeIn(200);
   if ($('#noResults').is('span')){
       $('#noResults').remove(); 
   }
   var catKind =  $(this).attr("class");
   var catWhat = $(this).text();
   catWhat = catWhat.split('(');
   catWhat = catWhat[0];
   if ($(".queryBox").is("div")){
         $(".queryBox").remove();
         $('.annunciResults').remove();
    } if ($('.entryForSingle').is('div')){
    	$('.entryForSingle').children().fadeOut(150);
    	$('.comments').fadeOut(150);
    	$('.chiudiRiassunto').fadeIn(180);
    }
   $.ajax({
        type: "POST",
        url: "annuncicatsearch.php",
        dataType: "html",
        data: "kind="+catKind+"&what="+catWhat,
        success: function(msg){
            var html = "";
            var isCerca = $('.cerca').css('display');
            if(isCerca == 'none'){
            $(".newsearch").fadeIn(200);
            }
            $(".inserisciOfferta").fadeIn(200);
            $(".formText").fadeOut(200);
            $(".pform").fadeOut(200);
            if (msg != "") {
            html += "<div class=\"queryBox catAnnQueryBox\">";
            html += msg;
            html += "</div>";
            } else {
            html += "<div class=\"queryBox\">";
            html += "<h3>Nessun risultato per la categoria richiesta.</h3>";
            html += "</div>";            
            }
            if($('#annIntro').is('div')){
      		$('#annIntro').fadeOut(200);
      		}
            $(".entry").append(html); 
            if ($('.entryForSingle').is('div')){
            	$('.catAnnQueryBox').css("margin-top", "14px");
            }  
        }
   });
   return false;
});
};
function annunciSingleControl(){
	$('.chiudiRiassunto').click(function(){
		$('.catAnnQueryBox').remove();
		$('.entryForSingle').children().fadeIn(200);
    	$('.chiudiRiassunto').fadeOut(200);
    	$('.comments').fadeIn(150);
    	});
}
function countAnnunci(){
    var el = $(".boxes").find("span");  
    el.each(function(i){
    var catKind =  $(this).attr("class");
    var catWhat = $(this).text(); 
    ajaxToCount($(this),catKind,catWhat)
    });
};
function ajaxToCount(el,catKind,catWhat){  
     $.ajax({
        type: "POST",
        url: "annunci_count.php",
        dataType: "html",
        data: "kind="+catKind+"&what="+catWhat,
        success: function(msg){
            if (msg != "") {
            var temp = msg.split('</div>');
            var numEl = temp.length - 1;
               el.children().text('('+numEl+')');     
            } else {
            el.children().text('(0)')
            }   
        }
        });
};
function searchAnnunci(){
$("#subaanunci").click(function(){
		if($("#pannunci").val() == "Cerca"){
		$("#pannunci").val("");
		}
        $.ajax({
        type: "POST",
        url: "annuncisearch.php",
        data: "kind="+$("#kind").val()+"&pannunci="+$("#pannunci").val(),
        success: function(msg){
        $(".newsearch").fadeIn(200);
        $(".inserisciOfferta").fadeIn(200);
        $(".formText").fadeOut(200);
        $('.formRicerche').fadeOut(200);
        $(".pform").fadeOut(200);
        $(".entry").append('<h2 class="annunciResults">Risultati ricerca</h2>'+msg);
           
         }
 });
        $("#pannunci").val("");
        return false;
    });
};
function annunciIntroControl(){
if($('#annIntro').is('div')){
	$('.pform').css('display', 'none');
	$('.formText').css('display', 'none');
	$('.formRicerche').css('display', 'none');
	$('.cerca').css('display','block');
	$('.inserisciOfferta').css('display','block');
	$('.inserisciRichiesta').css('display','block');
	$('.piccoliIntro').css('display', 'none');
	}
};
function piccoliAnnunciIntroControl(){
	$('.piccoliIntro').click(function(){
		$('#annIntro').fadeIn(200);
		$('.piccoliIntro').fadeOut(150);
		$('.cerca').fadeIn(200);
		$(".pform").fadeOut(200);
		$(".inserisciOfferta").fadeIn(200);
        $(".inserisciRichiesta").fadeIn(200);
		if($('.formText').is('div')){
         	$('.formText').fadeOut(200);
         }
         if($('.formRicerche').is('div')){
         	$('.formRicerche').fadeOut(200);
         }
         $(".queryBox").fadeOut(200, function(){
                $(".queryBox").remove();
         });
		$('.annunciResults').remove();
         if ($('#noResults').is('span')){
                $('#noResults').remove(); 
            }
	});
};
function annunciSearchControl(){
	$(".cerca").click(function(){
		$("#pannunci").val("Cerca");
         $(".inserisciOfferta").fadeIn(200);
         $(".inserisciRichiesta").fadeIn(200);
         $('.piccoliIntro').fadeIn(200);
         $(".cerca").fadeOut(200);
     //    $(".formText").fadeIn(200);
         $(".pform").fadeIn(200);
         $('.annunciResults').remove();
         if($('.formText').is('div')){
         	$('.formText').fadeOut(200);
         }
         if($('.formRicerche').is('div')){
         	$('.formRicerche').fadeOut(200);
         }
         $(".queryBox").fadeOut(200, function(){
                $(".queryBox").remove();
         }); 
      if($('#annIntro').is('div')){
      	$('#annIntro').fadeOut(200);
      }
});
};
function annunciNewSearchControl(){
	$(".newsearch").click(function(){
		$("#pannunci").val("Cerca"); 
		$('.piccoliIntro').fadeIn(200);               
        $(".queryBox").fadeOut(200, function(){
            $(".queryBox").remove();
         });
         $('.annunciResults').remove();
         if ($('#noResults').is('span')){
                $('#noResults').remove(); 
            }
        $(".pform").fadeIn(200);
        $(".newsearch").fadeOut(200);
        $(".inserisciOfferta").fadeIn(200);
        $(".inserisciRichiesta").fadeIn(200);
    //    $(".formText").fadeIn(200);
        if($('#annIntro').is('div')){
      	$('#annIntro').fadeOut(200);
      	}
      if($('.formText').is('div')){
         	$('.formText').fadeOut(200);
         }
         if($('.formRicerche').is('div')){
         	$('.formRicerche').fadeOut(200);
         }
	});
};
function annunciInserisciOffertaControl(){
	$(".inserisciOfferta").click(function(){
		//$("#pannunci").val("Cerca");
         $(".inserisciOfferta").fadeOut(200);
         $(".inserisciRichiesta").fadeIn(200);
         $('.piccoliIntro').fadeIn(200);
         $(".cerca").fadeIn(200);
     
      //   $(".pform").fadeIn(200);
         $(".formText").fadeIn(200);
       //  $(".newsearch").fadeOut(200);
         if($('#annIntro').is('div')){
      		$('#annIntro').fadeOut(200);
      		}
      		if($('.pform').is('div')){
         	$('.pform').fadeOut(200);
         		}
         		if($('.formRicerche').is('div')){
         	$('.formRicerche').fadeOut(200);
         		}
      		$('.annunciResults').remove();
         $(".queryBox").fadeOut(200, function(){
                $(".queryBox").remove();
         });
	});
};
function annunciInserisciRichiestaControl(){
	$(".inserisciRichiesta").click(function(){
		//$("#pannunci").val("Cerca");
         $(".inserisciRichiesta").fadeOut(200);
         $(".inserisciOfferta").fadeIn(200);
         $('.piccoliIntro').fadeIn(200);
       	  $(".cerca").fadeIn(200);
       //  $(".pform").fadeIn(200);
         $(".formRicerche").fadeIn(200);
         $(".newsearch").fadeOut(200);
         if($('#annIntro').is('div')){
      		$('#annIntro').fadeOut(200);
      		}
      		if($('.pform').is('div')){
         	$('.pform').fadeOut(200);
         		}
         		if($('.formText').is('div')){
         	$('.formText').fadeOut(200);
         }
      		$('.annunciResults').remove();
         $(".queryBox").fadeOut(200, function(){
                $(".queryBox").remove();
         });
	});
};
function resetDirections(){
if ($(".googledir").is("div")){
    $("#maptxt").empty();  
    }
    fillAddressInSearch();
};
function searchAdressesByCat(){
    $(".asearchmapcat").click(function(){
        var el = $(this);
        var catName = el.attr('id');
        catName = catName.split("_");
        catName = catName[1];
        $.ajax({
            type: "GET",
            url: "searchmapcat.php",
            data: "searchmapcat="+catName,
            success: function(msg){
            var nameArray = new Array();
            nameArray[0] = new Array(1); 
            var tempName = msg.split("|");
            var controlArray = tempName[0].split(",");
            nameArray[0,2] =  controlArray[2];
            var nameCount = tempName.length;
            if(el.next().children("div").attr("class") == nameArray[0,2]){
                closeMapCatList(el)
            } else {
            el.next().fadeIn(150);
            for(var loop=0;loop<nameCount-1;loop++){
            var tempID = tempName[loop].split(",");
            nameArray[loop,0] = tempID[0];
            nameArray[loop,1] = tempID[1];
            nameArray[loop,3] = tempID[3];
            nameArray[loop,4] = tempID[4];
            nameArray[loop,5] = tempID[5];
            nameArray[loop,6] = tempID[6];
            nameArray[loop,7] = tempID[7];
            nameArray[loop,8] = tempID[8];
            nameArray[loop,9] = tempID[9];
            nameArray[loop,10] = tempID[10];
           // nameArray[loop,11] = tempID[11];
            var mapID = nameArray[loop,1];
            var location = {address:nameArray[loop,5], num:trim(nameArray[loop,6]), pcode:nameArray[loop,7], town:nameArray[loop,8], country:nameArray[loop,10]};
                var html = "";
                html += '<div onclick="loadMap('+nameArray[loop,3]+','+nameArray[loop,4]+');">';
                html += '<span id="id_'+mapID+'" class="'+location.address+','+location.num+','+location.pcode+','+location.town+','+location.country+'"><em>';
                html += nameArray[loop,0]+'</em></span></div>';
                el.next().append( html);
                $("#id_"+mapID).css("cursor","pointer");
                $("#id_"+mapID).css("cursor","hand");
                populateAddressText(mapID);
                } 
            el.next().children("div").addClass(catName);
            }  
       }
    }); 
        return false;
   });
};
function closeMapCatList(el){
        el.next().children("div").remove(); 
        el.next().fadeOut(150);
};
function populateAddressText(el){
                $("#id_"+el).click(function(){
                $.ajax({
            type: "GET",
            url: "mapcounter.php",
            data: "count="+el,
            success: function(msg){
            	//alert(msg);
            }
            });
                if($("#mapform").is("form")){
                    $("#mapform").remove(); 
                    var html = '<span class="address">'+$(this).attr('class')+ '</span><span class="resetMap"> Cerca nella mappa.</span>';
                    $(".entry").append(html);  
                    resetMap();     
                    }  else if($(".address").is("span")){
                    $(".address").empty();
                    var text = $(this).attr('class');
                    $(".address").text(text);
                    
           } 
            clearDirectionsForm();
             if (mapReset == true){
            resetDirections();
           $('#toAddress').val($(this).attr('class')); 
           resetMap();
        } 
    });
};
function fillAddressInSearch(){
    var bool = $(".address").is('span');
    var addressTxt = $(".address").text();
    if (bool == true && addressTxt != 'La tua ricerca non ha prodotto risultati.') {
    var myAddress = addressTxt.split(',');
    var goTo = trim(myAddress[1]+" "+myAddress[2]+","+myAddress[3]+","+myAddress[4]+","+myAddress[5])
    $('#toAddress').val(goTo);
    } 
};
function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
};
function clearDirectionsForm() {
    if ($("#toAddress").is("input")){
    $("#toAddress").val("");
    $("#fromAddress").val("");
    fillAddressInSearch();
    mapReset = true;
    $("#fromAddress").click(function(){
        $("#fromAddress").val("");
    });
    $("#toAddress").click(function(){
        $("#toAddress").val("");
    });
 } 
};
function homeTxtControl(){
$('.full').click(function(){
	$('.homeFull').fadeIn(220);
	$('.full').fadeOut(200);
	$('.closeFull').fadeIn(200);
//	$('.secondEntry').fadeOut(200);
	});
$('.closeFull').click(function(){
	$('.homeFull').fadeOut(220);
	$('.full').fadeIn(200);
	$('.closeFull').fadeOut(200);
//	$('.secondEntry').fadeIn(200);
	});
};
function homeImgSwap(){
var imgURL = DitoFront.site_url+"/wp-content/uploads/homepics/pic_";
	var rand_no = Math.floor((10-4)*Math.random()) + 5;
	rand_no = 7;
	console.log( imgURL );
	$('.homeFirst').find('img').attr({src:""+imgURL+rand_no+".jpg"});
};
function logoPositionControl(){
    $(".logfl").css({marginTop:"320px"});
};
function annunciTitleControl(){
	$('.annunciSubmit').click(function(){
		var titleCheck = $('.content_title_title').val();
		var contentCheck = $('.content_content').val();
		if ((titleCheck == "") || (contentCheck == "")) {
			alert("Alcuni campi obbligatori non sono stati completati.\nControlla e risottometti l'annuncio dopo aver aggiornato la pagina.");
		} else {
		alert("Il tuo annuncio \350 stato inviato alla redazione e sar\340 pubblicato al pi\371 presto.\nPer pubblicare un nuovo annuncio sotto questa stessa categoria premi il tasto aggiorna nella finestra del browser.\nGrazie per aver utilizzato questo servzio.");
		}
	});
};
function expandCollapse(){
	//alert('is jquery and home');
	$('div.expander p').expander({
	  slicePoint: 55, 
	  widow: 2,
	  expandEffect: 'fadeIn',
	//  expandText:       '[&darr;]',
	  expandText:       '[Leggi]',
	 // userCollapseText: '[&uarr;]'
	userCollapseText: '[Chiudi]'
	});
};
function fixVideoGalleries()
{
	var fix = $('.tubepress_thumb').eq(3) || $('.tubepress_thumb').eq(7) || $('.tubepress_thumb').eq(11) || $('.tubepress_thumb').eq(15) || $('.tubepress_thumb').eq(19);
	fix.css('padding-right', '0px');
	fix.css('margin-right', '0px');
};
function expandLinks()
{
	var h2 = $(".linkcat").find('h2');
	var ul = $(".xoxo");
	h2.click(function(){
		if($(this).attr('id') != 'open')
		{
			$(this).next().show(400, function(){$(this).attr('id', 'open');});
		}
		$('#open').hide(400, function(){$(this).removeAttr('id');});
	});
};
function videoSidebarCssFixes()
{
	var elOne = $("div.tubepress_sidebar>div.tubepress_thumbnail_area>div.tubepress_thumbs>div.tubepress_thumb").eq(0);
	var elTwo = $("div.tubepress_sidebar>div.tubepress_thumbnail_area>div.tubepress_thumbs>div.tubepress_thumb").eq(1);
	elOne.css("padding-right", "60px");
	elTwo.css("padding-right", "0px")
};