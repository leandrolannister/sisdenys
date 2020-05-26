$(function(){
  $('button[name="btn-cep"]').click(function(event){
    event.preventDefault();
        
    const cep = $('input[name="cep"]').val();
    const logradouro = $('input[name="logradouro"]');
    const bairro = $('input[name="bairro"]');

    $.ajax({
      url: "https://viacep.com.br/ws/"+cep+"/json/",
      type: 'get',
      data: $(this).serialize(),
      dataType: 'json',
        success: function(resp){
            
        logradouro.val(resp.logradouro);
        bairro.val(resp.bairro);
                        
        },
        error: function(resp){
          if(resp.status == 0)
            $('.msg').removeClass('d-none').html(
            alert('Cep incorreto'));
        } 
    });
  });
});  