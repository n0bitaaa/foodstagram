$('#image').change(function(){
    $('#file-chosen').text(this.files[0].name);
    $('.saveImage').removeClass('disabled');
})

$('#information input,#information textarea').on("input",function(){
    $('#information button').removeClass('disabled');
})

$('#password input').on("input",function(){
    $('#password button').removeClass('disabled');
})