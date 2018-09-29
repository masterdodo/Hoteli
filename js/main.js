function checkInputOnKeyUp (x)
{
    if( /(.+)@(.+){2,}\.(.+){2,}/.test(x) )
    {
        setTimeout(function()
        {
            document.querySelector('#error-codes').innerHTML = ""; 
        }, 500);
    } else
    {
        setTimeout(function()
        {
            document.querySelector('#error-codes').innerHTML = "Napačna e-pošta."; 
        }, 1500);
    }
}