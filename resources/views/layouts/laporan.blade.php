<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Laporan @yield('judul')</title>

    <!-- css untok print pdf -->
    <!-- <link href="css/print.css" rel="stylesheet"> -->
    <style type="text/css">

         @page { 
            margin: 180px 50px 0px 50px; 
         }
        .holyshit { 
            position: fixed; 
            left: 0px; 
            top: -180px; 
            right: 0px; 
            height: 150px; 
            text-align: center; }

        table{
            border-collapse: collapse;
        }
        
        thead,tr {
            text-align: center;
            border: 1px solid black;
            border-bottom: 2px solid black;
            padding: 5px;
        }
        th {
            text-align: center;
            border: 1px solid black;
            border-bottom: 2px solid black;
            padding: 5px;
            background: gray;
        }
        tr, td {
            border: 1px solid black;
            padding-left: 3px;
            padding-right: 3px;
        }

        .tabelkosong table,
        .tabelkosong tr,
        .tabelkosong td {
            border:0px;
        }

        .kopsurat {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <div class="holyshit">
<!--         <div class="kopsurat">
            <center><img src="images/kop-surat.png" ></center>
        </div> -->
        <div style="margin-top:100px;">
            <center><b><u>Laporan @yield('judul')</u></b></center>
        </div>

    </div>
    <div id="content" style="margin-top:20px;">
        <div>
        @yield('isi')
        </div>
        <div>
        @yield('ttd')
        </div>
    </div>
</body>
</html>