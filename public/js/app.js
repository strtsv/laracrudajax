
$(document).ready(function(){
    
    var info       = $('.info');
    var infodelete = $('.info-delete');
    var $_token    = $('#token').val();

    $('.open-modal').click(function(){
        info.hide().find('ul').empty();
        var id = $(this).val();
        $.get('person/edit' + '/' + id, function (data) {
            $('#id').val(data.id);
            $('#first_name').val(data.first_name);
            $('#last_name').val(data.last_name);
            $('#address').val(data.address);
            $('#city').val(data.city);
            $('#postal_code').val(data.postal_code);
            $('#email').val(data.email);
            $('.save').val("update");
            $('#myModal').modal('show');
        }) 
    });

    $('#btn-add').click(function(){
        $('.save').val("add");
        $('#frm').trigger("reset");
        info.hide().find('ul').empty();
        $('#myModal').modal('show');
    });

    $('.delete').click(function(){
        var id = $(this).val();
        var x = confirm("Are you sure you want to delete?");
        if(x)
        {
            $.ajax({
                type: "POST",
                headers: { 'X-XSRF-TOKEN' : $_token }, 
                url: 'person/delete' + '/' + id,
                success: function (data) {
                    
                    infodelete.hide().find('ul').empty();
                    if(data.success == false)
                    {
                        infodelete.find('ul').append('<li>'+data.errors+'</li>');
                        infodelete.slideDown();
                        infodelete.fadeTo(2000, 500).slideUp(500, function(){
                           infodelete.hide().find('ul').empty();
                        });   
                    }
                    else
                    {
                        $("#person" + id).remove();
                    }
                },
            });

            return true;
            
        }
        
    });

    $(".save").click(function (e) {
        e.preventDefault();
        var state = $('.save').val();
        var id = $('#id').val();
        var url = 'person/store';

        if (state == "update"){
            url  = 'person/update/' + id;
        }

        var formData = {
            id: $('#id').val(),
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val(),
            address: $('#address').val(),
            city: $('#city').val(),
            postal_code: $('#postal_code').val(),
            email: $('#email').val()
        }

        $.ajax({

            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            headers: { 'X-XSRF-TOKEN' : $_token }, 
            success: function (data) {
                
                info.hide().find('ul').empty();
                    
                if(data.success == false)
                {
                    console.log(url);
                    $.each(data.errors, function(index, error) {
                        info.find('ul').append('<li>'+error+'</li>');
                    });

                    info.slideDown();
                    info.fadeTo(2000, 500).slideUp(500, function(){
                       info.hide().find('ul').empty();
                    });
                }
                else
                {
                    var person = '<tr id="person' + data.data.id + '"><td>' + data.data.first_name + '</td><td>' + data.data.last_name + '</td><td>' + data.data.address + '</td><td>' + data.data.city + '</td><td>' + data.data.email + '</td>';
                    person += '<td style="text-align:center;width:15%;"><button class="btn btn-xs btn-primary open-modal" value="' + data.id + '"> <i class="glyphicon glyphicon-edit"></i> Edit</button>';
                    person += '&nbsp;<button class="btn btn-xs btn-danger delete" value="' + data.id + '"><i class="glyphicon glyphicon-trash"></i> Delete</button></td></tr>';
                    
                    if (state == "add"){ 
                        $('#person-list').append(person);
                    }else{ 
                        $("#person" + id).replaceWith(person);
                    }

                    $('#frm').trigger("reset");
                    $('#myModal').modal('hide')
                }

                
            },
            error: function (data) {}
        });
    });
});

