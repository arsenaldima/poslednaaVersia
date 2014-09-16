$(document).ready(function(){

        $(".li_n").bind("click",function(event) {
            var id = this.id;
            $('#parent').val(id);
            $('#NewComFormId').show();
            $('#content1').focus();
             });

         $("#linkComId").bind("click",function(event) {

            $('#NewComFormId').show(1000);
         });

    $('#newCom').click(function(){

        var reg_mail = /^[\.a-z0-9_-]{3,20}@[\.a-z0-9_-]{1,20}\.[a-z]{2,4}$/i;
        var g = $('#GuestOrUser').val();

        if(!g)

            if ((!reg_mail.test($('#guest').val()))&&($('#content1').val()!=null))
            {
                $('#guest').val(null);
                alert('Проверьте правильность данных!');
                return false;
            }
            else
                return true;
        else
            return true;

    })

         });