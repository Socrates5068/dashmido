<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
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
            height: 375px !important
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
</head>

<body class="bg-grey">

    <div class="container container-smaller">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1" style="margin-top:20px; text-align: right">
                <div class="btn-group mb-4">
                    <a href="{{ route('admin.order', $order->id) }}" class="btn btn-success">Guardar como pdf</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="invoice">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>From:</h4>
                            <address>
                                <strong>Company Inc.</strong><br>
                                123 Company Ave. <br>
                                Toronto, Ontario - L2R 4U6<br>
                                P: (416) 123 - 4567 <br>
                                E: company@company.com
                            </address>
                        </div>

                        <div class="col-sm-6 text-right">
                            <img src="{{ asset('midone/dist/images/logo.png') }}" alt="logo">
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-7">
                            <strong>Paciente:</strong><br>
                            <address>
                                {{ $order->patient->person->name . ' ' . $order->patient->person->f_last_name . ' ' . $order->patient->person->m_last_name }}<br>
                                {{-- <span>{{ $order->patient->person->address }}</span> <br> --}}
                                {{-- <span>123 Address St.</span> --}}
                            </address>
                        </div>

                        <div class="col-sm-5 text-right">
                            <table class="w-full">
                                <tbody>
                                    <tr>
                                        <th>Número de orden:</th>
                                        <td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Fecha: </th>
                                        <td>{{ date('m-d-Y', strtotime($order->created_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div style="margin-bottom: 0px">&nbsp;</div>

                            {{-- <table class="w-full">
                                <tbody>
                                    <tr class="well" style="padding: 5px">
                                        <th style="padding: 5px">
                                            <div> Balance Due (CAD) </div>
                                        </th>
                                        <td style="padding: 5px"><strong> $499 </strong></td>
                                    </tr>
                                </tbody>
                            </table> --}}


                        </div>
                    </div>

                    <hr>

                    <div class="h-25" style="margin-bottom: 25px;">
                        {!! nl2br($order->description) !!}
                        {{-- <table class="table invoice-table">
                            <thead style="background: #F5F5F5;">
                                <tr>
                                    <th>Item List</th>
                                    <th></th>
                                    <th class="text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>Service</strong>
                                        <p>Description here. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Expedita perferendis doloribus, quaerat molestias est eum, adipisci dolorem
                                            nulla rerum voluptatibus.</p>
                                    </td>
                                    <td></td>
                                    <td class="text-right">$600</td>
                                </tr>

                                <tr>
                                    <td>
                                        <strong>Service</strong>
                                        <p>Description here. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Expedita perferendis doloribus, quaerat molestias est eum, adipisci dolorem
                                            nulla rerum voluptatibus.</p>
                                    </td>
                                    <td></td>
                                    <td class="text-right">$600</td>
                                </tr>

                            </tbody>
                        </table> --}}
                    </div><!-- /table-responsive -->

                    <table class="table invoice-total">
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

                    {{-- <hr>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="invbody-terms">
                                Thank you for your business. <br>
                                <br>
                                <h4>Payment Terms and Methods</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium cumque neque
                                    velit tenetur pariatur perspiciatis dignissimos corporis laborum doloribus,
                                    inventore.
                                </p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

</body>

</html>
