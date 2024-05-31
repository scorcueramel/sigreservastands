<strong>Hola, {{$reserva->nombres}} {{$reserva->apepaterno}}</strong>
<div style="background:#eee; border:1px solid #ccc; padding:5px 10px">
    <table border="0" cellpadding="1" cellspacing="1" style="width:100%">
        <tbody>
            <tr>
                <td style="padding:20px 50px 20px 50px">
                    Detalles de la reserva.
                    <ul>
                        <li>Fecha : {{$reserva->fecha}}</li>
                        <li>Día : {{$reserva->dia}}</li>
                        <li>Numero de Stand : {{$reserva->stand_nro}}</li>
                    </ul>
                    <br />
                    <br />
                    <p>Nuestro equipo se contactará contigo. Te llegará un mensaje con una tarjeta de registro al correo ingresado</p>
                    <p>¡Gracias por Inscribirte.</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<p>&nbsp;</p>
<p>Gracias por utilizar nuestro servicio.</p>
<p><strong>SISTEMA DE RESERVAS DE STAND</strong></p>
