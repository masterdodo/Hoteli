function checkInputOnKeyUp (x)
{
    var field = document.querySelector('[name="email"]').value;
    console.log(field);
    if( /(.+)@(.+){2,}\.(.+){2,}/.test(field) )
    {
    console.log('Valid!');
    } else
    {
    console.log('Invalid!');
    }
}