<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />

	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />

	<title>jQuery Event Calendar Demo Page</title>
	<link rel="shortcut icon" href="images/favicon.ico" />

	<!-- Grid CSS File (only needed for demo page) -->
	

	<!-- Core CSS File. The CSS code needed to make eventCalendar works -->
	<link rel="stylesheet" href="./includes/calendrier/css/eventCalendar.css">

	<!-- Theme CSS file: it makes eventCalendar nicer -->
	<link rel="stylesheet" href="./includes/calendrier/css/eventCalendar_theme_responsive.css">

	<!--<script src="js/jquery.js" type="text/javascript"></script>-->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>-->

</head>
<body class="calendrier" ="responsiveDemo">
		<div class="row">
			<div class="g4">
				<div id="eventCalendarLocale"></div>
			<script>
				$(document).ready(function() {
					$("#eventCalendarLocale").eventCalendar({
						eventsjson: './includes/calendrier/json/events.json',
						monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
							"Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre" ],
						dayNames: [ 'Dimanche','Lundi','Mardi','Mercredi',
							'Jeudi','Vendredi','Samedi' ],
						dayNamesShort: [ 'Dim','Lun','Mar','Mer', 'Jeu','Ven','Sam' ],
						txt_noEvents: "Pas d'évenement pour cette période",
						txt_SpecificEvents_prev: "",
						txt_SpecificEvents_after: "Evénement:",
						txt_next: "Suivant",
						txt_prev: "Précédent",
						txt_NextEvents: "Prochain Evénement:",
						txt_GoToEventUrl: "Aller à l'évenement"
					});
				});
			</script>
			</div>
		</div>
	
</body>

<!--script src="js/jquery.timeago.js" type="text/javascript"></script-->
<!--<script src="js/jquery.eventCalendar.min.js" type="text/javascript"></script>-->
<script src="./includes/calendrier/js/jquery.eventCalendar.js" type="text/javascript"></script>




</html>