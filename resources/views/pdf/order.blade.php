<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Orden</title>
    <style>
        .page-break {
            page-break-after: always;
        }

        .bg-grey {
            background: #F3F3F3;
        }

        .text-right {
            text-align: right;
        }

        .w-full {
            width: 100%;
        }

        .small-width {
            width: 15%;
        }

        .invoice {
            background: white;
            border: 1px solid #CCC;
            font-size: 14px;
            padding: 48px;
            margin: 20px 0;
        }

        .w-25 {
            width: 25% !important
        }

        .w-50 {
            width: 50% !important
        }

        .w-75 {
            width: 75% !important
        }

        .w-100 {
            width: 100% !important
        }

        .h-25 {
            height: 350px !important
        }

        .h-50 {
            height: 50% !important
        }

        .h-75 {
            height: 75% !important
        }

        .h-100 {
            height: 100% !important
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
</head>

<body class="login-page" style="background: white">

    <div>
        <div class="row">
            <div class="col-xs-8">
                {{-- <h4>From:</h4> --}}
                <strong>Clinica Vida y Salud</strong><br>
                Av. Arce #525 <br>
                (entre litoral y 1ro de abril)<br>
                Telf.: (62)-25482 <br>

                <br>
            </div>

            <div class="text-center col-xs-4">
                {{-- <img class="invisible" src="https://res.cloudinary.com/dqzxpn5db/image/upload/v1537151698/website/logo.png" alt="logo"> --}}
                <img src="{{ asset('midone/dist/images/logo.png') }}" alt="logo">
            </div>
        </div>

        <div style="margin-bottom: 0px">&nbsp;</div>

        <div class="row">
            <div class="col-xs-6">
                <strong>Paciente:</strong><br>
                <address>
                    {{ $order->patient->person->name . ' ' . $order->patient->person->f_last_name . ' ' . $order->patient->person->m_last_name }}<br>
                    {{-- <span>{{ $order->patient->person->address }}</span> <br> --}}
                    {{-- <span>123 Address St.</span> --}}
                </address>
            </div>

            <div class="col-xs-5">
                <table style="width: 100%">
                    <tbody>
                        <tr>
                            <th>Número de orden:</th>
                            <td class="text-right">{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th> Fecha: </th>
                            <td class="text-right">{{ date('m-d-Y', strtotime($order->created_at)) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <strong>Diagnostico presuntivo:</strong>
        @if($order->consultation->diagnostic)
            {{ $order->consultation->diagnostic }}
        @endif <br>
        <div class="text-center">
            <h3>Orden de laboratorio</h3>
        </div>
        <hr>

        <div class="h-25">
            {!! nl2br($order->description) !!}
        </div>

        <hr>

        <div class="row">
            {{-- <div class="col-xs-6"></div> --}}
            <div class="">
                <table style="width: 100%">
                    <tbody>
                        <tr class="well" style="padding: 5px">
                            <th style="padding: 5px">
                                <div> Medico encargado: </div>
                            </th>
                            <td style="padding: 5px" class="text-right"><strong>
                                    {{ $order->staff->person->name . ' ' . $order->staff->person->f_last_name . ' ' . $order->staff->person->m_last_name }}
                                </strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div style="margin-bottom: 0px">&nbsp;</div>

        <div class="row">
            <div class="col-xs-8 invbody-terms">
                Thank you for your business. <br>
                <br>
                <h4>Payment Terms</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eius quia, aut doloremque, voluptatibus
                    quam ipsa sit sed enim nam dicta. Soluta eaque rem necessitatibus commodi, autem facilis iusto
                    impedit!</p>
            </div>
        </div> --}}
    </div>

</body>

</html>
