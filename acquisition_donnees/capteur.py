import requests
import json

with open("C:/Documents/OneDrive - ESLC Energies/Documents/CESI/Dépot Github Projet/station_meteo/capteur.json") as file:
  json_data = json.load(file)

Time= json_data['StatusSNS']['Time'] 
humidity = json_data['StatusSNS']["HTU21"]['Humidity'] 
t = json_data['StatusSNS']['HTU21']['Temperature']
print("Actuellement il est : " + Time)
print("La température est de :" , end="") ; print(t, "c°")
print("Et le taux d'humidité est de : ", end="") ; print(humidity, end="%")