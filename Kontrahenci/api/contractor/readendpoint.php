<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// dodanie polaczenia z database.php i dodanie obiektu contractor.php
include_once '../../config/database.php';
include_once '../objects/contractorEndpoint.php';

// uzyskanie polaczenie z baza danych
$database = new Database();
$db       = $database->getConnection();

// zainicjalizowanie obiektu $contractor
$contractor = new ContractorEndpoint($db);
if (isset($_GET['nip'])){
    $stmtContractorEndpoint = $contractor->searchContractorEndPointByNip($_GET['nip']);

    $num  = $stmtContractorEndpoint->rowCount();
}else{
    // ustawienie kodu odpowiedzi na - 404 Not found
    http_response_code(404);

    // wyswietlenie wiadomosci ze nie podano nipu
    echo json_encode(array(
        "Blad" => "Nie podano nipu."
    ));
    $num = 0;
}
  



// sprawdzanie czy znaleziono wiecej niz 0 rekordow
if ($num > 0) {

    // products array
    $contractorEndpointArray                = array();
    $contractorEndpointArray["KontrahenciEndPoint"] = array();

    while ($row = $stmtContractorEndpoint->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $contractorEndpointItem = array(
            "id_kontrahenta" => $id_kontrahenta,
            "nazwa_firmy" => $nazwa_firmy,
            "ulica" => $ulica,
            "numer_budynku" => $numer_budynku,
            "nip" => $nip,
            "email" => $email,
            "numer_telefonu" => $numer_telefonu
        );

        array_push($contractorEndpointArray["KontrahenciEndPoint"], $contractorEndpointItem);
    }

    // ustawienie kodu odpowiedzi na - 200 OK
    http_response_code(200);

    // pokazanie towarow w formacie JSON
    echo json_encode($contractorEndpointArray);
} else {

    // ustawienie kodu odpowiedzi na - 404 Not found
    http_response_code(404);

    // wyswietlenie wiadomosci ze nie znaleziono kontrahentow
    echo json_encode(array(
        "Blad" => "Nie znaleziono kontrahentow."
    ));
}

?>