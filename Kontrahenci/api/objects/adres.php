<?php
class Adres
{

    // polaczenie z baza i nazwa tabeli w bazie
    private $connection;
    private $table_name = "adres_oddzialu";

    // kontrahent
    public $id_oddzialu;
    public $ulica;
    public $numer_budynku;
    public $miasto;
    public $kod_pocztowy;
    public $kraj;
    public $nazwa_oddzialu;
    public $email;
    public $numer_telefonu;
    public $oddzial_glowny;
    public $id_kontrahenta;



    // konstruktor z polaczeniem
    public function __construct($db)
    {
        $this->connection = $db;
    }

    function read_adres($id)
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "SELECT * FROM adres_oddzialu WHERE id_kontrahenta = '$id'";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function searchAdres($id)
    {
        // zapytanie wyswietlajace kontrahentow po NIPie
        $query = "SELECT * FROM adres_oddzialu WHERE id_kontrahenta = '$id' and oddzial_glowny = 1";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function update($id_oddzialu, $ulica, $numer_budynku, $miasto, $kod_pocztowy, $kraj, $nazwa_oddzialu, $email, $numer_telefonu)
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "UPDATE adres_oddzialu SET ulica = '$ulica', numer_budynku = '$numer_budynku', miasto = '$miasto', kod_pocztowy = '$kod_pocztowy', kraj = '$kraj', nazwa_oddzialu = '$nazwa_oddzialu', email = '$email', numer_telefonu = '$numer_telefonu' WHERE id_oddzialu = $id_oddzialu";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function create($ulica, $numer_budynku, $miasto, $kod_pocztowy, $kraj, $nazwa_oddzialu, $email, $numer_telefonu, $oddzial_glowny, $id_kontrahenta)
    {
        // zabezpieczenie
        $ulica = htmlspecialchars(strip_tags($ulica));
        $numer_budynku = htmlspecialchars(strip_tags($numer_budynku));
        $miasto = htmlspecialchars(strip_tags($miasto));
        $kod_pocztowy = htmlspecialchars(strip_tags($kod_pocztowy));
        $kraj = htmlspecialchars(strip_tags($kraj));
        $nazwa_oddzialu = htmlspecialchars(strip_tags($nazwa_oddzialu));
        $email = htmlspecialchars(strip_tags($email));
        $numer_telefonu = htmlspecialchars(strip_tags($numer_telefonu));

        // zapytanie do wstawiania rekordu
        $query = "INSERT INTO adres_oddzialu
        (ulica, numer_budynku, miasto, kod_pocztowy, kraj, nazwa_oddzialu, email, numer_telefonu, oddzial_glowny, id_kontrahenta)
        VALUES ('$ulica', '$numer_budynku', '$miasto', ' $kod_pocztowy', '$kraj', '$nazwa_oddzialu', '$email', '$numer_telefonu', '$oddzial_glowny', '$id_kontrahenta')";

        // przygotowanie zapytania
        $stmt  = $this->connection->prepare($query);




        // wykonanie zapytania
        //$stmt->execute();

        if ($stmt->execute()) {
            return $stmt;
        }

        return false;

    }

    function getId2()
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "SELECT * FROM adres_oddzialu";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
