<?php
if( !defined('DATALIFEENGINE') ) {
    header( "HTTP/1.1 403 Forbidden" );
    header ( 'Location: ../../' );
    die( "Hacking attempt!" );
}
$title = '';
switch ($_GET['do']){
    case 'lastnews':
        $title = 'новинки';
        break;
}
if ($_GET['xn'] == 'country'){
    switch ($_GET['xf']){
        case 'США':
            $title = 'американские';
            break;
        case 'Великобритания':
            $title = 'английские';
            break;
        case 'Росиия':
            $title = 'российские';
            break;
        case 'Казахстан':
            $title = 'казахстанские';
            break;
        case 'Индия':
            $title = 'индийские';
            break;
        case 'Япония':
            $title = 'японские';
            break;
        case 'Корея Южная':
            $title = 'корейские';
            break;
        case 'Италия':
            $title = 'итальянские';
            break;
        case 'Франция':
            $title = 'французские';
            break;
        case 'Германия':
            $title = 'Немецкие';
            break;
        case 'Польша':
            $title = 'польские';
            break;
        case 'Испания':
            $title = 'испанские';
            break;
        case 'Бразилия':
            $title = 'бразильские';
            break;
        case 'Китай':
            $title = 'китайские';
            break;
        case 'Украина':
            $title = 'украинские';
            break;
        case 'Австралия':
            $title = 'австралийские';
            break;
        case 'Венгрия':
            $title = 'венгерские';
            break;
    }
    $title .= ' фильмы и сериалы';
} else if ($_GET['xn'] == 'actor' || $_GET['xn'] == 'director') {
    $title = ' фильмы и сериалы c участием ' . $_GET['xf'];
} else if ($_GET['xn'] == 'year') {
    $title = ' фильмы и сериалы ' . $_GET['xf'] . ' года';
}
echo $title;
