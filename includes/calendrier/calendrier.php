
<div class="calendrier responsiveDemo">
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
	
</div>

<!--script src="js/jquery.timeago.js" type="text/javascript"></script-->
<!--<script src="js/jquery.eventCalendar.min.js" type="text/javascript"></script>-->
<script src="./includes/calendrier/js/jquery.eventCalendar.js" type="text/javascript"></script>
