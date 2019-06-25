<style type="text/css">
    @media (min-width: 768px){
        .modal-dialog {
            width: 600px;
            margin: 150px auto;
        }
    }
</style>
<div class="modal fade" id="myModal"  aria-hidden="true">
    <div class="modal-dialog" style="width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">媒体库</h4>
            </div>
            <div class="modal-body" style="padding:0px; margin:0px; width: 1000px;">
                <iframe width="1000" height="500" src="/filemanager/dialog.php?type=1&field_id=image" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModal_product"  aria-hidden="true">
    <div class="modal-dialog" style="width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">媒体库</h4>
            </div>
            <div class="modal-body" style="padding:0px; margin:0px; width: 1000px;">
                <iframe width="1000" height="500" src="/filemanager/dialog.php?type=1&field_id=product_image" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- 单独用于添加产品略缩图 -->
<div class="modal fade" id="myModal_min"  aria-hidden="true">
    <div class="modal-dialog" style="width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">媒体库</h4>
            </div>
            <div class="modal-body" style="padding:0px; margin:0px; width: 1000px;">
                <iframe width="1000" height="500" src="/filemanager/dialog.php?type=1&field_id=image_min" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- 单独用于添加产品大图 -->
<div class="modal fade" id="myModal_max"  aria-hidden="true">
    <div class="modal-dialog" style="width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">媒体库</h4>
            </div>
            <div class="modal-body" style="padding:0px; margin:0px; width: 1000px;">
                <iframe width="1000" height="500" src="/filemanager/dialog.php?type=1&field_id=image_max" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    // function responsive_filemanager_callback(field_id){
    //     var url=jQuery('#'+field_id).val();
    //     jQuery('#'+field_id).parent().find('img').attr('src', url);
    // }
   
     function responsive_filemanager_callback(field_id){
          var url=jQuery('#'+field_id).val();
        if (field_id == 'product_image') {
            console.log(url);
            //向后台添加商品图片
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"/productImages",
                type:"get",
                data:'url=' + url + '&product_id=' + $("#product_id").val(),
                success: function(data) {
                    //提示成功消息
                    console.log(data);
                    if(data.status){
                    $('.input-appends').append(
                        "<div class='image-item' id='product_image_"+data.id 

+"'>\
                            <img src='" + data.url + "' alt=' style='max-height:50px;'>\
                            <div><div class='btn btn-danger btn-xs' onclick='deletePic("+data.id 

+")'>删除</div></div>\
                        </div>"
                    );
                }
                },
                error: function(data) {
                    //提示失败消息

                },
            });
        }else if(field_id== 'image_min'){
      console.log($('#'+field_id).parent().children('.input-append'));
      $('#'+field_id).parent().children('.input-append').html('<img src="'+url+'" />');
      //.parent().find('img').attr('src', url);
        }else{
            $('#'+field_id).parent().find('img').attr('src', url);
        }
    }

    function deletePic(id){
             $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
            $.ajax({
                url:"/delProductImage/"+id,
                type:"get",
                success: function(data) {
                    if(data.status){
                        console.log($('#product_image_'+id));
                        $('#product_image_'+id).remove();
                    }
                }
            });
    }

</script>