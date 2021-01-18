<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// dodanie polaczenia z database.php i dodanie obiektu contractor.php
include_once '../../config/database.php';
include_once '../objects/adres.php';

// uzyskanie polaczenie z baza danych
$database = new Database();
$db       = $database->getConnection();

// zainicjalizowanie obiektu $contractor
$adres = new Adres($db);
if (isset($_GET['input']))
    $stmtAdres = $adres->searchAdres($_GET['input']);
    if(isset($_GET['update']))
    $stmtAdres = $adres->update($_GET['id_oddzialu'], $_GET['ulica'], $_GET['numer_budynku'], $_GET['miasto'], $_GET['kod_pocztowy'], $_GET['kraj'], $_GET['nazwa_oddzialu'], $_GET['email'], $_GET['numer_telefonu']);
    if(isset($_GET['create']))
    $stmtAdres = $adres->create($_GET['ulica'], $_GET['numer_budynku'], $_GET['miasto'], $_GET['kod_pocztowy'], $_GET['kraj'], $_GET['nazwa_oddzialu'], $_GET['email'], $_GET['numer_telefonu'], $_GET['oddzial_glowny'], $_GET['id_kontrahenta']);
    if (isset($_GET['getId2']))
    $stmtAdres = $adres->getId2();
else
    $stmtAdres = $adres->read();




$num  = $stmtAdres->rowCount();

// sprawdzanie czy znaleziono wiecej niz 0 rekordow
if ($num > 0) {

    // products array
    $adresArray= array();
    $adresArray["Adresy"] = array();

    while ($row = $stmtAdres->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $adresItem = array(
            "id_oddzialu" => $id_oddzialu,
            "ulica" => $ulica,
            "numer_budynku" => $numer_budynku,
            "miasto" => $miasto,
            "kod_pocztowy" => $kod_pocztowy,
            "kraj" => $kraj,
            "nazwa_oddzialu" => $nazwa_oddzialu,
            "email" => $email,
            "numer_telefonu" => $numer_telefonu,
            "oddzial_glowny" => $oddzial_glowny,
            "id_kontrahenta" => $id_kontrahenta
        );

        array_push($adresArray["Adresy"], $adresItem);
    }

    // ustawienie kodu odpowiedzi na - 200 OK
    http_response_code(200);

    // pokazanie towarow w formacie JSON
    echo json_encode($adresArray);
} else {

    // ustawienie kodu odpowiedzi na - 404 Not found
    http_response_code(404);

    // wyswietlenie wiadomosci ze nie znaleziono kontrahentow
    echo json_encode(array(
        "Błąd" => "Nie znaleziono adresu."
    ));
}
?>
