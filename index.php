<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="icon" href="./favicon.png" type="image/png" sizes="16x16">
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
 
 <script src="./bower_components/resumable.js/resumable.js" type="application/javascript"></script>
 <script src="./bower_components/jquery/dist/jquery.min.js" type="application/javascript"></script>
 <script src="./bower_components/bootstrap/dist/js/bootstrap.min.js" type="application/javascript"></script>
</head>
<body>
    <form method="GET" action="upload.php" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Upload">
    </form>

    <script src="resumable.js">

    </script>

    <div class="container" style="padding-top: 100px;">
 
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8">
                <div class="page-header">
                    <h1> Resumable file upload<small> <br/>with Resumable.js and Resumable.php</small></h1>
                </div>
            </div>

            <div class="col-lg-offset-2 col-lg-8">
                <button type="button" class="btn btn-success" aria-label="Add file" id="add-file-btn">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add file
                </button>
                <button type="button" class="btn btn-info" aria-label="Start upload" id="start-upload-btn">
                    <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Start upload
                </button>
                <button type="button" class="btn btn-warning" aria-label="Pause upload" id="pause-upload-btn">
                    <span class="glyphicon glyphicon-pause " aria-hidden="true"></span> Pause upload
                </button>
            </div>


            <div class="col-lg-offset-2 col-lg-8">
                <p>
                    <div class="progress hide" id="upload-progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"   style="width: 0%">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </p>
            </div>
        </div>
    </div>
    <script>
    var r = new Resumable({
        target: 'upload.php',
        testChunks: true
    });

    r.assignBrowse(document.getElementById('add-file-btn'));

    $('#start-upload-btn').click(function(){
        r.upload();
    });

    $('#pause-upload-btn').click(function(){
        if (r.files.length>0) {
            if (r.isUploading()) {
            return  r.pause();
            }
            return r.upload();
        }
    });

    var progressBar = new ProgressBar($('#upload-progress'));

    r.on('fileAdded', function(file, event){
        progressBar.fileAdded();
    });

    r.on('fileSuccess', function(file, message){
        progressBar.finish();
    });

    r.on('progress', function(){
        progressBar.uploading(r.progress()*100);
        $('#pause-upload-btn').find('.glyphicon').removeClass('glyphicon-play').addClass('glyphicon-pause');
    });

    r.on('pause', function(){
        $('#pause-upload-btn').find('.glyphicon').removeClass('glyphicon-pause').addClass('glyphicon-play');
    });

    function ProgressBar(ele) {
        this.thisEle = $(ele);

        this.fileAdded = function() {
            (this.thisEle).removeClass('hide').find('.progress-bar').css('width','0%');
        },

        this.uploading = function(progress) {
            (this.thisEle).find('.progress-bar').attr('style', "width:"+progress+'%');
        },

        this.finish = function() {
            (this.thisEle).addClass('hide').find('.progress-bar').css('width','0%');
        }
    }
    </script>
</body>
</html>