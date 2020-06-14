<style>
    table {
        font-size: 0.9rem;
        empty-cells: hide;
    }

    .page_break { page-break-after: always; }
</style>

@if (!empty($split))
    @for ($i = 0; $i < $index; $i++)
    <table border="0" style="margin:0px auto;">
        <tr>

            @for ($j = $i; $j < $i + 1; $j++)
                @if ($j % 2 == 0)
                <td>
                @foreach ($split[$j] as $item)
                <table style="background: red;width:100%" border="1">
                    <tr>
                        <td style="background: greenyellow">
                            {{ $item->kodekib }}
                            {{ $item->nolokasi }}
                            {{ $item->ruang }}
                            {{ $item->uraibarang }}
                            {{ $item->uraiorganisasi }}
                            <img 
                                src="data:image/png;base64, 
                                {!! base64_encode(QrCode::size(40)
                                ->errorCorrection('H')
                                ->generate($item->qrcode)) !!} 
                            ">
                        </td>
                    </tr>
                </table>
                @endforeach
                </td>
                @endif
            @endfor

            @for ($k=$j; $k <= $j; $k++)
                @if ($k % 2 !== 0)
                <td>
                @foreach ($split[$k] as $item)
                <table style="background: green;width:100%" border="1">
                <tr>
                    <td style="background: green">
                        {{ @$item->kodekib }}
                        {{ @$item->nolokasi }}
                        {{ @$item->ruang }}
                        {{ @$item->uraibarang }}
                        {{ @$item->uraiorganisasi }}
                        <img 
                                src="data:image/png;base64, 
                                {!! base64_encode(QrCode::size(40)
                                ->errorCorrection('H')
                                ->generate($item->qrcode)) !!} 
                            ">  
                    </td>
                </tr>
                </table>
                @endforeach
                </td>
                @endif
            @endfor

        </tr>
    </table>
    {{-- <div class="page_break"></div> --}}
    <div style="page-break-inside:always;">
    @endfor
@else
    <h1>No data found!</h1>
@endif


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
<script>
    $('table').each(function() {
        if($(this).find('td').length == 0) {
            $(this).hide();
            // alert('tabel kosong');
        }
    });
</script>
