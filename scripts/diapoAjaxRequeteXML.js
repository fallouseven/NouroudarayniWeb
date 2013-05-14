// JavaScript Document
			var tabImages = new Array();
			var content ='';
			indice=0;
			function createXHR() {
			
					if (window.ActiveXObject) {
							return(new ActiveXObject("Microsoft.XMLHTTP"));
					} else if (window.XMLHttpRequest) {
							return(new XMLHttpRequest());
					} else {
							return(null);
					}
			}
			function envoyerRequeteXML(param) {
					requete = createXHR();
					requete.onreadystatechange = traiterReponseXML;
					requete.open("GET", "./ressources/images.xml", true);
					requete.send(null);
			}
			
			function traiterReponseXML() {
				if ((requete.readyState == 4) && (requete.status == 200)) {
					reponseEnXML=requete.responseXML;
					listeElements=reponseEnXML.getElementsByTagName("image");
					tabImages = new Array(listeElements.length);
					content = '<ul class="diaporama1">';
					for (i=0;i<listeElements.length;i++) {
						 content += '<li><img src="./images/diaporama/'+listeElements[i].childNodes[0].nodeValue+'" class="imgDiapo" alt="nourou darayni" title="diaporama"/></li>';
					 }	
					 content+='</ul>';		
					 document.getElementById("diaporama").innerHTML= content;
					 $(".diaporama1").jDiaporama({
						animationSpeed: "slow",
						delay:2
					});
				}
			}
			  
			window.onload = envoyerRequeteXML;