<style>
    /* body {
        margin: 0px;
    } */
    @page {
        margin: 0px;
    }
    table {
        /* font-size: 0.5rem; */
        font-family:'Courier New', Courier, monospace;
        /* line-height: 1; */
        font-weight: bold;
        letter-spacing: -1px;
        word-spacing: -1px;
    }
    .tb-wraper {
        empty-cells: hide;
        padding: 0px;
        /* background: yellow; */
        /* border: 0.3px solid red; */
        margin-top:40px;
        margin-left:50px;
    }
    .tb-first {
        font-size: 0.6rem;
        /* border-bottom: 0.5px solid gray; */
        margin-left:65px;
        left: 0;
        position: relative;
        padding: 14px;
    }
    .tb-second {
        font-size: 0.6rem;
        /* border-bottom: 0.5px solid gray; */
        margin-left:55px;
        right:0;
        position:relative;
        padding: 14px;
    }
    .hidethis {
        display: none;
    }
</style>

@if (!empty($split))
    @for ($i = 0; $i < $index; $i++)
        {{-- table wraper --}}
        <table class="tb-wraper"> 
            <tr>
                @for ($j = $i; $j < $i + 1; $j++)
                    @if ($j % 2 == 0)
                        <td>
                            @foreach ($split[$j] as $item)
                                {{-- FIRST TABLE ====================================================================--}}
                                
                                <table class="tb-first">
                                    <tr>
                                        <td>KIB</td>
                                        <td>{{ $item->kodekib }}</td>
                                        <td rowspan="6">
                                            <img class="imgs"
                                                src="data:image/png;base64, 
                                                {!! base64_encode(QrCode::size(50)
                                                ->errorCorrection('H')
                                                ->generate($item->qrcode)) !!} 
                                            ">
                                            {{$item->qrcode}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>LOKASI</td>
                                        <td>{{ $item->nolokasi }}</td>
                                    </tr>
                                    <tr>
                                        <td>BARANG</td>
                                        <td>{{ $item->uraibarang }}</td>
                                    </tr>
                                    <tr>
                                        <td>RUANG</td>
                                        <td>{{ $item->ruang }}</td>
                                    </tr>
                                    <tr>
                                        <td>OPD</td>
                                        <td>{{ $item->uraiorganisasi }}</td>
                                    </tr>
                                    <tr>
                                        <td>TAHUN</td>
                                        <td>{{ $item->tahunperolehan }}</td>
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
                            {{-- SECOND TABLE ===========================================================--}}
                            <table class="tb-second">
                                <tr>
                                    <td>KIB</td>
                                    <td>{{ $item->kodekib }}</td>
                                    <td rowspan="6">
                                        <img class="imgs"
                                            src="data:image/png;base64, 
                                            {!! base64_encode(QrCode::size(50)
                                            ->errorCorrection('H')
                                            ->generate($item->qrcode)) !!} 
                                        ">
                                        {{$item->qrcode}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>LOKASI</td>
                                    <td>{{ $item->nolokasi }}</td>
                                </tr>
                                <tr>
                                    <td>BARANG</td>
                                    <td>{{ $item->uraibarang }}</td>
                                </tr>
                                <tr>
                                    <td>RUANG</td>
                                    <td>{{ $item->ruang }}</td>
                                </tr>
                                <tr>
                                    <td>OPD</td>
                                    <td>{{ $item->uraiorganisasi }}</td>
                                </tr>
                                <tr>
                                    <td>TAHUN</td>
                                    <td>{{ $item->tahunperolehan }}</td>
                                </tr>
                            </table>
                            @endforeach
                        </td>
                    @endif
                @endfor
            </tr>
        </table>
    @endfor
@else
    <h1>No data found!</h1>
@endif


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script> --}}
{{-- <script src="/script/jquery.min.js"></script> --}}
<script>
    alert('heh');
    // $(document).ready(function(){
    //     // if empty of each table, set css 'display:none'
    //     $('.tb-wraper').each(function() {
    //         if($(this).find('td').length == 0 ) {
    //             $(this).closest('table').remove();
    //             // $(this).css('background-color', 'black');
    //         }
    //     });
    //     // var index = '{{ $index }}';
    //     // for (var i = 0; i < index; i++){
    //     //     if( i % 2 != 0){ //ganjil
    //     //         $('#first'+i).hide();
    //     //     }
    //     //     if( i % 2 == 0){ //genap
    //     //         $('#second'+i).hide();
    //     //     }
    //     // }                                       
    // });
</script>
