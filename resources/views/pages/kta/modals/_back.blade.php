<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kartu Belakang</title>
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
.istrisuami{
    color: #35363a;
    top: 65px;
    left: 125px;
    font-size:28px;
    font-family:Arial;
}
    .istri{
        color: #35363a;
    top: 65px;
    left: 260px;
    font-size:30px;
    font-family:Arial;
}
.noktp{
    color: #35363a;
    top: 113px;
    left: 260px;
    font-size:30px;
    font-family:Arial;
}
.alamat1{
    color: #35363a;
    top: 158px;
    left: 260px;
    font-size:30px;
    font-family:Arial;
}
.alamat2{
    color: #35363a;
    top: 210px;
    left: 260px;
    font-size:30px;
    font-family:Arial;
}

.wilayahrayon{
    color: #35363a;
    top: 264px;
    left: 260px;
    font-size:30px;
    font-family:Arial;
}
    </style>
</head>
<body>
	<div id="imgDiv" style="width: 1003px; height: 661px">
		<img src="{{ asset('assets/img/ktabelakang.jpg') }}">
		<p class="istrisuami"><b>{{ $data->istri_suami }}</b></p>
		<p class="istri"><b>{{ $data->nama_istri_suami }}</b></p>
		<p class="noktp"><b>{{ $data->nik_istri_suami }}</b></p>
		<p class="alamat1"><b>{{ $data->alamat1 }}</b></p>
		<p class="alamat2"><b>{{ $data->alamat2 }}</b></p>
		<p class="wilayahrayon"><b>{{ $data->wil_rayon }}</b></p>
	</div>
	<button id="btn" style="font-size:30px;">Download</button>
</body>
</html>
<script src="{{ asset('assets/js/jquery-1.8.2.js') }}"></script>
<script src="{{ asset('assets/js/bluebird.js') }}"></script>
<script src="{{ asset('assets/js/html2canvas.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
	// canvas生成图片
        $("#btn").on("click", function () {
            var getPixelRatio = function (context) { // 获取设备的PixelRatio
                var backingStore = context.backingStorePixelRatio ||
                    context.webkitBackingStorePixelRatio ||
                    context.mozBackingStorePixelRatio ||
                    context.msBackingStorePixelRatio ||
                    context.oBackingStorePixelRatio ||
                    context.backingStorePixelRatio || 0.5;
                return (window.devicePixelRatio || 0.5) / backingStore;
            };
            //生成的图片名称
            var imgName = "{{ $data->full_name }}_belakang.jpg";
            var shareContent = document.getElementById("imgDiv");
            var width = "1003";
            var height = "661";
            var canvas = document.createElement("canvas");
            var context = canvas.getContext('2d');
            canvas.width = width;
            canvas.height = height;
            canvas.style.width = width + 'px';
            canvas.style.height = height + 'px';

            var opts = {
                canvas: canvas,
                width: width,
                height: height,
                dpi: window.devicePixelRatio
            };
            html2canvas(shareContent, opts).then(function (canvas) {
                context.imageSmoothingEnabled = false;
                context.webkitImageSmoothingEnabled = false;
                context.msImageSmoothingEnabled = false;
                context.imageSmoothingEnabled = false;
                var dataUrl = canvas.toDataURL('image/jpeg', 1.0);
                dataURIToBlob(imgName, dataUrl, callback);
            });
        });
})
	

        // edited from https://developer.mozilla.org/en-US/docs/Web/API/HTMLCanvasElement/toBlob#Polyfill
       var dataURIToBlob =  function (imgName, dataURI, callback) {
            var binStr = atob(dataURI.split(',')[1]),
                len = binStr.length,
                arr = new Uint8Array(len);

            for (var i = 0; i < len; i++) {
                arr[i] = binStr.charCodeAt(i);
            }

            callback(imgName, new Blob([arr]));
        }

        var callback = function (imgName, blob) {
            var triggerDownload = $("<a>").attr("href", URL.createObjectURL(blob)).attr("download", imgName).appendTo("body").on("click", function () {
                if (navigator.msSaveBlob) {
                    return navigator.msSaveBlob(blob, imgName);
                }
            });
            triggerDownload[0].click();
            triggerDownload.remove();
        };
</script>