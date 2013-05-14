<section class="article">
				<header>
					<h1>Installation</h1>
			  	</header><div class="imageArticle"><center><img  class="imgArticle" src="./images/images articles/image2.jpg" /></center></div><article>
			   <article>Suppression: pour supprimer un package il suffit de taper rpm -e mpg123 ****************************************************************************************************** Les packages Debian sont ainsi des fichiers portant l'extension .deb et pouvant être installés manuellement grâce à la commande suivante : dpkg -i nom_du_package.deb  (manuellement) dpkg --install nom_du_package.deb ou dpkg -i nom_du_package Installation: pour installer le package "nom_du_package" il suffira de taper : apt-get install nom_du_package ************************************************************************************************************* Tar: les données sous ce format portent l'extension .tar pour décompresser ce type de données il faut taper en ligne de commande : tar xvf nom_du_fichier.tar Gzip: les fichiers compressées en Gzip possèdent l'extension .gz pour décompresser ces fichiers il faut taper en ligne de commande : gunzip nom_du_fichier.gz Bzip2: les fichiers compressées en Bzip2 possèdent l'extension .bz2 pour décompresser ces fichiers il faut taper en ligne de commande : bzip2 -d nom_du_fichier.bz2 Tar/GZip (on parle généralement de Tarball): les données compressées en TAR et en GZIP portent l'extension .tar.gz Elles peuvent être décompressées successivement par les deux moyens énoncés ci-dessus ou à l'aide de la commande : tar zxvf nom_du_fichier.tar.gz Tar/BZip2: les données compressées en Tar et en Bz2 portent l'extension .tar.bz2 Elles peuvent être décompressées successivement par les deux moyens énoncés ci-dessus ou à l'aide de la commande : tar jxvf nom_du_fichier.tar.bz2 Compiler le programme Dans un premier temps il faut exécuter la commande : ./configure Pour installer l'application dans un répertoire spécifique : ./configure --prefix="repertoire" Dans un second temps il faut compiler le programme, grâce à la directive make Pour installer l'application, la syntaxe suivante est généralement utilisée : make install </article>
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