<?php
class Osoba
{

    // polaczenie z baza i nazwa tabeli w bazie
    private $connection;
    private $table_name = "osoba_kontaktowa";

    // osoba kontaktowa
    public $id_osoby_kontaktowej;
    public $imie_osoba;
    public $nazwisko_osoba;
    public $numer_telefonu_osoba;
    public $email_osoba;
    public $id_oddzialu;




    // konstruktor z polaczeniem
    public function __construct($db)
    {
        $this->connection = $db;
    }



    function read_osoba($id)
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "SELECT * FROM osoba_kontaktowa WHERE id_oddzialu = '$id'";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function searchOsoba($id)
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "SELECT * FROM osoba_kontaktowa WHERE id_oddzialu = '$id'";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function update($id_osoby_kontaktowej, $imie_osoba, $nazwisko_osoba, $numer_telefonu_osoba, $email_osoba)
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "UPDATE osoba_kontaktowa SET imie_osoba = '$imie_osoba', nazwisko_osoba = '$nazwisko_osoba', numer_telefonu_osoba = '$numer_telefonu_osoba', email_osoba = '$email_osoba' WHERE id_osoby_kontaktowej = $id_osoby_kontaktowej";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    function create($imie_osoba, $nazwisko_osoba, $numer_telefonu_osoba, $email_osoba, $id_oddzialu)
    {



        // zabezpieczenie
        $imie_osoba = htmlspecialchars(strip_tags($imie_osoba));
        $nazwisko_osoba = htmlspecialchars(strip_tags($nazwisko_osoba));
        $numer_telefonu_osoba = htmlspecialchars(strip_tags($numer_telefonu_osoba));
        $email_osoba = htmlspecialchars(strip_tags($email_osoba));

        // zapytanie do wstawiania rekordu
        $query = "INSERT INTO osoba_kontaktowa

        (imie_osoba, nazwisko_osoba, numer_telefonu_osoba, email_osoba, id_oddzialu)
        VALUES ('$imie_osoba', '$nazwisko_osoba', '$numer_telefonu_osoba', ' $email_osoba', '$id_oddzialu')";

        // przygotowanie zapytania
        $stmt  = $this->connection->prepare($query);




        // wykonanie zapytania
        //$stmt->execute();

        if ($stmt->execute()) {
            return $stmt;
        }
      }
}
