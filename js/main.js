function checkInputOnKeyUp (x)
{
    if( /(.+)@(.+){2,}\.(.+){2,}/.test(x) )
    {
        setTimeout(function()
        {
            document.querySelector('#error-email').innerHTML = ""; 
        }, 500);
    } else
    {
        setTimeout(function()
        {
            document.querySelector('#error-email').innerHTML = "Napačna e-pošta."; 
        }, 500);
    }
}

function checkInputOnKeyUpPass (x)
{
    if (x.length < 8)
    {
        document.querySelector('#error-pass').innerHTML = "Geslo je prekratko.";
    }
    else
    {
        document.querySelector('#error-pass').innerHTML = "";
    }
}