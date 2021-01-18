<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// dodanie polaczenia z database.php i dodanie obiektu contractor.php
include_once '../../config/database.php';
include_once '../objects/contractor.php';

// uzyskanie polaczenie z baza danych
$database = new Database();
$db       = $database->getConnection();

// zainicjalizowanie obiektu $contractor
$contractor = new Contractor($db);
if (isset($_GET['nip']))
  $stmtContractor = $contractor->searchContractorByNip($_GET['nip']);
elseif (isset($_GET['nazwafirmy']))
    $stmtContractor = $contractor->searchContractorByNazwa($_GET['nazwafirmy']);
elseif (isset($_GET['nazwisko']))
    $stmtContractor = $contractor->searchContractorByNazwisko($_GET['nazwisko']);
else
    $stmtContractor = $contractor->read();

    if (isset($_GET['input']) && $_GET['action'] == 'wyswietl' || isset($_GET['input']) && $_GET['action'] == 'edytuj')
    $stmtContractor = $contractor->searchContractorID($_GET['input']);

    if (isset($_GET['input']) && $_GET['action'] == 'ukryj')
    $stmtContractor = $contractor->hideContractorID($_GET['input']);

    if (isset($_GET['update']))
    $stmtContractor = $contractor->update($_GET['id_kontrahenta'], preg_replace('/\d/', '', $_GET['imie']), preg_replace('/\d/', '', $_GET['nazwisko']), $_GET['nazwa_firmy'], $_GET['data_rejestracji'], preg_replace('/[^0-9]/', '', preg_replace('/-/', '', $_GET['nip'])));

    if (isset($_GET['create']))
    $stmtContractor = $contractor->create(preg_replace('/\d/', '', $_GET['imie']), preg_replace('/\d/', '', $_GET['nazwisko']), $_GET['nazwa_firmy'], $_GET['data_rejestracji'], preg_replace('/[^0-9]/', '', preg_replace('/-/', '', $_GET['nip'])), $_GET['ukryj_kontrahenta']);

    if (isset($_GET['getId']))
    $stmtContractor = $contractor->getId();
    
$num  = $stmtContractor->rowCount();

// sprawdzanie czy znaleziono wiecej niz 0 rekordow
if ($num > 0) {

    // products array
    $contractorArray                = array();
    $contractorArray["Kontrahenci"] = array();

    while ($row = $stmtContractor->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $contractorItem = array(
            "id_kontrahenta" => $id_kontrahenta,
            "imie" => $imie,
            "nazwisko" => $nazwisko,
            "nazwa_firmy" => $nazwa_firmy,
            "data_rejestracji" => $data_rejestracji,
            "nip" => $nip,
            "ukryj_kontrahenta" => $ukryj_kontrahenta
        );

        array_push($contractorArray["Kontrahenci"], $contractorItem);
    }

    // ustawienie kodu odpowiedzi na - 200 OK
    http_response_code(200);

    // pokazanie towarow w formacie JSON
    echo json_encode($contractorArray);
} else {

    // ustawienie kodu odpowiedzi na - 404 Not found
    http_response_code(404);

    // wyswietlenie wiadomosci ze nie znaleziono kontrahentow
    echo json_encode(array(
        "Błąd" => "Nie znaleziono kontrahentow."
    ));
}

?>
