var app_url = window.location.origin, app_location = window.location;
$(function() {
    toastr.options.timeOut = 1500;
    toastr.options.extendedTimeOut = 60;
    toastr.options.progressBar = true;
    $('form#upload-url').submit(function(e) {
        e.preventDefault();
        if (!$('#file_url').val().trim().length) exit(); 
        var arrayOfLines = $('#file_url').val().split('\n');
        $.each(arrayOfLines, function(index, item) {
            UploadLinks(this);
        });
    });
    $('form#upload-picker').submit(function(e) {
        e.preventDefault();
        var items = $(".files");
        UploadPicker(items);
    });
    $('#btn-del').click(function() {
        swal({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if(result.value) {
            $('input[name="file-item"]:checked').each(function(i){
                delFile($(this));
            });
          }
        });
    });
    $('#btn-mdl').bind('click',function() {
        if(!$('input[name=file-item]').is(":checked")) return
        $('#frm-edit').html('');$('#modalEdit').modal('show');
        $('input[name=file-item]:checked').each(function(i){
            if(i>=20) return;
            var t = $(this);
            var id = t.val();
            var fname = t.parent().parent('tr').find('td:nth-child(2)').text();
            $('#frm-edit').append(`<input class="form-control fName" minlength="5" data-id="${id}" name="fName" value="${fname}">`);
        });
   });
    $('#btn-link').bind('click',function() {
        results = [];
        if(!$('input[name=file-item]').is(":checked")) return;
        $('#txtarea-links').html('');$('#modalLink').modal('show');
        $('input[name=file-item]:checked').each(function(i){
            var flink = $(this).parent().parent('tr').find('a').attr('href');
            results.push(app_url+flink);
        });
        $('#txtarea-links').html(results.join('\r\n'));
   });
   $('form#frm-edit').submit(function(e) {
        e.preventDefault();
        var sArr = $(this).find('.fName');
        $.each(sArr, function(i, v) {
            var f = $(v);
            var id = f.attr('data-id'), nm = f.val();
            $.post(app_url+'/ajax/update-filename', {'fid':id, 'fname':nm}, function(data) {
                if(data.success) toastr.success(nm, "Rename Succeeded");
            }, 'json');
        });
    });

});
function dl(elm){
    elm.innerHTML=elm.text+'<i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw">';
    window.location.href=dlUrl;
}
function copier(elemt) {
    elemt.select();
    var cop = document.execCommand('copy');
    if(cop) alert('Copy to clipboard');
}
function delFile(t, alrt=false, single=false) {
    id = single ? t : t.val();
    $.post(app_url+'/ajax/delete', { file_id:id }, function(data) {
        if(data.success) {
            if(single) return swal('Delete File', 'File was successfully deleted', 'success');
            t.parent().parent('tr').fadeOut(200).remove();
            if(alrt) toastr.success('Success deleted', 'Delete File');
        } else {
            if(single) return swal('Delete File', data.msg, 'error');
            toastr.error('Error deleted', 'Delete File');
        }
    }, 'json');
}
function UploadLinks(id) {
    results = [];
    $.ajax({
         url:app_url+'/ajax/share',
         type:'POST',
         cache:true,
         data:{file_url:id},
         dataType:'json',
         beforeSend: function() {
                $('#shareFrm1').hide();
                $('#btn-share').prop('disabled', true);
                $('.preload1').show();
                $('#sharetext').empty();
         }, success: function(response) {
                if(response.success) {
                    var resUrl=app_url+'/'+response.share[0].file_url;
                    results.push(resUrl.link(resUrl));
                    toastr.success(response.share[0].file_name, 'Success');
                    $('#shareFrm1').show(400);
                    $('#sharetext').html(results.join("<br/>"));
                } else {
                    toastr.error(response.msg, 'Error');
                }
         },complete:function() {
            $('.preload1').hide();
            setTimeout(function(){$('#btn-share').prop('disabled', false);}, 5000);
        }, error: function(response) {
            console.log(response);
            swal('Failed','Oow.. error when receiving request, make sure input URL correctly','error');
         }
     })
}
function UploadPicker(items) {
    results = [];
    if (items.length<1) return swal("Please choose a file to continue");
    $('#btn-share').prop('disabled', true);
    $.each(items, function(k, v){
        var i = $(v);
        var id = i.attr("g-id");
        i.find(".statFile").html(`<small class="badge-pill badge-secondary">uploading..</small>`);
        $.ajax({
            url:app_url+'/ajax/share-picker',
            type:'POST',
            cache:true,
            data:{data_file:id},
            success:function(response) {
                if(response.success) {
                    var share = response.share[0];
                    var resUrl=app_url+'/'+share.file_url;
                    results.push(resUrl);
                    i.find(".nameFile").attr(`href`, '/'+share.file_url);
                    i.find(".statFile").html(`<small class="badge-pill badge-success"><i class="fa fa-check"></i></small>`);
                } else {
                    i.find(".statFile").html(`<small class="badge-pill badge-danger">error</small>`);
                }
            },complete:function() {
                $('#shareFrm2').show(400);
                $('#sharetext').html(results.join("<br/>"));
                setTimeout(function(){$('#btn-share').prop('disabled', false);}, 5000);
            }, error:function(x,h,r){
                console.log(x.status);
            }
        });
    });
}