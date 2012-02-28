// JavaScript Document
			function createXHR() {
			
					if (window.ActiveXObject) {
							return(new ActiveXObject("Microsoft.XMLHTTP"));
					} else if (window.XMLHttpRequest) {
							return(new XMLHttpRequest());
					} else {
							return(null);
					}
			}
			