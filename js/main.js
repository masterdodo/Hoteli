function checkInputOnKeyUp (x)
{
    var value = x.value;
    console.log(value);
    if( /(.+)@(.+){2,}\.(.+){2,}/.test(value) )
    {
    console.log('Valid!');
    } else
    {
    console.log('Invalid!');
    }
}