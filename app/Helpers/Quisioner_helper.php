<?php

function getIndikator($indikator){
    $db = \Config\Database::connect();

    $query = $db->query("SELECT * FROM `tb04_quisoner` where qm = ?  and jns = ? ",[$indikator,"P"]);
    $indikator = $query->getResultArray();
    return $indikator;
}