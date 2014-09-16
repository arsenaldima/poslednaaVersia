 $(document).ready(function(){
        $('#sub').click(function(){

            var first_pas=document.getElementById('text').value
            var first_pas2=document.getElementById('text_1').value

           if (first_pas!=first_pas2)
           {
               alert('Пароли не совпадают');
               return false;
           }
            else

            return true;
        })

    })