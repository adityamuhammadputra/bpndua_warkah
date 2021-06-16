<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <link href="lumino/css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all"> --}}
    <style>
        .headerlogo{
            width: 100%;
            height: 100px;
            padding: 10px;
            border-bottom: 0.1px dashed grey;
        }
        .atasgambar{
            width:120px;
            height: auto;
            float: left;
        }
        .atasheader{
            width: 80%;
            height: auto;
            float: left;
            text-align: center;
            padding-top: 16px;
        }
        .tulisanpalingatas{
            font: 18px bold calibri;
        }
        .atasjudul{
            width: 100%;
            padding: 0px 100px;
            text-align: center;
        }
        .heaederorang{
            width: 100%;
            height: 100px;
            padding-top: 30px;
            font-size: 14px;
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
        .heaederorangkiri{
            width: 60%;
            float: left;
        }
        .heaederorangkanan{
            padding-left: 30px;
            float: right;
        }
        .isitable{
            padding-top: 20px;
        }
        #customers {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-weight: 100;
            font-size: 14px;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
            padding-bottom: 20px;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color:silver;
        }
        .footer{
            width: 100%;
            height: 20px;
            position: fixed;
            bottom: 0;
            text-align: center;
            font-size: 12px;
            border-bottom: 0.1px dashed grey;

        }
        .tanggalcetak{
            position: fixed;
            bottom: 0;
            right: 0;
            font-size: 10px;
            float: right;
        }
        .tanggalcetak img{
            width: 12px;
            margin-top: 2px;
        }
        .ttd{
            width: 200px;
            position: relative;
            float: right;
            text-align: center;
            height: 90px;
            margin-top: 10px;
        }
        .ttd2{
            width: 200px;
            position: relative;
            float: left;
            text-align: center;
            height: 90px;
        }
    </style>
</head>
<body>
    <div class="headerlogo">
        <div class="atasgambar">
            <img src="joli/img/bpnlogo.png" width="100px">
        </div>
        <div class="atasheader">
            <b class="tulisanpalingatas">BADAN PERTANAHAN NASIONAL - RI</b><br>
            <b class="tulisanpalingatas">PERWAKILAN KANTOR PERTANAHAN KABUPATEN BOGOR</b>
            <p style="padding-top: 0px;">Jl.Alternatif Cibubur No.6 Cileungsi, Kec.Cileungsi, Kab.Bogor, Jawa Barat 16820.</p>
        </div>
    </div>
    <div class="atasjudul">
        <b><u>PERMOHONAN PEMINJAMAN BUKUTANAH DAN WARKAH</u></b><br>
        <i>Nomor : {{ $data->id }} / 2021</i>
    </div>
    <div class="heaederorang">
        <div class="heaederorangkiri">
            <table >
                <tr>
                    <td>Nama Peminjam</td>
                    <td>:</td>
                    <td>{{ $data->nama }}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{ $data->nip }}</td>
                </tr>
                <tr>
                    <td>Unit Kerja </td>
                    <td>:</td>
                    <td>{{ $data->unit_kerja }}</td>
                </tr>
                <tr>
                    <td>Penggunaan</td>
                    <td>:</td>
                    <td>{{ $data->kegiatan->nama_kegiatan }}</td>
                </tr>
            </table>
        </div>

        <div class="heaederorangkanan">
            <table >
                <tr>
                    <td>Tanggal Pinjam</td>
                    <td>:</td>
                    <td>{{ $data->tanggal_pinjam }}</td>
                </tr>
                <tr>
                    <td>Tgl Jatuh Tempo</td>
                    <td>:</td>
                    <td>{{ $data->tanggal_jatuh_tempo }}</td>
                </tr>
                <tr>
                    <td>Jumlah Peminjaman</td>
                    <td>:</td>
                    <td>Buku Tanah {{ $data->peminjamandetail->count() }}</td>
                </tr>
                 <tr>
                    <td>Peminjaman Via</td>
                    <td>:</td>
                    <td>{{ $data->via }}</td>
                </tr>
            </table>
        </div>

    </div>

    <div class="footer">
        &copy;2021 Perwakilan Kantor Pertanahan Kabupaten Bogor
    </div>

    <div class="isitable">
        <table id="customers">
            <thead>
                <tr>
                    <th width="10%">No.Hak</th>
                    <th width="10%">Jenis Hak</th>
                    <th width="15%">Desa / Kecamatan</th>
                    <th width="10%">No.SU/No.HT</th>
                    <th width="10%">No.Warkah</th>
                    <th width="15%">No.Seri </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data->peminjamandetail as $datas)
                <tr>
                    <td> {{ $datas->no_hak }}</td>
                    <td> {{ $datas->jenis_hak }}</td>
                    <td> {{ $datas->desa }} / {{ $datas->kecamatan }}</td>
                    <td> {{ $datas->no_su ?? $datas->no_ht }}</td>
                    <td> {{ $datas->no_warkah }}</td>
                    <td> {{ $datas->no_seri }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="ttd">
        Pemohon / Peminjam
        <br><br>
        <br><br>
        <br><br>
        <u>{{ $data->nama }}</u> <br>
        <b>{{ $data->nip }}</b>
    </div>
    <div class="ttd2">
        Petugas  Peminjaman
        <br><br>
        <br><br>
        <br><br>
        <u>{{ auth()->user()->name }}</u> <br>
    </div>
</body>
</html>
