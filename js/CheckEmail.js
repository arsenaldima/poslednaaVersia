 $(document).ready(function(){
        $('#sub').click(function(){
            var reg_mail = /^[\.a-z0-9_-]{3,20}@[\.a-z0-9_-]{1,20}\.[a-z]{2,4}$/i;

            if (!reg_mail.test($('#text').val()))
            {
                $('#text').val(null);
                alert('Проверьте правильность данных!');
                return false;
            }
            else
                return true;

        })

    })
