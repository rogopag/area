var showMarkersTxt = true;
$(document).ready(function(){
	loadMap();
	getColumnsEditTxt();
	saveChangesOnMap();
	deletePointOnMap();
	$("#subMap").click(function(){showAddress();return false});
	$("#btnSave").click(function(){
		var txt = $("form").serializeArray();
		//alert("service="+txt[2].value+"&address="+txt[1].value+"&category="+txt[3].value+"&latitude="+txt[4].value+"&longitude="+txt[5].value);
		$.ajax({
			type: "GET",
			url: "populate.php",
			data: "service="+txt[2].value+"&address="+txt[1].value+"&category="+txt[3].value+"&latitude="+txt[4].value+"&longitude="+txt[5].value,
			success: function(msg){
				alert(msg);
			}
		});
		$("#search").val("");
		return false;
	});
});

////////////////////GOOGLE MAPS////////////////////////////////////////
function loadMap() {
	if (GBrowserIsCompatible()) {
		map = new GMap2(document.getElementById("carta"));
		map.addControl(new GLargeMapControl());
		map.addControl(new GMapTypeControl());
		map.setCenter(new GLatLng(44.809121700077355, 10.01953125), 5, null);
		geo = new GClientGeocoder();
		currCoords = map.getCenter();
		currLon = currCoords.lng();
		currLat = currCoords.lat();
		divide_string(currLat,currLon);
		GEvent.addListener(map, 'dblclick', function() {
			currCoords = map.getCenter();
			currLon = currCoords.lng();
			currLat = currCoords.lat();
			var showmarks = true;
			divide_string(currLat,currLon);
			if ($("#message").find("p").is('p')){
				$("#message p").fadeOut();
				$("#search").val("");
				showMarkersTxt = false;
			}
		});

		reasons=[];
		reasons[G_GEO_SUCCESS]            = "Success";
		reasons[G_GEO_MISSING_ADDRESS]    = "Indirizzo mancante: non è stato inserito alcun indirizzo.";
		reasons[G_GEO_UNKNOWN_ADDRESS]    = "Indirizzo sconosciuto: non esistono dati per l'indirizzo inserito.";
		reasons[G_GEO_UNAVAILABLE_ADDRESS]= "Indirizzo non disponibile:  per ragioni legali o contrattuali Gmaps non può fornire le coordinate per l'indirizzo richiesto.";
		reasons[G_GEO_BAD_KEY]            = "Chiave di registrazione errata: la chiave API utilizzata non è valida per questo dominio.";
		reasons[G_GEO_TOO_MANY_QUERIES]   = "Attenzione: il numero di richieste giornaliere è stato superato.";
		reasons[G_GEO_SERVER_ERROR]       = "Errore dal server: la richiesta non può essere completata. Si prega di riprovare più tardi";

	}
	else {
		alert("Attenzione, il browser in uso non supporta le Mappe di Google.");
	}
}

function showAddress() {
	removeMarker();
	var search = document.getElementById("search").value;
	geo.getLocations(search, function (result)
	{
		if (result.Status.code == G_GEO_SUCCESS) {
			document.getElementById("message").innerHTML = "<p><strong>Trovati " +result.Placemark.length +" risultati</strong></p>";
			for (var i=0; i<result.Placemark.length; i++) {
				var p = result.Placemark[i].Point.coordinates;
				var marker = new GMarker(new GLatLng(p[1],p[0]));
				document.getElementById("message").innerHTML += "<p>"+(i+1)+": <a href=\"#\" onclick=\"panMapTo("+p[1]+","+p[0]+")\">"+ result.Placemark[i].address+"<span class=\""+i+"\" style=\"display:none\">("+p[1]+", "+p[0]+")</span></a></p>";

				GEvent.addListener(marker, "click", function(){
					var coords =  this.getPoint();
					var coordsToText = coords.toString();
					coordsToText = coordsToText.split(',');
					var latitude = coordsToText[0];
					latitude = latitude.substring(latitude.indexOf('(')+1);
					var longitude = coordsToText[1];
					longitude = longitude.replace(')', '');
					var spans = $("span:contains("+coords+")")
					var address = spans.parent().text();
					if ($(".clickedMarker").is("a")) {
						$(".clickedMarker").removeClass("clickedMarker");
					}
					spans.parent().addClass("clickedMarker");
					var hook = address.lastIndexOf('(');
					address =  address.substring(0, hook);
					panMapTo(latitude,longitude);
					$("#search").val(address);
					divide_string(latitude,longitude);
					var pCss = spans.parent().parent().css('display');
					if (showMarkersTxt == false) {
						if ($("#message p") != spans.parent().parent()){
							$("#message p").fadeOut();
							showMarkersTxt = true;
						}
						if (pCss == 'none'){
							spans.parent().parent().fadeIn();
							map.setCenter(new GLatLng(latitude, longitude), 14, null);
							showMarkersTxt = false;
						}
						showMarkersTxt = false;
					}

				});

				$("#message").find("a").click(function(){
					var addrTxt = $(this).text();
					$("#search").val(addrTxt);
					if ($(".clickedMarker").is("a")) {
						$(".clickedMarker").removeClass("clickedMarker");
					}
					$(this).addClass("clickedMarker");
				});
				map.addOverlay(marker);
			}
			var p = result.Placemark[0].Point.coordinates;
			map.setCenter(new GLatLng(p[1],p[0]),10);
			divide_string(p[1],p[0]);
		}
		else {
			var reason="Codice "+result.Status.code;
			if (reasons[result.Status.code]) {
				reason = reasons[result.Status.code]
			}
			alert('Impossibile trovare "'+search+ '".  ' + reason);
		}
	}
	);//chiude getLocations
} //chiude showAddress getPoint()

