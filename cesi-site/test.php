<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Stages</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Votre Dashboard :</h1>
        <p>Vous avez postulé à <strong>30 offres</strong> :</p>
        
        <div class="offers">
            <div class="offer">
                <div class="text">
                    <h2>Nom du stage</h2>
                    <p>Nom de l'entreprise</p>
                </div>
                <div class="actions">
                    <span class="heart">&#9825;</span>
                    <button>VOIR L’OFFRE</button>
                </div>
            </div>
            <div class="offer">
                <div class="text">
                    <h2>Nom du stage</h2>
                    <p>Nom de l'entreprise</p>
                </div>
                <div class="actions">
                    <span class="heart">&#9825;</span>
                    <button>VOIR L’OFFRE</button>
                </div>
            </div>
            <div class="offer">
                <div class="text">
                    <h2>Nom du stage</h2>
                    <p>Nom de l'entreprise</p>
                </div>
                <div class="actions">
                    <span class="heart">&#9825;</span>
                    <button>VOIR L’OFFRE</button>
                </div>
            </div>
        </div>
        
        <div class="pagination">
            <a href="#" class="prev">&larr; Précédent</a>
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#" class="active">7</a>
            <a href="#">8</a>
            <span>...</span>
            <a href="#">17</a>
            <a href="#">18</a>
            <a href="#">19</a>
            <a href="#">20</a>
            <a href="#" class="next">Suivant &rarr;</a>
        </div>
    </div>
</body>
</html>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f8f8f8;
    text-align: center;
}
.container {
    width: 60%;
    margin: auto;
    padding: 20px;
}
.offers {
    margin-top: 20px;
}
.offer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #6495ED;
    border-radius: 30px;
    padding: 15px;
    margin-bottom: 15px;
    color: white;
}
.text {
    text-align: left;
    margin-left: 15px;
}
.actions {
    display: flex;
    align-items: center;
}
.heart {
    font-size: 20px;
    margin-right: 15px;
    cursor: pointer;
}
button {
    background-color: #111c43;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    cursor: pointer;
}
.pagination {
    margin-top: 20px;
}
.pagination a, .pagination span {
    display: inline-block;
    padding: 10px 15px;
    text-decoration: none;
    color: black;
    border-radius: 5px;
}
.pagination .active {
    background-color: #6495ED;
    color: white;
}
</style>
