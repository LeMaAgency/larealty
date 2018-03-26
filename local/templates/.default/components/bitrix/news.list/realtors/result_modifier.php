<?
global $USER;
$rsUsers = CUser::GetList(
    ($by = "NAME"),
    ($order = "desc"),
    Array("GROUPS_ID" => Array(3), 'ACTIVE' => 'Y'),
    Array("FIELDS" => array("NAME",
        "LAST_NAME",
        "PERSONAL_PHOTO",
        "PERSONAL_PHONE")
    )
);
while ($arUser = $rsUsers->Fetch()) {
    $arSpecUser[] = $arUser;
}
$arResult['ITEMS'] = $arSpecUser;