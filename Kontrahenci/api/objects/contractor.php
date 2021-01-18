<?php
class Contractor
{

    // polaczenie z baza i nazwa tabeli w bazie
    private $connection;
    private $table_name = "kontrahent";

    // kontrahent
    public $id_kontrahenta;
    public $imie;
    public $nazwisko;
    public $nazwa_firmy;
    public $data_rejestracji;
    public $nip;
    public $ukryj_kontrahenta;



    // konstruktor z polaczeniem
    public function __construct($db)
    {
        $this->connection = $db;
    }


    function read()
    {
        // Zapytanie wyswietlajace wszystkich kontrahentow
        $query = "SELECT * FROM kontrahent WHERE ukryj_kontrahenta = 0";

        // przygotowanie zapytania
        $stmt = $this->connection->prepare($query);

        // wykonanie zapytania
        $stmt->execute();

        return $stmt;
    }

    function searchContractorID($id)
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "SELECT * FROM kontrahent WHERE id_kontrahenta = $id and ukryj_kontrahenta = 0";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function hideContractorID($id)
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "UPDATE kontrahent SET ukryj_kontrahenta = '1' WHERE id_kontrahenta = '$id'";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function searchContractorByNip($nip)
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "SELECT * FROM kontrahent WHERE nip LIKE '%$nip%' order by nip";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function searchContractorByNazwa($nazwafirmy)
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "SELECT * FROM kontrahent WHERE nazwa_firmy LIKE '%$nazwafirmy%'";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    function searchContractorByNazwisko($nazwisko)
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "SELECT * FROM kontrahent WHERE nazwisko LIKE '%$nazwisko%'";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function update($id_kontrahenta, $imie, $nazwisko, $nazwaFirmy, $dataRejestracji, $nip)
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "UPDATE kontrahent SET imie = '$imie', nazwisko = '$nazwisko', nazwa_firmy = '$nazwaFirmy', data_rejestracji = '$dataRejestracji', nip = '$nip' WHERE id_kontrahenta = $id_kontrahenta";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function create($imie, $nazwisko, $nazwa_firmy, $data_rejestracji, $nip, $ukryj_kontrahenta)
    {



        // zabezpieczenie
        $imie = htmlspecialchars(strip_tags($imie));
        $nazwisko = htmlspecialchars(strip_tags($nazwisko));
        $nazwa_firmy = htmlspecialchars(strip_tags($nazwa_firmy));
        $data_rejestracji = htmlspecialchars(strip_tags($data_rejestracji));
        $nip = htmlspecialchars(strip_tags($nip));

        // zapytanie do wstawiania rekordu
        $query = "INSERT INTO kontrahent

        (imie, nazwisko, nazwa_firmy, data_rejestracji, nip, ukryj_kontrahenta)
        VALUES ('$imie', '$nazwisko', '$nazwa_firmy', ' $data_rejestracji', '$nip', '$ukryj_kontrahenta')";

        // przygotowanie zapytania
        $stmt  = $this->connection->prepare($query);




        // wykonanie zapytania
        //$stmt->execute();

        if ($stmt->execute()) {
            return $stmt;
        }

        function getId()
        {
            // zapytanie wyswietlajace kontrahentow po NIP'ie
            $query = "SELECT id_kontrahenta, nip FROM kontrahent";

            // wykonanie zapytania
            $stmt = $this->connection->prepare($query);

            // execute query
            $stmt->execute();

            return $stmt;
        }

        return false;

    }





}
?>
