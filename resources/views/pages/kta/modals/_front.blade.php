<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kartu Depan</title>
<style>
        * {
            margin: 0;
            padding: 0;
        }
        
        
        h2 {
            background: #efefef;
            margin: 10px;
        }
        
        .toPic {
            display: none;
        }
        
.box{
    width: 500px;
    height: 312px;
    position: relative;
}
.box img{
    width: 100%;
}
img,p{
    position: absolute;
}

    .kta{
    color: #35363a;
    top: 114px;
    left: 600px;
    font-size:30px;
    font-family:Arial;
}
.nama{
    color: #35363a;
    top: 160px;
    left: 550px;
    font-size:27px;
    font-family:Arial;
}
.ttl{
    color: #35363a;
    top: 194px;
    left: 550px;
    font-size:27px;
    font-family:Arial;
}
.agama{
    color: #35363a;
    top: 228px;
    left: 550px;
    font-size:27px;
    font-family:Arial;
}
.goldar{
    color: #35363a;
    top: 262px;
    left: 550px;
    font-size:27px;
    font-family:Arial;
}
.pangkat{
    color: #35363a;
    top: 294px;
    left: 550px;
    font-size:27px;
    font-family:Arial;
}
.nik{
    color: #35363a;
    top: 329px;
    left: 550px;
    font-size:27px;
    font-family:Arial;
}
.tandajasa{
    color: #35363a;
    top: 378px;
    left: 550px;
    font-size:27px;
    font-family:Arial;
}
.foto{
    top: 257px;
    left: 57px;
    font-size:30px;
    font-family:Arial;
}
.bar128{
    top: 570px;
    left: 51px;
    font-size:30px;
}
.tanggal{
    color: #35363a;
    top: 419px;
    left: 720px;
    font-size:28px;
    font-family:Arial;
}
.ttd{
    top: 555px;
    left: 300px;
    font-size:28px;
    font-family:Arial;
}
    </style>
</head>
<body>
	<div id="imgDiv" style="width: 1003px; height: 661px">
		<img src="{{ asset("assets/img/ktadepan.jpg") }}">
		<p class="kta"><b>{{ $data->no_kta }}</b></p>
		<p class="nama"><b>{{ $data->full_name }}</b></p>
		<p class="ttl"><b>{{ $data->ttl }}</b></p>
		<p class="agama"><b>{{ $data->agama }}</b></p>
		<p class="goldar"><b>{{ $data->gol_darah }}</b></p>
		<p class="pangkat"><b>{{ $data->pangkat_terakhir }}</b></p>
		<p class="nik"><b>{{ $data->nik }}</b></p>
		<p class="tandajasa"><b>{{ $data->tanda_jasa_tertinggi }}</b></p>
		<p class="foto"><img src="http://database.ppal.or.id/ppal/{{ $data->foto }}" width="199px" height="301px"></p>
		<p class="bar128"><img src='https://kta.ppal.or.id/barcode.php?codetype=code128&sizefactor=1&size=50&text={{ $data->no_kta }}'/></p>
		<p class="tanggal"><b>{{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('DD MMMM YYYY') }}</b></p>
		<p class="ttd"><b><img src="http://database.ppal.or.id/ppal/{{ $data->ttd }}"></b></p>
	</div>
	<button id="btn" style="font-size:30px;">Download</button>
</body>
</html>
<script src="{{ asset('assets/js/jquery-1.8.2.js') }}"></script>
<script src="{{ asset('assets/js/bluebird.js') }}"></script>
<script src="{{ asset('assets/js/html2canvas.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var imagesLoaded = 0;
        var totalImages = $("#imgDiv img").length;
    
        $("#imgDiv img").on('load', function() {
            imagesLoaded++;
            if (imagesLoaded === totalImages) {
                $("#btn").on("click", function() {
                    generateCanvas();
                });
            }
        }).each(function() {
            if (this.complete) $(this).trigger('load');
        });
    
        function generateCanvas() {
            var imgName = "{{ $data->full_name }}_depan.jpg";
            var shareContent = document.getElementById("imgDiv");
            var width = 1003;
            var height = 661;
            var canvas = document.createElement("canvas");
            var context = canvas.getContext('2d');
            canvas.width = width;
            canvas.height = height;
    
            var opts = {
                canvas: canvas,
                width: width,
                height: height,
                dpi: window.devicePixelRatio
            };
    
            html2canvas(shareContent, opts).then(function(canvas) {
                context.imageSmoothingEnabled = false;
                var dataUrl = canvas.toDataURL('image/jpeg', 1.0);
                dataURIToBlob(imgName, dataUrl, downloadBlob);
            });
        }
    
        function dataURIToBlob(imgName, dataURI, callback) {
            var binStr = atob(dataURI.split(',')[1]);
            var len = binStr.length;
            var arr = new Uint8Array(len);
    
            for (var i = 0; i < len; i++) {
                arr[i] = binStr.charCodeAt(i);
            }
    
            callback(imgName, new Blob([arr], {type: 'image/jpeg'}));
        }
    
        function downloadBlob(imgName, blob) {
            var link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = imgName;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    });
    </script>