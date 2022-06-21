@php
use App\Models\Department;
use App\Models\Person;
use App\Models\Patient;
use App\Models\Staff;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Especialidades</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
</head>

<body class="login-page" style="background: white">

    <div>
        <div class="text-center">
            <h3>Orden de derivación</h3>
        </div>
        <hr>

        <div class="h-75">
            <table class="table table-bordered" style="width: 100%">
                <tbody>
                    <tr>
                        <th>Paciente</th>
                        <td class="text-right">
                            {{ $consultation->patient->person->name }}
                            {{ $consultation->patient->person->f_last_name }}
                            {{ $consultation->patient->person->m_last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th> Descripción </th>
                        <td class="text-right">
                            {{ $consultation->description }}
                        </td>
                    </tr>
                    <tr>
                        <th> Diagnostico ({{ $consultation->status }}) </th>
                        <td class="text-right">
                            {{ $consultation->diagnostic }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

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
                                    {{ $consultation->staff->person->name . ' ' . $consultation->staff->person->f_last_name . ' ' . $consultation->staff->person->m_last_name }}
                                </strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</body>

</html>
