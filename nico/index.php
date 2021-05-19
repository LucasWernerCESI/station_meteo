     <!-- tester si l'utilisateur est connecté si non retourne sur la page login.php -->
<?php
  session_start();
  if($_SESSION["autoriser"] !== "oui"){
    header("location:login.php");
    exit();
  }
    // Si on clique sur déconnection on retrourne sur login.php
  if(isset($_GET['deconnexion']))
    { 
      if($_GET['deconnexion']==true)
      {  
          header("location:login.php");
      }
    }
  
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/superhero/bootstrap.min.css" rel="stylesheet" title="main">
    <link rel="stylesheet" href="css/styleIndex.css" type="text/css">
    <script src='app.js'></script>
    <title>Projet DI2020</title>
  </head>
  <body>
          <hearder> <h3> Application - Météo <br>
        <!--Message de bienvenu à l'utilisateur--> 
		<?php 
			echo (date("H")<18)?("Bonjour"):("Bonsoir");
		?>
		<span>
		<?=$_SESSION["Login"]?>
		</span>
		
          </h3></hearder>
     
      <div class="container-fluid">
        <ul class="nav nav-tabs" id="tab">
          <li class="active"><a href="#tab_mesures" data-toggle="tab">Mesures</a></li>
          <li><a href="#tab_graphs" data-toggle="tab">Graphiques</a></li>
          <li><a href="#tab_gpio" data-toggle="tab">Emplacement  </a></li>
          <li><a href="#tab_configuration" data-toggle="tab">Configuration</a></li>
          <button  class="btn btn-default" id="" style="float: right;"> <a href='deconnexion.php' style="text-decoration: none; color:brown;"><span>Déconnexion</span></a></button>
        </ul>
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab_mesures">        
          <h2 class="title">Relevé météo</h2>
          <hr noshade style="border:1px solid grey-light;">
                <div class="card" id="divcard">
                  <div class="card-body" id="divmesure">
                    <h5 class="card-title"><div class="" id="nom_emplacement">-</div></h5>
                    <p class="card-text"><div class="" id="temperature">-</div> <div class="" id="humidite">-</div></p>
                    <a href="#" class="btn btn-default">Voir plan</a>
                    <input type="button" class="btn btn-default" id="labelTheme" value="Actualiser" onclick="buttonClickGET()"/><br>
                  </div>
                </div>
          </div>
          <hr style="border:1px solid grey-light;">
        <div class="tab-pane fade" id="tab_graphs">
          <div id="chart_div"></div>
        </div>
        <div class="tab-pane fade" id="tab_gpio">
          <h2>Emplacement</h2>
          <div class="row">
            <div class="col-xs-4 col-md-4">
              <h4 class="text-left">Chambre
                <div class="span badge" id="D5_etat">ON</div>
              </h4>
            </div>
            <div class="col-xs-4 col-md-4">
              <div class="button btn btn-success btn-lg" id="D5_On" type="button">ON</div>
              
            </div>
            <div class="col-xs-4 col-md-4">
              <div class="button btn btn-danger btn-lg" id="D5_Off" type="button">OFF</div>
              <div class="button btn btn-danger btn-lg" id="supprimer" type="submit">Supprimer</div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4 col-md-4">
              <h4 class="text-left">Salon
                <div class="span badge" id="D6_etat">OFF</div>
              </h4>
            </div>
            <div class="col-xs-4 col-md-4">
              <div class="button btn btn-success btn-lg" id="D6_On" type="button">ON</div>
            </div>
            <div class="col-xs-4 col-md-4">
              <div class="button btn btn-danger btn-lg" id="D6_Off" type="button">OFF</div>
              <div class="button btn btn-danger btn-lg" id="supprimer" type="submit">Supprimer</div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4 col-md-4">
              <h4 class="text-left">Jardin
                <div class="span badge" id="D7_etat">OFF</div>
              </h4>
            </div>
            <div class="col-xs-4 col-md-4">
              <div class="button btn btn-success btn-lg" id="D7_On" type="button">ON</div>
            </div>
            <div class="col-xs-4 col-md-4">
              <div class="button btn btn-danger btn-lg" id="D7_Off" type="button">OFF</div>
              <div class="button btn btn-danger btn-lg" id="supprimer" type="submit">Supprimer</div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4 col-md-4">
              <h4 class="text-left">Garage
                <div class="span badge" id="D8_etat">OFF</div>
              </h4>
            </div>
            <div class="col-xs-4 col-md-4">
              <div class="button btn btn-success btn-lg" id="D8_On" type="button">ON</div>
            </div>
            <div class="col-xs-4 col-md-4">
              <div class="button btn btn-danger btn-lg" id="D8_Off" type="button">OFF</div>
              <div class="button btn btn-danger btn-lg" id="supprimer" type="submit">Supprimer</div>
            </div>
          </div>
          <br><hr>
          <form action="">
          <input type="text" id="ajouter" value="Emplacement à ajouter" style="border-radius: 2px;"><br><br>
          <div class="button btn btn-success btn-lg" id="ajouter" type="submit">Ajouter</div>

          </form>

        </div>
        <div class="tab-pane fade" id="tab_configuration">
          <h2>Configuration</h2>
          <div class="btn-group">
            <button class="btn btn-default" id="labelTheme">Theme</button>
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a class="change-style-menu-item" href="#" rel="bootstrap">Boostrap</a></li>
              <li><a class="change-style-menu-item" href="#" rel="cerulean">Cerulean</a></li>
              <li><a class="change-style-menu-item" href="#" rel="cosmo">Cosmo</a></li>
              <li><a class="change-style-menu-item" href="#" rel="cyborg">Cyborg</a></li>
              <li><a class="change-style-menu-item" href="#" rel="darkly">Darkly</a></li>
              <li><a class="change-style-menu-item" href="#" rel="flatly">Flatly</a></li>
              <li><a class="change-style-menu-item" href="#" rel="journal">Journal</a></li>
              <li><a class="change-style-menu-item" href="#" rel="lumen">Lumen</a></li>
              <li><a class="change-style-menu-item" href="#" rel="paper">Paper</a></li>
              <li><a class="change-style-menu-item" href="#" rel="readable">Readable</a></li>
              <li><a class="change-style-menu-item" href="#" rel="sandstone">Sandstone</a></li>
              <li><a class="change-style-menu-item" href="#" rel="simplex">Simplex</a></li>
              <li><a class="change-style-menu-item" href="#" rel="slate">Slate</a></li>
              <li><a class="change-style-menu-item" href="#" rel="spacelab">Spacelab</a></li>
              <li><a class="change-style-menu-item" href="#" rel="superhero">Superhero</a></li>
              <li><a class="change-style-menu-item" href="#" rel="united">United</a></li>
              <li><a class="change-style-menu-item" href="#" rel="yeti">Yeti  </a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <footer></footer>

  </body>
</html>
