<section class="article">
				<header>
					<h1>Installation</h1>
			  	</header><div class="imageArticle"><center><img  class="imgArticle" src="./images/images articles/image2.jpg" /></center></div><article>
			   <article>Suppression: pour supprimer un package il suffit de taper rpm -e mpg123 ****************************************************************************************************** Les packages Debian sont ainsi des fichiers portant l'extension .deb et pouvant �tre install�s manuellement gr�ce � la commande suivante : dpkg -i nom_du_package.deb  (manuellement) dpkg --install nom_du_package.deb ou dpkg -i nom_du_package Installation: pour installer le package "nom_du_package" il suffira de taper : apt-get install nom_du_package ************************************************************************************************************* Tar: les donn�es sous ce format portent l'extension .tar pour d�compresser ce type de donn�es il faut taper en ligne de commande : tar xvf nom_du_fichier.tar Gzip: les fichiers compress�es en Gzip poss�dent l'extension .gz pour d�compresser ces fichiers il faut taper en ligne de commande : gunzip nom_du_fichier.gz Bzip2: les fichiers compress�es en Bzip2 poss�dent l'extension .bz2 pour d�compresser ces fichiers il faut taper en ligne de commande : bzip2 -d nom_du_fichier.bz2 Tar/GZip (on parle g�n�ralement de Tarball): les donn�es compress�es en TAR et en GZIP portent l'extension .tar.gz Elles peuvent �tre d�compress�es successivement par les deux moyens �nonc�s ci-dessus ou � l'aide de la commande : tar zxvf nom_du_fichier.tar.gz Tar/BZip2: les donn�es compress�es en Tar et en Bz2 portent l'extension .tar.bz2 Elles peuvent �tre d�compress�es successivement par les deux moyens �nonc�s ci-dessus ou � l'aide de la commande : tar jxvf nom_du_fichier.tar.bz2 Compiler le programme Dans un premier temps il faut ex�cuter la commande : ./configure Pour installer l'application dans un r�pertoire sp�cifique : ./configure --prefix="repertoire" Dans un second temps il faut compiler le programme, gr�ce � la directive make Pour installer l'application, la syntaxe suivante est g�n�ralement utilis�e : make install </article>
			   <footer class="signature">
				 <p>
					Auteur : Someone
					 <time datetime="16/04/2013">16/04/2013</time>
				 </p>
			   </footer>
			 </article>
			 </section>
			 <script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
			<fb:comments></fb:comments>