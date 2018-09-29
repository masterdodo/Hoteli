function checkInputOnKeyUp (x)
{
    if( /(.+)@(.+){2,}\.(.+){2,}/.test(x) )
    {
        document.querySelector('#error-email').innerHTML = "";
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
        setTimeout(function()
        {
        document.querySelector('#error-pass').innerHTML = "Geslo je prekratko.";
        }, 500);
    }
    else
    {
        document.querySelector('#error-pass').innerHTML = "";
    }
}