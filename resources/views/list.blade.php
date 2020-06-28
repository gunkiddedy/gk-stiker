{{-- @if (!empty($split))
    @for ($i = 0; $i < count($split); $i++)
    <table border="0" style="background: yellow;width: 100%;margin-bottom:12px" >
        <tr>
            @for ($j = $i; $j < $i + 1; $j++)
                @if ($j % 2 == 0)
            <td>
                @foreach ($split[$j] as $item)
                <table style="background: red;width:100%" border="1">
                    <tr>
                        <td>
                            {{ $item->kodekib }}
                            {{ $item->nolokasi }}
                            {{ $item->ruang }}
                            {{ $item->uraibarang }}
                            {{ $item->uraiorganisasi }}    
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
                @if (!empty($k))
                    @foreach ($split[$k] as $item)
                    <table style="background: green;width:100%" border="1">
                        <tr>
                            <td>
                                {{ $item->kodekib }}
                                {{ $item->nolokasi }}
                                {{ $item->ruang }}
                                {{ $item->uraibarang }}
                                {{ $item->uraiorganisasi }}    
                            </td>
                        </tr>
                    </table>
                    @endforeach
                @endif
            </td>
                @endif
            @endfor

        </tr>
    </table>
    @endfor
    <div class="page_break"></div>
@else
    <h1>No data found!</h1>
@endif --}}


@for ($i = 0; $i<5; $i++)
<table border="1" style="background: yellow;width: 100%;margin-bottom:4px" >
    <tr>
        @for ($j = $i; $j < $i+1; $j++)
            @if ($j % 2 == 0)
            <td style="background: greenyellow">
                <table style="background: red;" border="1">
                    <tr>
                        <td>
                            {{ ' Data '.$j }}
                            KIB227185LOKASI12.02.12.04.010101.30929.09290010BARANGAlat Khusus Keamanan LainnyaRUANGRUANG TUOPDSDN PONJONG IIITAHUN201    
                        </td>
                    </tr>
                </table>                
            </td>
            @endif
        @endfor
        @for ($k=$j; $k <= $j; $k++)
            @if ($k % 2 !== 0)
            <td style="background: green">
                <table style="background: green;" border="1">
                    <tr>
                        <td>
                            {{ ' Data '.($k) }}   
                            KIB227185LOKASI12.02.12.04.010101.30929.09290010BARANGAlat Khusus Keamanan LainnyaRUANGRUANG TUOPDSDN PONJONG IIITAHUN201
                        </td>
                    </tr>
                </table>
            </td>

            @endif
        @endfor
        
    </tr>
</table>
@endfor

<button id="btn">Test</button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
<script>

    $(document).ready(function() {
        $('#btn').click(function(){
            alert('hehe');
        });

        $('table').each(function() {
            if($(this).find('td').length == 0) {
                $(this).hide();
                // alert('tabel kosong');
            }
        });

    });

</script>