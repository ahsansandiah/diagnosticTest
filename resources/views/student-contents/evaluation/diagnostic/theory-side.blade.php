<div class="col-md-12">
    <div class="box box-solid">
        <div class="box-header with-border">
            <i class="fa fa-text-width"></i>

            <h3 class="box-title">Theory</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if(!is_null($medias))
                @foreach($medias as $media)
                    <iframe src ="{{ $path.'/'.$media->media->file_name}}" width="100%" height="450"></iframe>
                @endforeach
            @else
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Materi belum tersedia</h4>
                </div>
            @endif
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>