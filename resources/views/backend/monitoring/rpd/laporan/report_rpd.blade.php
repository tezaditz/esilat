
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<head>
  <title>Laporan RPD</title>
</head>
<body>
    <div class="w3-container w3-center">
        RENCANA PENARIKAN DANA <br>
        {{ $satker->nama_satker }}
        <br>

        <table id="rpd_tables" class="w3-table w3-border w3-small" border="1">
            <thead>
            <tr>
                <th rowspan="2" class="w3-center w3-light-grey">Kode</th>
                <th rowspan="2" class="w3-center w3-light-grey">Uraian</th>
                <th rowspan="2" class="w3-center w3-light-grey">Jumlah</th>
                <th colspan="12" class="w3-center w3-light-grey">Rencana Penarikan Dana</th>
                <th rowspan="2" class="w3-center w3-light-grey">Total</th>
            </tr>
            <tr>
                
                    <th class="w3-center w3-light-grey" >@lang('backend/monitoring/rpd.tables.jan')</th>
                    <th class="w3-center w3-light-grey">@lang('backend/monitoring/rpd.tables.feb')</th>
                    <th class="w3-center w3-light-grey">@lang('backend/monitoring/rpd.tables.mar')</th>
                    <th class="w3-center w3-light-grey">@lang('backend/monitoring/rpd.tables.apr')</th>
                    <th class="w3-center w3-light-grey">@lang('backend/monitoring/rpd.tables.mei')</th>
                    <th class="w3-center w3-light-grey">@lang('backend/monitoring/rpd.tables.jun')</th>
                    <th class="w3-center w3-light-grey">@lang('backend/monitoring/rpd.tables.jul')</th>
                    <th class="w3-center w3-light-grey">@lang('backend/monitoring/rpd.tables.ags')</th>
                    <th class="w3-center w3-light-grey">@lang('backend/monitoring/rpd.tables.sep')</th>
                    <th class="w3-center w3-light-grey" >@lang('backend/monitoring/rpd.tables.okt')</th>
                    <th class="w3-center w3-light-grey">@lang('backend/monitoring/rpd.tables.nov')</th>
                    <th class="w3-center w3-light-grey">@lang('backend/monitoring/rpd.tables.des')</th>
                
            </tr>
            </thead>
           <tbody>
                @foreach($rpd as $key => $data)
               <tr>
                   <td>{{ $data['kode'] }}</td>
                   <td>{{ $data['uraian'] }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['jumlah'],0, ',', '.') }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['jan'],0, ',', '.') }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['feb'],0, ',', '.') }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['mar'],0, ',', '.') }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['apr'],0, ',', '.') }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['mei'],0, ',', '.') }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['jun'],0, ',', '.') }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['jul'],0, ',', '.') }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['ags'],0, ',', '.') }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['sep'],0, ',', '.') }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['okt'],0, ',', '.') }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['nov'],0, ',', '.') }}</td>
                   <td class ='w3-right-align'> {{ number_format($data['des'],0, ',', '.') }}</td>
                    <td class ='w3-right-align'>{{ number_format($data['total'],0, ',', '.') }}</td>


                   
                   
               </tr>
               @endforeach
           </tbody>
        </table>
    </div>

</body>
<script src="{{ asset('jquery/dist/jquery.min.js') }}"></script>
<!-- <script type="text/javascript">
        $.getJSON('{{ url("/monitoring/getreport") }}', function (result) {
            

            for (var i = 0; i < result.length; i++)  
            { 

                $('#rpd_tables').append('<tbody><tr><td>' + result[i].kode  + '</td><td>' + result[i].uraian  + '</td><td class="w3-right-align">' + result[i].pagu.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")  + '</td><td>'+ result[i].jan_update +'</td><td>'+ result[i].feb_update +'</td><td>'+ result[i].mar_update +'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody>');
            }
        });
</script> -->
</html>