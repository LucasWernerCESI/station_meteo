
/*
let http = require('http') //Création d'un serveur en NodeJS
let fs = require('fs')
let url = require('url')




let server = http.createServer()
server.on('request', (request, response) => {
    
    response.writeHead(200)
    let query = url.parse(request.url, true).query // Récupère les informations de l'URL
    let name = query.name === undefined ? 'anonyme' : query.name

    fs.readFile('server.html', 'utf8', (err, data) => {
        if(err) {
            response.writeHead(404)
            response.end('Ce fichier n\'existe pas...')
        }else{
        response.writeHead(200, {
            'Content-type': 'text/html; charset=utf-8'

        })  
    data = data.replace('{{ name }}', name) // Récupère la partie HTML pour la remplacer par la variable Name afin de recupérer le nom du user dans l'url
    response.end(data)
        }
    })

})
server.listen(8080)
*/

/*
const EventEmitter = require('events')      // créer une variable qui va contenir un evenement

let monEcouteur = new EventEmitter()        // création de l'évènement 
monEcouteur.on('saute', function(a, b){     // a chaque fois que mon ecouteur va sauter alors mes moi le console.log 
    console.log("j'ai sauté",a, b)          // si on utilise monEcouteur.once alors il va executer le code que la premiere fois que l'event va etre lancé
})

monEcouteur.emit('saute', 10, 20)           // Permet de choisir le statut de l'ecouteur ... ( on lui dit de sauté afin que le console.log ce déclenche)
monEcouteur.emit('saute')
monEcouteur.emit('saute')
monEcouteur.emit('saute')
*/
/*
let http = require('http') //Création d'un serveur en NodeJS
let fs = require('fs')
let url = require('url')
const EventEmitter = require('events')

let App = {
    start: function(port){
        let emitter = new EventEmitter()
        let server = http.createServer((request, response) => {
            response.writeHead(200)

            if (request.url === '/'){
                emitter.emit('root', response)
            }
            response.end()
        }).listen(port)
        return emitter
    }
}

let app = App.start(8080)
app.on('root', function(response){
    response.write('je suis a la racine')
})
*/