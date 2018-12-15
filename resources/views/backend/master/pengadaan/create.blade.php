<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/01/2017
 * Time: 03:54 PM
 */
?>

<div class="modal fade" id="create-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" action="{{ route('master.pengadaan.store') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/master/pengadaan.module')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="rkakl" class="col-sm-2 control-label">@lang('backend/master/pengadaan.tables.rkakl_id')</label>
                        <div class="col-sm-10 {{ $errors->has('rkakl_id') ? 'has-error' : '' }}">
                            @if($rkakls->count() > 0)
                                <select name="rkakl_id" class="form-control select2" id="rkakl_id">
                                    @foreach($rkakls as $key => $rkakl)
                                        <option value="{{ $rkakl->id }}">{{ $rkakl->uraian }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('rkakl_id'))
                                    <span class="help-block">
                                    {{ $errors->first('rkakl_id') }}
                                </span>
                                @endif
                            @else
                                <a href="{{ route('master.rkakl.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a> @lang('backend/master/rkakl.rkakl.index.is_empty')
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">@lang('backend/master/pengadaan.module')</label>
                        <div class="col-sm-10 {{ $errors->has('title') ? 'has-error' : '' }}">
                            <input type="text" name="title" class="form-control" id="title" placeholder="Jakarta" required>
                            @if($errors->has('title'))
                                <span class="help-block">
                                    {{ $errors->first('title') }}
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">@lang('backend/_globals.buttons.cancel')</button>
                    <button type="submit" class="btn bg-light-blue btn-sm">@lang('backend/_globals.buttons.create')</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
            $('.date').datepicker({
                language: "id",
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });


            $('#no_mak').on('change', function() {
                var id = this.value;
                var url = "{{ route('pengajuan.kegiatan.memuat-uraian') }}"+'/'+id;
                $.ajax({
                    type: "Get",
                    url: url,
                    data: {id: id},
                    dataType: 'json',
                    success: function(result) {
                        var uraian_data = result.uraian_data;
                        var $nama_kegiatan = $("#nama_kegiatan");
                        $nama_kegiatan.empty();
                        uraian_data.forEach(function(entry) {
                            $nama_kegiatan.val(entry.uraian);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
            
        });
    </script>
@stop