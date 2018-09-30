function checkInputOnKeyUpMail (x)
{
    if( /(.+)@(.+){2,}\.(.+){2,}/.test(x) )
    {
        document.querySelector('#error-email').innerHTML = "";
        document.querySelector('#input-prijava-email').style.background = '#6faf48';
        document.querySelector('#error-email').style.display = "none";
        document.querySelector('#input-prijava-submit').disabled = false;
    } 
    else
    {
        if (document.querySelector('#error-email').innerHTML == "")
        {
            setTimeout(function()
            {
                document.querySelector('#error-email').style.display = "block";
                document.querySelector('#error-email').innerHTML = "Napačna e-pošta."; 
                document.querySelector('#input-prijava-email').style.background = '#ad2424';
                document.querySelector('#input-prijava-submit').disabled = true;
            }, 500);
        }
    }
}

function checkInputOnKeyUpPass (x)
{
    if (x.length < 8)
    {
        if (document.querySelector('#error-pass').innerHTML == "")
        {
            setTimeout(function()
            {
                document.querySelector('#error-pass').style.display = "block";
                document.querySelector('#error-pass').innerHTML = "Geslo je prekratko.";
                document.querySelector('#input-prijava-pass').style.background = '#ad2424';
                document.querySelector('#input-prijava-submit').disabled = true;
            }, 500);
        }
    }
    else
    {
        document.querySelector('#error-pass').innerHTML = "";
        document.querySelector('#input-prijava-pass').style.background = '#6faf48';
        document.querySelector('#error-pass').style.display = "none";
        document.querySelector('#input-prijava-submit').disabled = false;
    }
}