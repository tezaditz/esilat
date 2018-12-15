@foreach($rpd as $key => $value)
    
        <div class="modal fade" id="open-rpd-{{ $value->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Revisi RPK & RPD</h4>
                        </div>
                        <div class="modal-body">

                            
                            <div class="box box-success">
                                <div class="box-body table-responsive no-padding text-center">
                                    <br>
                                    <h4>
                                        Anda Ingin Mengubah RPK & RPD ?    
                                    </h4>
                                    <br>
                                </div>
                            </div>
                    </div>
                        <div class="modal-footer">
                            <a href="{{ route('monitoring.rpkrpd.input_rpkrpd' , $value->id ) }}" class="btn bg-light-blue btn-sm"><i class="fa fa-check"></i> Ya</a>  
                                <a href="{{ route('monitoring.rpkrpd.index') }}" class="btn btn-danger btn-sm pull-left"><i class="fa fa-close"></i> Tidak</a> 
                        </div>
                    
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    
@endforeach