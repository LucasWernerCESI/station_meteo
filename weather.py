import requests

api_address = 'http://api.openweathermap.org/data/2.5/weather?APPID=aa5031fee8175b3801b195a4a885f30e&lang=fr&q=' # on recupere l'adresse de l'API en ayant pris soin de ne pas selectionné de ville dans l'URL 'q='
city = input("City Name :") # on fait un prompt pour récupérer la ville souhaité par le client 
url = api_address + city                            # concaténation URL + Ville

json_data = requests.get(url) .json()               #
cloud = json_data['weather'] [0] ['description']    # Nous permet d'affiché la description lors de l'execution du script dans un print()
humidity = json_data['main'] ['humidity']           # ainsi que l'humidité dans un print()
t = json_data['main']['temp']
print("La température est de {} °c".format(t-273.15))
print("Actuellement le temps est : " + cloud)
print("Et le taux d'humidité est de : ", end="") ; print(humidity, end="%") # le end="" permet de ne pas aller a la ligne &/ou ajouter un print()

# si vous voulez essayer le script : executer le et taper le nom de la ville qui vous interesse :) . *Yann