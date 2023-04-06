$(function(){
    $('#cpf').mask('999.999.999-99');
    $('#cnpj').mask('99.999.999/9999-99');
  
    $('#myInput').keyup(function(){
      const val = $(this).val().replace(/[^0-9]/g, '');
      console.log('val', val);
      if (val.length <= 11) {
        $('#cpf').val(val);
        $(this).val($('#cpf').masked());
        $('#cnpj_cpf').text('CPF');
      } else {
        $('#cnpj').val(val);
        $(this).val($('#cnpj').masked());
        $('#cnpj_cpf').text('CNPJ');
      }
    });
  });