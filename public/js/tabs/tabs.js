$(document).ready(function(){
    console.log("documento");
    $('div#contents > .secciones').hide();
    $('div#contents > .secciones:first').show();
    const formulario = $("form#formularioDoc")
    console.log(formulario);
    const tabulaciones = $('ul#boxTabsN > li');
    console.log(tabulaciones);
    console.log($('#envioExi').hide());
    tabulaciones.click(function(){
        $('div#contents > .secciones').hide();

        const referencia = $(this).find('a').attr('href');
        $(referencia).show();
        console.log(referencia);
        console.log($(referencia));
        /*if(referencia=="#tabs-3")
        {
            $('#envioExi').hide();
            $('#envioExi').show();
        }*/

        switch(referencia)
        {
            case "#tabs-1":
                $('#envioExi').hide();
                break;
            case "#tabs-2":
                $('#envioExi').hide();
                break;
            case "#tabs-3":
                $('#envioExi').show();
                break;
            default:
                $('#envioExi').hide();
                break;
        }


    });
});
