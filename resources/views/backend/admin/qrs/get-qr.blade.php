


<?php
/**
 * Created by PhpStorm.
 * User: Douglas
 * Date: 8/12/2016
 * Time: 12:08 AM
 */?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>

</head>
<body style="padding-left: 5px;font-family: 'Segoe UI', Helvetica, Arial, sans-serif; margin-top: -20px; margin-bottom: -200px; bottom: -250px; border: 0px solid yellow">

<main style=" text-align: center; margin-top: 10px; border: 0px solid yellow">
    @if( $type == 'visitante')
        <div style="margin-left: -260px">
            <div>
                <div style="height: auto; width: 100px; display: inline-block; margin-left: 210px">
                    <img style="margin:0"
                         src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(120)->generate($idqr)) !!} ">
                </div>
                <div style="height: auto; width: 120px;display: inline-block; padding-top: 25px; font-size: 18px; line-height: 30px; margin-left: -30px; text-transform: uppercase">
                    <b><?= $data[0]->vis_nombre . ' ' . $data[0]->vis_apellido.' '.$data[0]->id_visitante ?></b>
                </div>
            </div>

            <div style="width: 285px; margin-left: 225px">
                <hr>
            </div>

            <div style=" text-transform: uppercase;width: 100%; margin-top: 10px; font-size: 15px; margin-left: -245px">
                <b>visitante</b>
            </div>
        </div>
    @elseif( $type == 'CONFERENCISTA' || $type == 'SUB ADMINISTRADOR' || $type == 'PERSONAL DE MONTAJE' || $type == 'REPRESENTANTE' || $type == 'VISITANTE' || $type == 'EXPOSITOR' )
        <div style="margin-left: -10px; margin-right: -2px; margin-top: 5px; height: 100%; border: 0px solid blue; display: block; position: absolute; width: 100%;  display: table;">
            <div style="display: table-row;">
                <div style="height: auto; width: 90px; display: inline-block; margin-left: -20px; float: left; border: 0px solid red">
                    <img style="margin:0;"
                         src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(120)->generate($qr)) !!} ">
                </div>
                <div style="height: 100px; min-height: 100px; width: 150px;display: inline-block; margin-top: 10px; font-size: 17px; line-height: 17px; margin-left: 20px; text-transform: uppercase;  border: 0px solid red; margin-bottom: -50px; float: left;  line-height: 100px;">
                    <span style="font-size: 16px; display: inline-block; vertical-align: middle; line-height: 1.1;"><?= $name ?> <br><p  style="font-size: 16px">{{$type}}</p></span>
                </div>
            </div>
            <div style="width: 100%; margin-left: 0px; margin-top: -20px; float: left; display: table-row;">
                <hr style="border: 1px solid black;">
            </div>

            <div class="" style=" text-transform: uppercase; width: 100%; margin-top: -10px; font-size: 14px;margin-left: 0px; text-align: center; border: 0px solid red; margin-bottom: 0px; float: left; overflow: hidden; padding: 0;display: table-row;">

                <p  style="margin: 0;"><?= $companyName ?></p>
                <p  style="margin: 0"><b>{{$companyPosition}}</b></p>
              
            </div>
            <!--<div style=" text-transform: uppercase;width: 100%; margin-top: -25px; font-size: 15px; margin-left: -245px">
                <b>vendedor</b>
            </div>-->
        </div>
    @elseif ($type == 'PRODUCTO')

        <div style="font-size: 25px; text-transform: uppercase; padding-bottom: 30px">
            <p><b>{{ $name }}</b></p>
        </div>
        

        <img style="margin:0; padding: 0; margin-left:-5; margin-top: -50px"
             src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate($qr)) !!} ">
        <div style="font-size: 25px;text-transform: uppercase;margin-top: 10px">
        <p><b>Producto</b></p>
        </div>
    @elseif ($type == 'STAND')

        <div style="font-size: 25px; text-transform: uppercase; padding-bottom: 30px">
            <p><b>{{ $name }}</b></p>
        </div>
        

        <img style="margin:0; padding: 0; margin-left:-5; margin-top: -50px"
             src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate($qr)) !!} ">
        <div style="font-size: 25px;text-transform: uppercase;margin-top: 10px">
        <p><b>EXPOSITOR / STAND</b></p>
        </div>
    @elseif ($type == 'OFERTA')
        <div style="font-size: 25px; text-transform: uppercase; padding-bottom: 30px">
            <p><b>{{ $name }}</b></p>
        </div>
        <div style="font-size: 14px; text-transform: uppercase; padding-bottom: 0px; margin-top: -60px">
            <p><b>{{ $sdesc }}</b></p>
        </div>
       
        <img style="margin:0; margin-top: -20px"
             src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate($qr)) !!} ">
        <div style="font-size: 25px;text-transform: capitalize;margin-top: -50px">
        <p><b>OFERTA</b></p>
        </div>
    @elseif( $type == 'empresa')
    <div style="font-size: 30px;text-transform: uppercase;margin-bottom: 10px">
        <p style="margin-left: -472px;"><b> <?= $data->emp_nombre ?></b></p>
        </div>
        <img style="margin:0"
             src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate($idqr)) !!} ">
        <div style="font-size: 25px;text-transform: uppercase;margin-top: 10px">
        <p style="margin-left: -472px;"><b>EXPOSITOR / STAND</b></p>
        </div>
    @endif
</main>

</body>
</html>
