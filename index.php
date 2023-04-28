<?php
date_default_timezone_set('Europe/Copenhagen');
?>
<!DOCTYPE html>
<html lang="dk">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
        <style>
            body {
                background-color: #f2f2f2;
            }

            h1 {
                text-align: center;
            }

            .card {
            border-color: #d60810;
            border-width: 1vw;

            background-color: #f2f2f2;

            height: 100%;
            width: 100%;
            }

            .card-title {
                text-align: center;
                font-weight: bold;
            }

            .card-text {
                text-align: center;
                font-size: 4rem;
            }

            .btn {
                display: block;
                margin: 0 auto;

                font-size: 2rem;

                width: 100%;
            }

            #multiBoatDivTitle {
                text-align: center;
                font-size: 2rem;
            }

            #multiBoatDivBtnDiv {
                background-color: #d1d1d1;

                text-align: center;

                height: 10vh;

                display: flex;
                justify-content: space-between;
            }

            .multiBoatDivBtn {
                background-color: #dc3444;
                border-color: #dc3444;
                
                text-align: center;
                font-size: 2rem;

                width: 20%;
                height: 100%;
            }

            #multiBoatDivText {
                display: inline-block;

                font-size: 1.5rem;

                margin: 0;
                align-self: center;
            }

            #dynamicPrice {
                font-size: 2.5rem;

                text-align: center;
            }

            .centerText {
                text-align: center;
            }

            footer {
                background-color: #c7c7c7;
                
                padding: 3vh;
            }

            .container-fluid {
                min-height: 85.75vh;
            }

            .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            }

            form {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            @media (max-width: 390px) {
                .card-container {
                display: flex;
                flex-direction: column;
                }
                
                .card {
                    width: 100%;
                    max-width: none;
                }

                .cardCol{
                    width: 100%;
                    height: 50vh;
                    margin-bottom: 1%;
                }
            }  

        </style>
        <script type="text/javascript" src="myjs.js"></script>
        <title>Ribe Kammersluse</title>
    </head>
    <body>
        <div class="container-fluid">
            <h1>Ribe Kammersluse</h1>
            <div class="card-container row">
                <div class="col-3 cardCol">
                    <div class="card col-lg-4 col-md-6 col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title">Gennemslusning af en båd</h5>
                            <p class="card-text">75 kr.</p>
                                <form class="text-center">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="kørebro-single-boat">
                                                <label class="form-check-label">Kørebro</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gangbro-single-boat">
                                                <label class="form-check-label">Gangbro</label>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-danger" onclick="STM('single-boat')">Vælg</a>
                                </form>
                        </div>
                    </div>
                </div>
                <div class="col-3 cardCol">
                    <div class="card col-lg-4 col-md-6 col-sm-12">
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
                                <form class="text-center">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="kørebro-multi-boat">
                                                <label class="form-check-label">Kørebro</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gangbro-multi-boat">
                                                <label class="form-check-label">Gangbro</label>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-danger" onclick="STM('multi-boat')">Vælg</a>
                                </form>
                        </div>
                    </div>
                </div>
                <div class="col-3 cardCol">
                    <div class="card col-lg-4 col-md-6 col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title">Hævning af kørebro</h5>
                            <p class="card-text">50 kr.*</p>
                            <p class="centerText">*Hævning af kørebro under slusning er gratis.</p>
                                <form class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gangbro-drive-bridge">
                                        <label class="form-check-label">Gangbro</label>
                                    </div>
                                    <a href="#" class="btn btn-danger" onclick="STM('drive-bridge')">Vælg</a>
                                </form>
                        </div>
                    </div>
                </div>
                <div class="col-3 cardCol">
                    <div class="card col-lg-4 col-md-6 col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title">Fjernelse af gangbro fra slusetoppen</h5>
                            <p class="card-text">Gratis</p>
                            <a href="walkBridge.php" class="btn btn-danger">Vælg</a>
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
                var numBoats = tag === "multi-boat"?document.getElementById("multiBoatDivText").innerHTML:1;

                var liftDriveBridge = tag === "drive-bridge"?true:document.getElementById("kørebro-"+tag).checked;
                var liftWalkBridge = document.getElementById("gangbro-"+tag).checked;

                var data = "num_boats=" + encodeURIComponent(numBoats) + "&tag=" + tag + "&liftDriveBridge=" + liftDriveBridge + "&liftWalkBridge=" + liftWalkBridge;
                console.log(data);
                
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