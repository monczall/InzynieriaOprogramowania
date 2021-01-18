<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// dodanie polaczenia z database.php i dodanie obiektu contractor.php
include_once '../../config/database.php';
include_once '../objects/osoba.php';

// uzyskanie polaczenie z baza danych
$database = new Database();
$db       = $database->getConnection();

// zainicjalizowanie obiektu $contractor
$osoba = new Osoba($db);
if ((isset($_GET['input'])))
    $stmtOsoba = $osoba->searchOsoba($_GET['input']);
    else if(isset($_GET['update']))
    $stmtOsoba = $osoba->update($_GET['id_osoby_kontaktowej'], $_GET['imie_osoba'], $_GET['nazwisko_osoba'], $_GET['numer_telefonu_osoba'], $_GET['email_osoba']);
    if(isset($_GET['create']))
    $stmtOsoba = $osoba->create($_GET['imie_osoba'], $_GET['nazwisko_osoba'], $_GET['numer_telefonu_osoba'], $_GET['email_osoba'], $_GET['id_oddzialu']);
else
    $stmtOsoba = $osoba->read();



$num  = $stmtOsoba->rowCount();

// sprawdzanie czy znaleziono wiecej niz 0 rekordow
if ($num > 0) {

    // products array
    $osobaArray               = array();
    $osobaArray["Osoby"] = array();

    while ($row = $stmtOsoba->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $osobaItem = array(
            "id_osoby_kontaktowej" => $id_osoby_kontaktowej,
            "imie_osoba" => $imie_osoba,
            "nazwisko_osoba" => $nazwisko_osoba,
            "numer_telefonu_osoba" => $numer_telefonu_osoba,
            "email_osoba" => $email_osoba,
            "id_oddzialu" => $id_oddzialu

        );

        array_push($osobaArray["Osoby"], $osobaItem);
    }

    // ustawienie kodu odpowiedzi na - 200 OK
    http_response_code(200);

    // pokazanie towarow w formacie JSON
    echo json_encode($osobaArray);
} else {

    // ustawienie kodu odpowiedzi na - 404 Not found
    http_response_code(404);

    // wyswietlenie wiadomosci ze nie znaleziono kontrahentow
    echo json_encode(array(
        "Błąd" => "Nie znaleziono adresu."
    ));
}

?>
