window.onload = () => {

    const root = document.getElementById("dashboard");

    const resource = 'places';
    const headers = ( new Headers() ).append( "Content-Type", "application/json" );
    let body = {
        placeName: "Catacombes"
    };

    let getEndpoint = "api/" + resource + "/read",
        getOptions = {
            method: "GET",
            cors: "cors",
            headers: headers
        },
        postEndPoint = "api/" + resource + "/create",
        postOptions = {
            method: "POST",
            cors: 'cors',
            headers: headers,
            body: JSON.stringify( body )
        };

    console.log(postOptions.body)

    fetch( getEndpoint, getOptions )
        .then( response => response.json() )
        .then( data => {
            console.log( data );

            const dashboard = document.createDocumentFragment();

            data.map( place => {

                const { placeName, placeId, sensorId } = place;

                let tile = document.createElement('div');
                tile.classList.add("col-md-4");
                tile.classList.add("g-3");

                let card = document.createElement('div');
                card.classList.add("card");

                //Bind event on card
                card.addEventListener('click', ev => {
                    document.location('replace: ')
                })

                let cardHeader = document.createElement("div");
                cardHeader.classList.add("card-header");
                cardHeader.innerText = placeName;

                let cardBody = document.createElement("div");
                cardBody.classList.add("card-body");
                cardBody.innerText = `
                    Tmp. : 38°C
                    H. : 34%
                    Pr. : 1013 hPa
                `;

                tile.appendChild(card);
                card.appendChild(cardHeader);
                card.appendChild(cardBody);
                dashboard.appendChild(tile);

            } )

            root.appendChild(dashboard);

        } )
};

function createCard(){

};