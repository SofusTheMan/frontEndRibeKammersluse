<!DOCTYPE html>
<html lang="dk">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
        <link rel="stylesheet" type="text/css" href="mycss.css">
        <script type="text/javascript" src="myjs.js"></script>
        <title>Ribe Kammersluse</title>
    </head>
    <body>

        <div class="container-fluid">
            <h1>Ribe Kammersluse</h1>

            <div class="row">
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Gennemslusning af en båd</h5>
                            <p class="card-text">75 kr.</p>
                            <a href="#" class="btn btn-danger" onclick="STM('single-boat')">Vælg</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Gennemslusning af flere både</h5>
                            <div>
                                <p id="multiBoatDivTitle">50 kr. pr. båd</p>
                                <div id="multiBoatDivBtnDiv">
                                    <button class="multiBoatDivBtn" onclick="removeBoat()">-</button>
                                    <p id="multiBoatDivText">2</p>
                                    <button class="multiBoatDivBtn" onclick="addBoat()">+</button>
                                </div>
                            </div>
                            <br>
                            <p id="dynamicPrice">100 kr.</p>
                            <a href="#" class="btn btn-danger" onclick="STM('multi-boat')">Vælg</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Hævning af kørebro</h5>
                            <p class="card-text">50 kr.*</p>
                            <p class="centerText">*Hævning af kørebro under slusning er gratis.</p>
                            <a href="#" class="btn btn-danger" onclick="STM('kørebro')">Vælg</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Fjernelse af gangbro fra slusetoppen</h5>
                            <p class="card-text">Gratis</p>
                            <a href="#" class="btn btn-danger">Vælg</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <h2 class="centerText">Kontakt os på nummert: 76162212</h2>
        </footer>
        <script type="text/javascript">
            function STM(tag) {
                var request = new XMLHttpRequest();
                var numBoats = document.getElementById("multiBoatDivText").innerHTML;

                // Modify the JSON object depending on which tag was clicked
                var data = "num_boats=" + encodeURIComponent(numBoats) + "&tag=" + tag;
                
                request.open('POST', 'create-payment.php', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                request.onload = function () {
                    console.log(this.response);
                    const data = JSON.parse(this.response);        // If parse error, check output 
                    if (!data.paymentId) {                         // from create-payment.php
                        console.error('Error: Check output from create-payment.php');
                        return;
                    }
                    console.log(this.response);

                    // checkout.html is implemented in Step 3
                    window.location = 'checkout.php?paymentId=' + data.paymentId;
                }
                request.onerror = function () {
                    console.error('connection error');
                }
                request.send(data);
            }

        </script>
    </body>
</html>