<?php
class ContractorEndpoint
{
    // polaczenie z baza i nazwa tabeli w bazie
    private $connection;
    private $table_name = "kontrahent";

    // kontrahent
    public $id_kontrahenta;
    public $nazwa_firmy;
    public $ulica;
    public $numer_budynku;
    public $nip;
    public $email;
    public $numer_telefonu;



    // konstruktor z polaczeniem
    public function __construct($db)
    {
        $this->connection = $db;
    }

    function searchContractorEndPointByNip($nip)
    {
        // zapytanie wyswietlajace kontrahentow po NIP'ie
        $query = "SELECT k.id_kontrahenta, k.nazwa_firmy, a.ulica, a.numer_budynku, k.nip, a.email, a.numer_telefonu
        FROM kontrahent k
        INNER JOIN adres_oddzialu a ON k.id_kontrahenta = a.id_kontrahenta
        WHERE k.nip = '$nip'
        AND a.oddzial_glowny = 1";

        // wykonanie zapytania
        $stmt = $this->connection->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

}
?>