function panMapTo(p1,p0){
	map.setCenter(new GLatLng(p1,p0),14,null);
	divide_string(p1,p0)
}
function removeMarker() {
	if ($("#message").find("a").is("a")){
		var currentLocation = $("#message").find("a").attr("onclick");
		map.clearOverlays();
	}
	return;
}
function divide_string(p1,p0){
	var txt_lat=document.getElementById('lat');
	var txt_lng=document.getElementById('lng');
	txt_lat.value=p1;
	txt_lng.value=p0;
}
function getColumnsEditTxt(){
	var texts = new Array();
	var columns = new Array();
	$("tr.mapEditRow").click(function(){
		var el = $(this);
		var els = $(this).find('td');
		els.each(function(i){
			texts[i] = $(this).text();
			columns = $(this);
		});
		$('#editService').val(texts[0]);
		$('#editAddress').val(texts[1]);
		$('#editCap').val(texts[2]);
		$('#editTown').val(texts[3]);
		$('#editProv').val(texts[4]);
		$('#editCountry').val(texts[5]);
		$('#editLat').val(texts[6]);
		$('#editLng').val(texts[7]);
		$('#editCat').val(texts[8]);
		$('#editID').val(texts[9]);
	});
	return false;
}
var deletePointOnMap = function(){
	$('#deletePoint').click(function(){
		var toDelete = $('#editID').val();
		var row = "edit_"+$('#editID').val();
		var elRow = $("#"+row);
		$.ajax({
			type: "POST",
			url: "editmaps.php",
			data: "delete="+toDelete+"&do=delete",
			success: function(msg){
				elRow.fadeOut(300, function(){
					elRow.remove();
				});
				$('#editService').val('');
				$('#editAddress').val('');
				$('#editCap').val('');
				$('#editTown').val('');
				$('#editProv').val('');
				$('#editCountry').val('');
				$('#editLat').val('');
				$('#editLng').val('');
				$('#editCat').val('');
				$('#editID').val('');
			}
		});
		return false;
	});
}
saveChangesOnMap = function(){
	$('#saveChanges').click(function(){
		var row = "edit_"+$('#editID').val();
		var elRow = $("#"+row);
		var elsTd = elRow.find('td');

		$.ajax({
			type: "POST",
			url: "editmaps.php",
			data: "service="+$('#editService').val()+"&cap="+$('#editCap').val()+"&address="+$('#editAddress').val()+"&category="+$('#editCat').val()+"&latitude="+$('#editLat').val()+"&longitude="+$('#editLng').val()+"&prov="+$('#editProv').val()+"&country="+$('#editCountry').val()+"&town="+$('#editTown').val()+"&mapid="+$('#editID').val()+"&do=edit",
			success: function(msg){
				var newPoint = msg.split('|');
				elsTd.each(function(i){
					$(this).text(newPoint[i]);
					$('#editService').val('');
					$('#editAddress').val('');
					$('#editCap').val('');
					$('#editTown').val('');
					$('#editProv').val('');
					$('#editCountry').val('');
					$('#editLat').val('');
					$('#editLng').val('');
					$('#editCat').val('');
					$('#editID').val('');
				});
			}
		});
		return false;
	});
}