@extends('dashboard.layouts.main')
{{-- @dd($jadwals) --}}
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Jadwal</h1>
    </div>
   
    <div class="schedule">
        @php
        $bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
        @endphp
        <table class="table table-striped table-sm">
            <tr>
                <td style=" vertical-align : middle;text-align:center;" > <b>Hari</b></td>
                <td style=" vertical-align : middle;text-align:center;" > <b>Tanggal</b></td>
                <td style=" vertical-align : middle;text-align:center;" > <b>Jam</b></td>
                <td style=" vertical-align : middle;text-align:center;" > <b>Kode Matkul</b></td>
                <td style=" vertical-align : middle;text-align:center;" > <b>Nama Matkul</b></td>
                <td style=" vertical-align : middle;text-align:center;" > <b>Materi</b></td>
                <td style=" vertical-align : middle;text-align:center;" > <b>Ruangan</b></td>
                <td style=" vertical-align : middle;text-align:center;" > <b>Kinerja</b></td>
            </tr>
            <tr text-align="center">
                @php
                    $count = 0;
                @endphp
                @foreach ($jadwals as $jadwal)
                    @if(  date('l', strtotime(date('F d,Y', strtotime($jadwal->tanggal))))  == "Monday"  )
                        @php
                            $count++;
                        @endphp
                    @endif
                @endforeach
                {{-- @dd($count) --}}
                @if($count != 0)
                    <td style="  vertical-align : middle;text-align:center;" rowspan={{ $count }}><b>Senin</b></td>
                    @foreach ($jadwals as $jadwal)
                       
                        @if(  date('l', strtotime(date('F d,Y', strtotime($jadwal->tanggal))))  == "Monday"  )
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $bulan[date('n', strtotime(date('F d, y', strtotime($jadwal->tanggal))))] }} {{ date('d,Y', strtotime(date('F d,Y', strtotime($jadwal->tanggal)))) }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->jammasuk }} - {{ $jadwal->jamselesai }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->kodematkul }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->namamatkul }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->materi }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->ruangan }}</b></td> 
                                <td style="  vertical-align : middle;text-align:center;"><a href="{{ $jadwal->kinerja }}" class="badge bg-info" target="_blank">Pergi</a></td> 
                            </tr>
                        @endif
                    @endforeach
                @else
                <td style="  vertical-align : middle;text-align:center;"><b>Senin</b></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td> 
                    <td style="  vertical-align : middle;text-align:center;"></td> 
                    </tr>
                @endif
            <tr>
                @php
                    $count = 0;
                @endphp
                @foreach ($jadwals as $jadwal)
                    @if(  date('l', strtotime(date('F d,Y', strtotime($jadwal->tanggal))))  == "Tuesday"  )
                        @php
                            $count++;
                        @endphp
                    @endif
                @endforeach
                {{-- @dd($count) --}}
                @if($count != 0)
                    <td style="  vertical-align : middle;text-align:center;" rowspan={{ $count }}><b>Selasa</b></td>
                    @foreach ($jadwals as $jadwal)
                        @if(  date('l', strtotime(date('F d,Y', strtotime($jadwal->tanggal))))  == "Tuesday"  )
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $bulan[date('n', strtotime(date('F d, y', strtotime($jadwal->tanggal))))] }} {{ date('d,Y', strtotime(date('F d,Y', strtotime($jadwal->tanggal)))) }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->jammasuk }} - {{ $jadwal->jamselesai }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->kodematkul }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->namamatkul }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->materi }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->ruangan }}</b></td> 
                                <td style="  vertical-align : middle;text-align:center;"><a href="{{ $jadwal->kinerja }}" class="badge bg-info" target="_blank">Pergi</a></td> 
                            </tr>
                        @endif
                    @endforeach
                @else
                    <td style="  vertical-align : middle;text-align:center;"><b>Selasa</b></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td> 
                    </tr>
                @endif
            <tr>
                @php
                    $count = 0;
                @endphp
                @foreach ($jadwals as $jadwal)
                    @if(  date('l', strtotime(date('F d,Y', strtotime($jadwal->tanggal))))  == "Wednesday"  )
                        @php
                            $count++;
                        @endphp
                    @endif
                @endforeach
                {{-- @dd($count) --}}
                @if($count != 0)
                    <td style="  vertical-align : middle;text-align:center;" rowspan={{ $count }}><b>Rabu</b></td>
                    @foreach ($jadwals as $jadwal)
                        @if(  date('l', strtotime(date('F d,Y', strtotime($jadwal->tanggal))))  == "Wednesday"  )
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $bulan[date('n', strtotime(date('F d, y', strtotime($jadwal->tanggal))))] }} {{ date('d,Y', strtotime(date('F d,Y', strtotime($jadwal->tanggal)))) }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->jammasuk }} - {{ $jadwal->jamselesai }}</b></td>
                                
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->kodematkul }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->namamatkul }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->materi }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->ruangan }}</b></td> 
                                <td style="  vertical-align : middle;text-align:center;"><a href="{{ $jadwal->kinerja }}" class="badge bg-info" target="_blank">Pergi</a></td> 
                            </tr>
                        @endif
                    @endforeach
                @else
                    <td style="  vertical-align : middle;text-align:center;"><b>Rabu</b></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td> 
                    </tr>
                @endif
            <tr>
                @php
                    $count = 0;
                @endphp
                @foreach ($jadwals as $jadwal)
                    @if(  date('l', strtotime(date('F d,Y', strtotime($jadwal->tanggal))))  == "Thursday"  )
                        @php
                            $count++;
                        @endphp
                    @endif
                @endforeach
                {{-- @dd($count) --}}
                @if($count != 0)
                    <td style="  vertical-align : middle;text-align:center;" rowspan={{ $count }}><b>Kamis</b></td>
                    @foreach ($jadwals as $jadwal)
                        @if(  date('l', strtotime(date('F d,Y', strtotime($jadwal->tanggal))))  == "Thursday"  )
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $bulan[date('n', strtotime(date('F d, y', strtotime($jadwal->tanggal))))] }} {{ date('d,Y', strtotime(date('F d,Y', strtotime($jadwal->tanggal)))) }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->jammasuk }} - {{ $jadwal->jamselesai }}</b></td>
                                
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->kodematkul }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->namamatkul }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->materi }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->ruangan }}</b></td> 
                                <td style="  vertical-align : middle;text-align:center;"><a href="{{ $jadwal->kinerja }}" class="badge bg-info" target="_blank">Pergi</a></td> 
                            </tr>
                        @endif
                    @endforeach
                @else
                    <td style="  vertical-align : middle;text-align:center;"><b>Kamis</b></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td> 
                    </tr>
                @endif
            <tr>
                @php
                    $count = 0;
                @endphp
                @foreach ($jadwals as $jadwal)
                    @if(  date('l', strtotime(date('F d,Y', strtotime($jadwal->tanggal))))  == "Friday"  )
                        @php
                            $count++;
                        @endphp
                    @endif
                @endforeach
                {{-- @dd($count) --}}
                @if($count != 0)
                    <td style="  vertical-align : middle;text-align:center;" rowspan={{ $count }}><b>Jumat</b></td>
                    @foreach ($jadwals as $jadwal)
                        @if(  date('l', strtotime(date('F d,Y', strtotime($jadwal->tanggal))))  == "Friday"  )
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $bulan[date('n', strtotime(date('F d, y', strtotime($jadwal->tanggal))))] }} {{ date('d,Y', strtotime(date('F d,Y', strtotime($jadwal->tanggal)))) }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->jammasuk }} - {{ $jadwal->jamselesai }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->kodematkul }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->namamatkul }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->materi }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->ruangan }}</b></td> 
                                <td style="  vertical-align : middle;text-align:center;"><a href="{{ $jadwal->kinerja }}" class="badge bg-info" target="_blank">Pergi</a></td> 
                            </tr>
                        @endif
                    @endforeach
                @else
                    <td style="  vertical-align : middle;text-align:center;"><b>Jumat</b></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td> 
                    <td style="  vertical-align : middle;text-align:center;"></td> 
                    </tr>
                @endif
            <tr>
                @php
                    $count = 0;
                @endphp
                @foreach ($jadwals as $jadwal)
                    @if(  date('l', strtotime(date('F d,Y', strtotime($jadwal->tanggal))))  == "Saturday"  )
                        @php
                            $count++;
                        @endphp
                    @endif
                @endforeach
                {{-- @dd($count) --}}
                @if($count != 0)
                    <td style="  vertical-align : middle;text-align:center;" rowspan={{ $count }}><b>Sabtu</b></td>
                    @foreach ($jadwals as $jadwal)
                        @if(  date('l', strtotime(date('F d,Y', strtotime($jadwal->tanggal))))  == "Saturday"  )
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $bulan[date('n', strtotime(date('F d, y', strtotime($jadwal->tanggal))))] }} {{ date('d,Y', strtotime(date('F d,Y', strtotime($jadwal->tanggal)))) }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->jammasuk }} - {{ $jadwal->jamselesai }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->kodematkul }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->namamatkul }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->materi }}</b></td>
                                <td style="  vertical-align : middle;text-align:center;"><b>{{ $jadwal->ruangan }}</b></td> 
                                <td style="  vertical-align : middle;text-align:center;"><a href="{{ $jadwal->kinerja }}" class="badge bg-info" target="_blank">Pergi</a></td> 
                            </tr>
                        @endif
                    @endforeach
                @else
                    <td style="  vertical-align : middle;text-align:center;" rowspan={{ $count }}><b>Sabtu</b></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td>
                    <td style="  vertical-align : middle;text-align:center;"></td> 
                    <td style="  vertical-align : middle;text-align:center;"></td> 
                    </tr>
                @endif
            
        </table>
    </div>
@endsection