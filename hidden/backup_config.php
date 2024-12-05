<?php
$users = [
    [
        "username" => "guest",
        "password" => base64_encode(base64_encode("CeciEstUnFlagEncodeUltraSecuriseCommePasPossible")), 
    ]
];
echo json_encode($users);
?>
