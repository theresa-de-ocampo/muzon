<?php
// Get name of complained resident
$inner_query = "CALL get_complained_resident(?, @complained_resident)";
$inner_stmt = $pdo->prepare($inner_query);
$inner_stmt->bindParam(1, $row->complained_resident_id, PDO::PARAM_INT);
$inner_stmt->execute();

$inner_query = "SELECT @complained_resident";
$inner_stmt = $pdo->prepare($inner_query);
$inner_stmt->execute();
$complained_name = $inner_stmt->fetchColumn();

// Get name of complainant
$inner_query = "CALL get_complainant(?, ?, @complainant)";
$inner_stmt = $pdo->prepare($inner_query);
$inner_stmt->bindParam(1, $row->complainant_resident_id, PDO::PARAM_INT);
$inner_stmt->bindParam(2, $row->complainant_outsider_id, PDO::PARAM_INT);
$inner_stmt->execute();

$inner_query = "SELECT @complainant";
$inner_stmt = $pdo->prepare($inner_query);
$inner_stmt->execute();
$complainant_name = $inner_stmt->fetchColumn();
