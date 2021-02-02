import json

with open('data.txt') as json_file:
    data = json.load(json_file)
    for p in data['people']:
        print('Name: ' + p['name'])
        print('Website: ' + p['website'])
        print('From: ' + p['from'])
        print('')


# json.load a une méthode alternative qui nous permet de traiter directement les chaînes car
# on n'aura probablement pas d'objet semblable à un fichier contenant notre JSON.
# cette méthode est json.loads .
# Dans le cas où on appele un point de terminaison REST GET qui renvoie JSON.
# Ces données nous parvient sous forme de chaîne (str()),
# à laquelle on peux ensuite passer json.loads directement à la place.