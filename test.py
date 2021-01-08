import json
from datetime import datetime

def read():
    with open(r"C:\\Users\\Lucie\Documents\\CESI Cours\\GitHub\station_meteo\\test.json") as weather_json:
        weather = json.load(weather_json)
        weather_time = weather["StatusSNS"]["Time"]
        weather_temp = weather["StatusSNS"]["HTU21"]["Temperature"]
        weather_unit = weather["StatusSNS"]["TempUnit"]
        weather_hum = weather["StatusSNS"]["HTU21"]["Humidity"]
        print(f"{weather_time} - Il fait {weather_temp}°{weather_unit}.\nL'air contient {weather_hum}% d'humidité")
        print("{0} - Il fait {1}°{2}, l'air contient {3}% d'humidité".format(weather_time, weather_temp, weather_unit, weather_hum))
        print(f"Date d'aujourd'hui : {datetime.now()}")

read()