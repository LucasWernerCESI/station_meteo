CREATE DATABASE station_meteo CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER station_meteo@localhost;
GRANT ALL PRIVILEGES ON station_meteo.* TO station_meteo@localhost;
FLUSH PRIVILEGES;

//ATTENTION A EXECUTER LES SCRIPTS SEPAREMENT

CREATE TABLE emplacements(
   id_emplacement INT NOT NULL AUTO_INCREMENT,
   nom_emplacement VARCHAR(50) DEFAULT '',
   CONSTRAINT pk_id_emplacement PRIMARY KEY(id_emplacement)
);

CREATE TABLE sondes(
   id_sonde INT NOT NULL,
   id_emplacement INT NOT NULL,
   CONSTRAINT pk_id_sonde PRIMARY KEY(id_sonde),
   CONSTRAINT fk_id_emplacement FOREIGN KEY(id_emplacement) REFERENCES emplacements(id_emplacement)
);

CREATE TABLE donnees_meteo(
   id_releve_meteo INT NOT NULL AUTO_INCREMENT,
   date_heure TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
   temperature DECIMAL(6,2) DEFAULT NULL,
   humidite DECIMAL(6,2) DEFAULT NULL,
   id_sonde INT NOT NULL,
   CONSTRAINT pk_id_releve_meteo PRIMARY KEY(id_releve_meteo),
   CONSTRAINT fk_id_sonde FOREIGN KEY(id_sonde) REFERENCES sonde(id_sonde)
);