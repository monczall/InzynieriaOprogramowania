<?php
    header('Acces-Controll-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../objects/contractor.php';
    include_once '../objects/adres.php';
    include_once '../objects/osoba.php';

    $database = new Database();
    $db = $database->getConnection();

    $kontrahent = new Contractor($db);
    $adresOddzialu = new Adres($db);
    $osobaKontaktowa = new Osoba($db);


    if (isset($_GET['id']))
    $result = $kontrahent->searchContractorID($_GET['id']);

    $num = $result->rowCount();

    if($num > 0 ){
        $kontrahenci_arr = array();
        $kontrahenci_arr['Kontrahent'] = array();


        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $result_adres = $adresOddzialu->read_adres($id_kontrahenta);
            $num1 = $result_adres->rowCount();

            if($num1 > 0 ){

                $adresOddzialu_arr = array();
                $adresOddzialu_arr['Oddzialy'] = array();

                while($row1 = $result_adres->fetch(PDO::FETCH_ASSOC)){
                    extract($row1);

                    $result_osoba = $osobaKontaktowa->read_osoba($id_oddzialu);
                    $num2 = $result_osoba->rowCount();

                    if($num2 > 0){
                        $osobyKontaktowe_arr = array();
                        $osobyKontaktowe_arr['OsobyKontaktowe'] = array();

                        while($row2 = $result_osoba->fetch(PDO::FETCH_ASSOC)){
                            extract($row2);

                            $osobaKontaktowa_item = array(
                                'id_osoby_kontaktowej' => $id_osoby_kontaktowej,
                                'imie_osoba' => $imie_osoba,
                                'nazwisko_osoba' => $nazwisko_osoba,
                                'numer_telefonu_osoba' => $numer_telefonu_osoba,
                                'email_osoba' => $email_osoba,
                                'id_oddzialu' => $id_oddzialu,
                            );

                            array_push($osobyKontaktowe_arr['OsobyKontaktowe'], $osobaKontaktowa_item);
                        }

                    }else{
                        $osobyKontaktowe_arr = array(
                            'message' => 'Brak adresow'
                        );
                    }


                    $adresOddzialu_item = array(
                        'id_oddzialu' => $id_oddzialu,
                        'ulica' => $ulica,
                        'numer_budynku' => $numer_budynku,
                        'miasto' => $miasto,
                        'kod_pocztowy' => $kod_pocztowy,
                        'kraj' => $kraj,
                        'nazwa_oddzialu' => $nazwa_oddzialu,
                        'email' => $email,
                        'numer_telefonu' => $numer_telefonu,
                        'oddzial_glowny' => $oddzial_glowny,
                        'id_kontrahenta' => $id_kontrahenta,
                        'osoby_kontaktowe' => $osobyKontaktowe_arr
                    );

                    array_push($adresOddzialu_arr['Oddzialy'], $adresOddzialu_item);
                }




            }else{
                $adresOddzialu_arr = array(
                    'message' => 'Brak adresow'
                );
            }


            $kontrahent_item = array(
                'id_kontrahenta' => $id_kontrahenta,
                'imie' => $imie,
                'nazwisko' => $nazwisko,
                'nazwa_firmy' => $nazwa_firmy,
                'data_rejestracji' => $data_rejestracji,
                'nip' => $nip,
                'ukryj_kontrahenta' => $ukryj_kontrahenta,
                'adresy_oddzialow' => $adresOddzialu_arr
            );

            array_push($kontrahenci_arr['Kontrahent'], $kontrahent_item);
        }

        echo json_encode($kontrahenci_arr);

    }else{
        echo json_encode(
            array('message' => 'Brak kontrahentów do wyświetlenia')
        );
    }
