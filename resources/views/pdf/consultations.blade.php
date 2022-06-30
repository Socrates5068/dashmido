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

    <title>Fichas</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
</head>

<body class="login-page" style="background: white">

    <div>
        <div class="text-center">
            <h3>Fichaje {{ $departmentName }}</h3>
        </div>
        <hr>

        @php
            $con = 0;
        @endphp

        <div class="">
            <table class="table table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">
                            Fecha
                        </th>
                        <th class="whitespace-nowrap">
                            Estado
                        </th>
                        <th class="whitespace-nowrap">
                            Paciente
                        </th>
                        <th class="whitespace-nowrap">
                            Diagnostico
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consultations as $consultation)
                        <tr>
                            <td class="border">
                                {{ date('d-m-Y', strtotime($consultation->created_at)) }}
                            </td>
                            <td>
                                {{ $consultation->status }}
                            </td>
                            <td>
                                {{ Patient::find($consultation->patient_id)->person->name }}
                                {{ Patient::find($consultation->patient_id)->person->f_last_name }}
                                {{ Patient::find($consultation->patient_id)->person->m_last_name }}
                            </td>
                            <td>
                                {{ $consultation->diagnostic }}
                            </td>
                        </tr>
                        @php
                            $con++;
                        @endphp
                        @if ($con == 20)
                            <div class="page-break"></div>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr>

        <div class="row">
            <div class="">
                <table style="width: 100%">
                    <tbody>
                        <tr class="well" style="padding: 5px">
                            <th style="padding: 5px">
                                <div> Médico encargado: </div>
                            </th>
                            <td style="padding: 5px" class="text-right">
                                {{ Staff::find($consultation->staff_id)->person->name }}
                                {{ Staff::find($consultation->staff_id)->person->f_last_name }}
                                {{ Staff::find($consultation->staff_id)->person->m_last_name }}
                            </td>
                            <th style="padding: 5px">
                                <div> Ficha generada el día: </div>
                            </th>
                            <td style="padding: 5px" class="text-right">
                                {{ date('d-m-Y', strtotime(now())) }}
                                {{ 'a horas ' . date('H:i:s', strtotime(now())) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
