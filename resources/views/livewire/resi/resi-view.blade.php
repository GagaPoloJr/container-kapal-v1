@php
use Carbon\Carbon;
@endphp

<div>
    <x-innerpage-layout>
        @section('title', 'View Resi' )
        <x-slot name="header">
            <x-slot name="title">
                {{ __('View') }} {{ $resi->no_resi }}
            </x-slot>

            <x-slot name="subtitle">
                {{ __('View Resi.') }}
            </x-slot>
            <x-slot name="action">
                <div class="col-auto ms-auto d-print-none">
                    <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                        <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                        Print Invoice
                    </button>
                </div>
            </x-slot>
        </x-slot>

        <div class="row row-cards">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <p class="header-p">PT. PELAYARAN ALKES LINES</p>
                                <p class="header-p">PT. EXPEDISI BINTANG TIMUR</p>
                                <p class="header-p">JL. KEMAYORAN BARU 30 - (031) 3573062 HUNTING</p>
                                <p class="header-p">SURABAYA</p>

                            </div>
                            <div class="col-3 offset-4 text-start">
                                <p class="header-p">KEPADA YTH </p>
                                <p class="header-p text-uppercase"> {{ $customers->nama }}</p>
                                <address class="text-uppercase">
                                    {!! $customers->alamat !!}<br>
                                    DI {{ $customers->asal }}<br>

                                </address>
                                <H3>NO. {{ $resi->no_resi }}</H3>
                            </div>
                            <div class="col-12 my-5">

                            </div>
                        </div>
                        <div class="text-muted">
                            <p class="text-capitalize">Dengan hormat,</p>
                            <p style="margin-bottom: unset">Bersama ini kami laporkan bahwa dengan <b> {{ $resi->kapal_muatan }}</b> berangkat pada tanggal {{ Carbon::parse($resi->created_at)->format('d/m/Y') }}</p>
                            <p>Telah kami atur muat barang-barang sebagai berikut:</p>
                        </div>
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Dari</th>
                                    <th>Collie</th>
                                    <th>Pak</th>
                                    <th>Jenis Barang</th>
                                    <th>No Container</th>
                                    <th>No Seal</th>
                                    <th>Kg</th>
                                    <th>P</th>
                                    <th>L</th>
                                    <th>T</th>
                                    <th>Jumlah</th>
                                 
                                </tr>
                            </thead>
                            @foreach($containers as $key => $container)
                            <tr>
                                <td>{{ Carbon::parse($container->tgl_serah_barang)->format('d-m-Y') }}</td>
                                <td>
                                    <p class="strong mb-1"> {{ $container->asal->nama }}</p>
                                    {{-- <div class="text-muted">Logo and business cards design</div> --}}
                                </td>
                                @foreach($container->items as $key => $items)
                                @if($key === 0)
                                <td>{{ $items->jml_barang }}</td>
                                <td>CLS</td>
                                <td>{{ $items->nama_barang }}</td>
                                <td>{{ $container->no_container }}</td>
                                <td>{{ $container->no_seal }}</td>
                                <td>{{ $items->kg }}</td>
                                <td>{{ $items->p }}</td>
                                <td>{{ $items->l }}</td>
                                <td>{{ $items->t }}</td>
                                <td class="font-weight-bold text-end">{{ round($items->jumlah_kubikasi) }}</td>
                                @endif
                                @endforeach
                                {{-- <td></td>
                                <td class="text-center">
                                    1
                                </td>
                                <td class="text-end">$1.800,00</td>
                                <td class="text-end">$1.800,00</td> --}}
                            </tr>
                            @if(count($container->items) >1)
                            @foreach($container->items as $key => $items)
                            @if($key !== 0)
                            <tr>
                                <td colspan="2"></td>
                                <td>{{ $items->jml_barang }}</td>
                                <td>CLS</td>
                                <td>{{ $items->nama_barang }}</td>
                                <td>{{ $container->no_container }}</td>
                                <td>{{ $container->no_seal }}</td>
                                <td>{{ $items->kg }}</td>
                                <td>{{ $items->p }}</td>
                                <td>{{ $items->l }}</td>
                                <td>{{ $items->t }}</td>
                                <td class="font-weight-bold text-end">{{ round($items->jumlah_kubikasi,2) }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                            @endforeach

                            <tr>
                                <td colspan="11" class="font-weight-bold text-uppercase text-end">Total</td>
                                <td class="font-weight-bold text-end">{{ round($resi->total_kubikasi)  }}</td>
                            </tr>
                        </table>
                        <p class="text-muted mt-5">Demikian Kami harap diterima dengan baik/cukup dan tidak lupa kami mengucapkan terimakasih atas kerjasamanya.</p>
                        <div class="row">
                            <div class="col-6">

                            </div>
                            <div class="col-6 text-muted text-end">
                                <p class="text-end">Surabaya, {{ Carbon::parse($resi->created_at)->formatLocalized('%d %B %Y') }}</p>
                                <p>Hormat Kami,</p>
                                <br><br>
                                <p>Fonny Sujatno</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-innerpage-layout>
</div>
