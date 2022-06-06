<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Receta</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

    <style>
        .text-right {
            text-align: right;
        }
    </style>

    <style>
        /* ckeditor5-table/theme/tablecaption.css */
        .table>figcaption {
            display: table-caption;
            caption-side: top;
            word-break: break-word;
            text-align: center;
            color: var(--ck-color-table-caption-text);
            background-color: var(--ck-color-table-caption-background);
            padding: .6em;
            font-size: .75em;
            outline-offset: -1px;
        }

        /* ckeditor5-table/theme/tablecolumnresize.css */
        .table table {
            overflow: hidden;
            table-layout: fixed;
        }

        /* ckeditor5-table/theme/tablecolumnresize.css */
        .table td,
        .table th {
            position: relative;
        }

        /* ckeditor5-table/theme/tablecolumnresize.css */
        .table .table-column-resizer {
            position: absolute;
            top: -999999px;
            bottom: -999999px;
            right: var(--ck-table-column-resizer-position-offset);
            width: var(--ck-table-column-resizer-width);
            cursor: col-resize;
            user-select: none;
            z-index: var(--ck-z-default);
        }

        /* ckeditor5-table/theme/tablecolumnresize.css */
        .table[draggable] .table-column-resizer {
            display: none;
        }

        /* ckeditor5-table/theme/tablecolumnresize.css */
        .table .table-column-resizer:hover,
        .table .table-column-resizer__active {
            background-color: var(--ck-color-table-column-resizer-hover);
            opacity: 0.25;
        }

        /* ckeditor5-table/theme/tablecolumnresize.css */
        [dir=rtl] .table .table-column-resizer {
            left: var(--ck-table-column-resizer-position-offset);
            right: unset;
        }

        /* ckeditor5-table/theme/tablecolumnresize.css */
        .ck-read-only .table .table-column-resizer {
            display: none;
        }

        /* ckeditor5-table/theme/table.css */
        .table {
            margin: 0.9em auto;
            display: table;
        }

        /* ckeditor5-table/theme/table.css */
        .table table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            height: 100%;
            border: 1px double hsl(0, 0%, 70%);
        }

        /* ckeditor5-table/theme/table.css */
        .table table td,
        .table table th {
            min-width: 2em;
            padding: .4em;
            border: 1px solid hsl(0, 0%, 75%);
        }

        /* ckeditor5-table/theme/table.css */
        .table table th {
            font-weight: bold;
            background: hsla(0, 0%, 0%, 5%);
        }

        /* ckeditor5-table/theme/table.css */
        [dir="rtl"] .table th {
            text-align: right;
        }

        /* ckeditor5-table/theme/table.css */
        [dir="ltr"] .table th {
            text-align: left;
        }
    </style>

</head>

<body class="login-page" style="background: white">

    <div>
        <div class="row">
            <div class="col-xs-7">
                {{-- <h4>From:</h4> --}}
                <strong>Clinica Vida y Salud</strong><br>
                123 Company Ave. <br>
                Toronto, Ontario - L2R 5A4<br>
                P: (416) 123-4567 <br>
                E: copmany@company.com <br>

                <br>
            </div>

            <div class="col-xs-4">
                <img src="{{ asset('midone/dist/images/logo.png') }}" alt="logo">
            </div>
        </div>

        <div style="margin-bottom: 0px">&nbsp;</div>

        <div class="row">
            <div class="col-xs-6">
                <h4>Para:</h4>
                <address>
                    <strong>{{ $recipe->patient->person->name . ' ' . $recipe->patient->person->f_last_name . ' ' . $recipe->patient->person->m_last_name }}</strong><br>
                    {{-- <span>{{ $recipe->patient->person->address }}</span> <br> --}}
                    {{-- <span>123 Address St.</span> --}}
                </address>
            </div>

            <div class="col-xs-5">
                <table style="width: 100%">
                    <tbody>
                        <tr>
                            <th>Número de receta:</th>
                            <td class="text-right">{{ $recipe->id }}</td>
                        </tr>
                        <tr>
                            <th> Fecha: </th>
                            <td class="text-right">{{ date('m-d-Y', strtotime($recipe->created_at)) }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- <div style="margin-bottom: 0px">&nbsp;</div>

                <table style="width: 100%; margin-bottom: 20px">
                    <tbody>
                        <tr class="well" style="padding: 5px">
                            <th style="padding: 5px">
                                <div> Balance Due (CAD) </div>
                            </th>
                            <td style="padding: 5px" class="text-right"><strong> $600 </strong></td>
                        </tr>
                    </tbody>
                </table> --}}
            </div>
        </div>

        <div class="h-50">
            {!!  $recipe->description  !!}
        </div>


        <div class="row">
            <div class="col-xs-6"></div>
            <div class="col-xs-5">
                <table style="width: 100%">
                    <tbody>
                        <tr class="well" style="padding: 5px">
                            <th style="padding: 5px">
                                <div> Medico encargado: </div>
                            </th>
                            <td style="padding: 5px" class="text-right"><strong> Juan Perez </strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div style="margin-bottom: 0px">&nbsp;</div>

        <div class="row">
            <div class="col-xs-8 invbody-terms">
                Thank you for your business. <br>
                <br>
                <h4>Payment Terms</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eius quia, aut doloremque, voluptatibus
                    quam ipsa sit sed enim nam dicta. Soluta eaque rem necessitatibus commodi, autem facilis iusto
                    impedit!</p>
            </div>
        </div>
    </div>

</body>

</html>
